<?php

namespace App\Models;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    //
     use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable= [
        'name',
        'description',
        'price',
        'stock_quantity',
        'image'

    ];

    /*relationship with orderItems*/
    public function orderItems() {
        $this->hasMany(OrderItem::class);
    }
}
