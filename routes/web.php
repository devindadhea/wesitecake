<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\SimpleResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ContactController;


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update-email', [ProfileController::class, 'updateEmail'])->name('profile.update-email');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});
// Test route
Route::post('/test-upload', function(Request $request) {
    dd([
        'method' => $request->method(),
        'all_data' => $request->all(),
        'has_file' => $request->hasFile('image'),
        'file_info' => $request->hasFile('image') ? [
            'original' => $request->file('image')->getClientOriginalName(),
            'size' => $request->file('image')->getSize(),
            'mime' => $request->file('image')->getMimeType(),
            'error' => $request->file('image')->getError(),
            'path' => $request->file('image')->getRealPath(),
            'is_valid' => $request->file('image')->isValid(),
        ] : null,
        'files_global' => $_FILES,
        'post_max_size' => ini_get('post_max_size'),
        'upload_max_filesize' => ini_get('upload_max_filesize'),
    ]);
});

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [HomeController::class, 'categoryProducts'])->name('category.products');
// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Simple Password Reset (Tanpa Email) - LANGSUNG RESET
Route::get('/lupa-password', [SimpleResetPasswordController::class, 'showResetForm'])->name('password.request');
Route::post('/lupa-password', [SimpleResetPasswordController::class, 'reset'])->name('password.update.simple');

// Admin Routes (with middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/cms', [CMSController::class, 'index'])->name('cms.index');
    Route::get('/cms/hero', [CMSController::class, 'editHero'])->name('cms.hero');
    Route::post('/cms/hero', [CMSController::class, 'updateHero'])->name('cms.hero.update');
    Route::get('/cms/about', [CMSController::class, 'editAbout'])->name('cms.about');
    Route::post('/cms/about', [CMSController::class, 'updateAbout'])->name('cms.about.update');
    Route::get('/cms/footer', [CMSController::class, 'editFooter'])->name('cms.footer');
    Route::post('/cms/footer', [CMSController::class, 'updateFooter'])->name('cms.footer.update');
    
    Route::resource('categories', CategoryController::class);
    Route::resource('features', FeatureController::class);
    Route::resource('social', SocialMediaController::class);
    Route::resource('products', ProductController::class);

    // Contact Management
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'update'])->name('contact.update');
    Route::post('/contact/hours', [ContactController::class, 'createHour'])->name('contact.hours.store');
    Route::put('/contact/hours/{businessHour}', [ContactController::class, 'updateHour'])->name('contact.hours.update');
    Route::delete('/contact/hours/{businessHour}', [ContactController::class, 'destroyHour'])->name('contact.hours.destroy');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update-email', [ProfileController::class, 'updateEmail'])->name('profile.update-email');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

// Storage route for images (must be last)
Route::get('/storage/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);
    
    if (!file_exists($fullPath)) {
        abort(404);
    }
    
    return response()->file($fullPath);
})->where('path', '.*');