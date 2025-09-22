<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LibraryMapController;
use App\Http\Controllers\Admin\FloorController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Guest\FloorController as GuestFloorController;
use App\Http\Controllers\Guest\GalleryController as GuestGalleryController;
use App\Http\Controllers\Guest\ContactController;
use App\Http\Controllers\PanoramaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROUTE ORGANIZATION
|--------------------------------------------------------------------------
| 
| 👥 GUEST ROUTES    - Public access, no authentication required
| 🔐 ADMIN ROUTES    - Authentication required, admin-only features
| 🔄 SHARED ROUTES   - Used by both guest and admin (different layouts)
| 🔧 SYSTEM ROUTES   - Laravel system routes (auth, profile, etc.)
|
*/

// ============================================================================
// 👥 GUEST ROUTES (Public Access - No Authentication Required)
// ============================================================================

Route::prefix('guest')->name('guest.')->group(function () {
    // Guest Homepage
    Route::get('/', [GuestController::class, 'index'])->name('dashboard');
    
    // Interactive Library Map Viewer
    Route::get('/library-map', [GuestController::class, 'libraryMap'])->name('library-map');
    
    // Panorama Listing Page
    Route::get('/panoramas', [GuestController::class, 'panoramas'])->name('panoramas');
    
    // Floor Directory
    Route::get('/floors', [GuestFloorController::class, 'index'])->name('floors.index');
    Route::get('/floors/{floor}', [GuestFloorController::class, 'show'])->name('floors.show');
    
    // Gallery
    Route::get('/gallery', [GuestGalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/{gallery}', [GuestGalleryController::class, 'show'])->name('gallery.show');
    Route::get('/gallery/category/{category}', [GuestGalleryController::class, 'category'])->name('gallery.category');
    
    // Contact Us
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

// ============================================================================
// 🔄 SHARED ROUTES (Both Guest & Admin - Different Layouts)
// ============================================================================

// Panorama Viewer (Shows different layouts for guest vs admin)
Route::get('/pano/{pano}', [PanoramaController::class, 'view'])->name('pano.view');

// ============================================================================
// 🏠 DEFAULT ROUTE
// ============================================================================

// Root URL redirects to guest dashboard
Route::get('/', function () {
    return redirect()->route('guest.dashboard');
})->name('home');

// ============================================================================
// 🔐 ADMIN ROUTES (Authentication Required)
// ============================================================================

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    
    // ========================================
    // 📊 ADMIN DASHBOARD
    // ========================================
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // ========================================
    // 🗺️ MAP MANAGEMENT
    // ========================================
    // Library Maps CRUD (Individual map management)
    Route::resource('maps', LibraryMapController::class);
    Route::post('/maps/{map}/set-default', [LibraryMapController::class, 'setDefault'])->name('maps.set-default');
    
    // ========================================
    // 🎥 PANORAMA MANAGEMENT
    // ========================================
    // Panorama CRUD Operations
    Route::get('/pano', [PanoramaController::class, 'index'])->name('pano.index');           // List panoramas
    Route::post('/pano', [PanoramaController::class, 'store'])->name('pano.store');         // Upload new panorama
    Route::post('/pano/{pano}/update', [PanoramaController::class, 'update'])->name('pano.update');     // Rename panorama
    Route::post('/pano/{pano}/replace', [PanoramaController::class, 'replace'])->name('pano.replace');  // Replace panorama files
    Route::delete('/pano/{pano}', [PanoramaController::class, 'destroy'])->name('pano.destroy');        // Delete panorama
    
    // ========================================
    // 🏢 FLOOR DIRECTORY MANAGEMENT
    // ========================================
    Route::resource('floors', FloorController::class);
    
    // ========================================
    // 🖼️ GALLERY MANAGEMENT
    // ========================================
    Route::resource('galleries', GalleryController::class);
    
    // ========================================
    // 📧 CONTACT MESSAGES MANAGEMENT
    // ========================================
    Route::resource('contact-messages', ContactMessageController::class)->except(['create', 'edit']);
    Route::post('/contact-messages/{contactMessage}/mark-read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-read');
    Route::post('/contact-messages/{contactMessage}/mark-replied', [ContactMessageController::class, 'markAsReplied'])->name('contact-messages.mark-replied');
    Route::post('/contact-messages/{contactMessage}/mark-closed', [ContactMessageController::class, 'markAsClosed'])->name('contact-messages.mark-closed');
});

// ============================================================================
// 🔧 SYSTEM ROUTES (Laravel Built-in Features)
// ============================================================================

// User Profile Management (Laravel's built-in profile system)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============================================================================
// 🔐 AUTHENTICATION ROUTES
// ============================================================================

// Include Laravel's authentication routes (login, register, etc.)
require __DIR__.'/auth.php';
