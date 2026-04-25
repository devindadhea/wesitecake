<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        try {
            // Validasi
            $request->validate([
                'name' => 'required|unique:categories',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'order' => 'integer|nullable',
                'description' => 'nullable|string',
                'is_active' => 'nullable',
            ]);

            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'order' => $request->order ?? 0,
                'is_active' => $request->has('is_active') ? true : false,
            ];

            // 🔥 UPLOAD LANGSUNG KE PUBLIC/IMAGES
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . Str::slug($request->name) . '.' . $extension;
                
                // Simpan langsung ke public/images
                $file->move(public_path('images'), $filename);
                
                // Simpan path ke database (format: images/nama_file.png)
                $data['image'] = 'images/' . $filename;
                
                Log::info('Category image saved: ' . $data['image']);
            }

            // Simpan ke database
            $category = Category::create($data);
            
            Log::info('Category created with ID: ' . $category->id);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Category created successfully!');

        } catch (\Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        try {
            $request->validate([
                'name' => 'required|unique:categories,name,' . $category->id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'order' => 'integer|nullable',
                'description' => 'nullable|string',
                'is_active' => 'nullable',
            ]);

            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'order' => $request->order ?? 0,
                'is_active' => $request->has('is_active') ? true : false,
            ];

            // 🔥 UPLOAD LANGSUNG KE PUBLIC/IMAGES
            if ($request->hasFile('image')) {
                // Hapus file lama jika ada
                if ($category->image && file_exists(public_path($category->image))) {
                    unlink(public_path($category->image));
                    Log::info('Deleted old image: ' . $category->image);
                }
                
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . Str::slug($request->name) . '.' . $extension;
                
                // Simpan langsung ke public/images
                $file->move(public_path('images'), $filename);
                
                // Simpan path ke database
                $data['image'] = 'images/' . $filename;
                
                Log::info('New category image saved: ' . $data['image']);
            }

            // Update database
            $category->update($data);
            
            Log::info('Category updated successfully');

            return redirect()->route('admin.categories.index')
                ->with('success', 'Category updated successfully!');

        } catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Category $category)
    {
        try {
            // Hapus file gambar dari public/images
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
                Log::info('Deleted image: ' . $category->image);
            }
            
            $category->delete();
            
            return redirect()->route('admin.categories.index')
                ->with('success', 'Category deleted successfully!');
                
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }
}