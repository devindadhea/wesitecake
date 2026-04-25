<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\Category;
use App\Models\AboutSection;
use App\Models\Feature;
use App\Models\FooterSection;
use App\Models\SocialMedia;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $hero = HeroSection::first();
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        $about = AboutSection::first();
        $features = Feature::where('is_active', true)->orderBy('order')->get();
        $footer = FooterSection::first();
        $socials = SocialMedia::where('is_active', true)->orderBy('order')->get();
        $bestSellers = Product::where('is_best_seller', true)->get();
        $allProducts = Product::all();
        
        // Kirim data ke view
        return view('home', compact(
            'hero', 
            'categories', 
            'about', 
            'features', 
            'footer', 
            'socials',
            'bestSellers',
            'allProducts'
        ));
    }
    public function categoryProducts($slug)
{
    // Cari kategori berdasarkan slug
    $category = Category::where('slug', $slug)->firstOrFail();
    
    // Ambil produk berdasarkan nama kategori
    $products = Product::where('category', $category->name)->get();
    
    // Data lain untuk layout (opsional)
    $hero = HeroSection::first();
    $categories = Category::where('is_active', true)->orderBy('order')->get();
    $about = AboutSection::first();
    $features = Feature::where('is_active', true)->orderBy('order')->get();
    $footer = FooterSection::first();
    $socials = SocialMedia::where('is_active', true)->orderBy('order')->get();
    
    return view('category-products', compact('category', 'products', 'hero', 'categories', 'about', 'features', 'footer', 'socials'));
}
}