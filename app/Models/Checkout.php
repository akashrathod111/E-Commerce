<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'total_amount',
        'payment_method',
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_orders', 'order_id', 'product_id')->withTimestamps();
    }

}
