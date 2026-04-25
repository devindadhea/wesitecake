<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\ImageUrlResolver;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'subtitle', 'description', 'cake_image', 
        'strawberry_left', 'strawberry_right', 'button_text', 
        'button_link', 'is_active'
    ];

    // Accessor untuk mengambil URL gambar
    public function getCakeImageUrlAttribute()
    {
        return ImageUrlResolver::resolve($this->cake_image, 'images/cake1.png', 'Cake Image');
    }

    public function getStrawberryLeftUrlAttribute()
    {
        return ImageUrlResolver::resolve($this->strawberry_left, 'images/s1.png', 'Strawberry Left');
    }

    public function getStrawberryRightUrlAttribute()
    {
        return ImageUrlResolver::resolve($this->strawberry_right, 'images/s2.png', 'Strawberry Right');
    }
}