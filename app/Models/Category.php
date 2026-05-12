<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    //

    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description',
        'slug'
    ];

    /**relationship with product */
    public function product() {
        return $this->hasMany(Product::class);
    }
}
