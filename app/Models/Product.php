<?php

namespace App\Models;
use App\Models\OrderItem;
use App\Models\Category;
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
        'image',
        'categories_id',
        'is_active'

    ];

    /*relationship with orderItems*/
    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    /*relationship with category*/
    public function category() {
        return $this->belongsTo(Category::class,);
    }
}
