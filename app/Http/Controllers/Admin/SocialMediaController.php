<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socials = SocialMedia::orderBy('order')->get();
        return view('admin.social.index', compact('socials'));
    }

    public function create()
    {
        return view('admin.social.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required',
            'icon' => 'required',
            'url' => 'required|url',
            'order' => 'integer',
        ]);

        SocialMedia::create($request->all());

        return redirect()->route('admin.social.index')->with('success', 'Social media created successfully!');
    }

    public function edit(SocialMedia $social)
    {
        return view('admin.social.edit', compact('social'));
    }

    public function update(Request $request, SocialMedia $social)
    {
        $request->validate([
            'platform' => 'required',
            'icon' => 'required',
            'url' => 'required|url',
            'order' => 'integer',
        ]);

        $social->update($request->all());

        return redirect()->route('admin.social.index')->with('success', 'Social media updated successfully!');
    }

    public function destroy(SocialMedia $social)
    {
        $social->delete();
        return redirect()->route('admin.social.index')->with('success', 'Social media deleted successfully!');
    }
}