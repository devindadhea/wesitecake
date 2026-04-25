<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\FooterSection;
use App\Models\Feature;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CMSController extends Controller
{
    /**
     * Display a listing of CMS sections.
     */
    public function index()
    {
        $hero = HeroSection::first();
        $about = AboutSection::first();
        $footer = FooterSection::first();
        
        return view('admin.cms.index', compact('hero', 'about', 'footer'));
    }

    /**
     * Show the form for editing hero section.
     */
    public function editHero()
    {
        $hero = HeroSection::first();
        return view('admin.cms.hero', compact('hero'));
    }

    /**
     * Update the hero section.
     */
public function updateHero(Request $request)
{
    $request->validate([
        'title' => 'required',
        'subtitle' => 'required',
        'description' => 'required',
        'button_text' => 'required',
        'button_link' => 'required',
        'cake_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'strawberry_left' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'strawberry_right' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $hero = HeroSection::first();
    if (!$hero) {
        $hero = new HeroSection();
    }

    $hero->fill($request->except(['cake_image', 'strawberry_left', 'strawberry_right']));

    // 🔥 UPLOAD KE PUBLIC/IMAGES
    if ($request->hasFile('cake_image')) {
        // Hapus file lama
        if ($hero->cake_image && file_exists(public_path($hero->cake_image))) {
            unlink(public_path($hero->cake_image));
        }
        $file = $request->file('cake_image');
        $filename = 'cake_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $hero->cake_image = 'images/' . $filename;
    }

    if ($request->hasFile('strawberry_left')) {
        if ($hero->strawberry_left && file_exists(public_path($hero->strawberry_left))) {
            unlink(public_path($hero->strawberry_left));
        }
        $file = $request->file('strawberry_left');
        $filename = 'strawberry_left_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $hero->strawberry_left = 'images/' . $filename;
    }

    if ($request->hasFile('strawberry_right')) {
        if ($hero->strawberry_right && file_exists(public_path($hero->strawberry_right))) {
            unlink(public_path($hero->strawberry_right));
        }
        $file = $request->file('strawberry_right');
        $filename = 'strawberry_right_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $hero->strawberry_right = 'images/' . $filename;
    }

    $hero->save();

    return redirect()->route('admin.cms.index')->with('success', 'Hero section updated successfully!');
}
    /**
     * Show the form for editing about section.
     */
    public function editAbout()
    {
        $about = AboutSection::first();
        $features = Feature::orderBy('order')->get();
        return view('admin.cms.about', compact('about', 'features'));
    }

    /**
     * Update the about section.
     */
public function updateAbout(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $about = AboutSection::first();
    if (!$about) {
        $about = new AboutSection();
    }

    $about->fill($request->except('image'));

    // 🔥 UPLOAD KE PUBLIC/IMAGES
    if ($request->hasFile('image')) {
        // Hapus file lama
        if ($about->image && file_exists(public_path($about->image))) {
            unlink(public_path($about->image));
        }
        
        $file = $request->file('image');
        $filename = 'about_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $about->image = 'images/' . $filename;
    }

    $about->save();
    
    return redirect()->route('admin.cms.index')->with('success', 'About section updated successfully!');
}

    /**
     * Show the form for editing footer section.
     */
    public function editFooter()
    {
        $footer = FooterSection::first();
        $socials = SocialMedia::orderBy('order')->get();
        return view('admin.cms.footer', compact('footer', 'socials'));
    }

    /**
     * Update the footer section.
     */
    public function updateFooter(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'copyright' => 'required',
        ]);

        $footer = FooterSection::first();
        if (!$footer) {
            $footer = new FooterSection();
        }

        $footer->fill($request->all());
        $footer->save();

        return redirect()->route('admin.cms.index')->with('success', 'Footer section updated successfully!');
    }
}