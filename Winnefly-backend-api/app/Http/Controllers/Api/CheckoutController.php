<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'address' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $externalId = 'WINNEFLY-' . Str::uuid();

        $totalPrice = collect($request->items)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $order = Order::create([
            'user_id' => $request->user()->id,
            'external_id' => $externalId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'address' => $request->address,
            'total_price' => $totalPrice,
            'payment_method' => 'xendit',
            'status' => 'PENDING',
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        $response = Http::withBasicAuth(env('XENDIT_SECRET_KEY'), '')
            ->post('https://api.xendit.co/v2/invoices', [
                'external_id' => $externalId,
                'amount' => $totalPrice,
                'payer_email' => $request->customer_email,
                'description' => 'Pembayaran Winnefly Pastries',
                'success_redirect_url' => env('FRONTEND_URL') . '/payment-success',
                'failure_redirect_url' => env('FRONTEND_URL') . '/payment-failed',
            ]);

        if (!$response->successful()) {
            return response()->json([
                'message' => 'Gagal membuat invoice Xendit',
                'status' => $response->status(),
                'error' => $response->json(),
                'raw' => $response->body(),
            ], 500);
        }

        $invoice = $response->json();

        $order->update([
            'invoice_id' => $invoice['id'],
            'invoice_url' => $invoice['invoice_url'],
        ]);

        return response()->json([
            'message' => 'Checkout berhasil',
            'order_id' => $order->id,
            'invoice_url' => $invoice['invoice_url'],
        ]);
    }

        public function callback(Request $request)
        {
            \Log::info('Xendit Callback Payload:', $request->all());

            $callbackToken = $request->header('x-callback-token');

            if ($callbackToken !== env('XENDIT_CALLBACK_TOKEN')) {
                return response()->json([
                    'message' => 'Invalid callback token'
                ], 403);
            }

            $externalId = $request->input('external_id');

            $order = Order::where('external_id', $externalId)->first();

            if (!$order) {
                return response()->json([
                    'message' => 'Order tidak ditemukan',
                    'external_id_dari_xendit' => $externalId,
                    'payload' => $request->all()
                ], 404);
            }

            if ($request->status === 'PAID' || $request->status === 'SETTLED') {
                $order->update([
                    'status' => 'PAID',
                ]);
            } elseif ($request->status === 'EXPIRED') {
                $order->update([
                    'status' => 'EXPIRED',
                ]);
            } elseif ($request->status === 'FAILED') {
                $order->update([
                    'status' => 'FAILED',
                ]);
            }

            return response()->json([
                'message' => 'Callback received'
            ]);
        }
}