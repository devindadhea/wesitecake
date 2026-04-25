<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\ImageUrlResolver;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'description', 'price', 'rating', 'image', 'is_best_seller'
    ];

    public function getImageUrlAttribute()
    {
        return ImageUrlResolver::resolve($this->image, 'images/default-product.png', $this->name ?: 'Product Image');
    }
}