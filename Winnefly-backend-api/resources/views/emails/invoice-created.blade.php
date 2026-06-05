<h2>Invoice Pembayaran Winnefly Pastries</h2>

<p>Halo {{ $order->customer_name }},</p>

<p>Terima kasih sudah melakukan checkout di Winnefly Pastries.</p>

<p><strong>Total Pembayaran:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

<p><strong>Status:</strong> {{ $order->status }}</p>

<p>Silakan lanjutkan pembayaran melalui link berikut:</p>

<a href="{{ $order->invoice_url }}">
    Bayar Sekarang
</a>