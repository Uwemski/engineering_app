<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Order;
use App\Models\Product;

class OrderItem extends Model
{
    //
     use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'quantity',
        'price',
        'order_id',
        'product_id',
        'subTotal'
    ];

    public function order() {
       return $this->belongsTo(Order::class);
    }

    public function product() {
       return $this->belongsTo(Product::class);
    }
}
