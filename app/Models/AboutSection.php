<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\ImageUrlResolver;

class AboutSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'is_active'
    ];

    public function getImageUrlAttribute()
    {
        return ImageUrlResolver::resolve($this->image, 'images/c8.png', 'About Image');
    }
}