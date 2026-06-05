<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'invoice_id',
        'external_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'address',
        'total_price',
        'payment_method',
        'status',
        'invoice_url',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}