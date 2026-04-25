<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Support\ImageUrlResolver;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'image', 'description', 'order', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && !$category->isDirty('slug')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category', 'name');
    }

    /**
     * Get the URL for category image
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return ImageUrlResolver::resolve(null, 'images/default-category.png', $this->name ?: 'Category Image');
        }

        $path = str_starts_with($this->image, 'categories/') ? $this->image : 'categories/' . $this->image;

        return ImageUrlResolver::resolve($path, 'images/default-category.png', $this->name ?: 'Category Image');
    }

    /**
     * Debug method untuk melihat path image
     */
    public function debugImage()
    {
        $info = [
            'image_db' => $this->image,
            'image_url' => $this->image_url,
            'storage_path' => storage_path('app/public/' . $this->image),
            'storage_exists' => file_exists(storage_path('app/public/' . $this->image)),
            'public_path' => public_path('storage/' . $this->image),
            'public_exists' => file_exists(public_path('storage/' . $this->image)),
            'filesize' => file_exists(storage_path('app/public/' . $this->image)) ? 
                filesize(storage_path('app/public/' . $this->image)) . ' bytes' : 'N/A',
        ];
        
        return $info;
    }
}