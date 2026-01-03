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




Route::prefix('guest')->name('guest.')->group(function () {

    Route::get('/', [GuestController::class, 'index'])->name('dashboard');

    Route::get('/library-map', [GuestController::class, 'libraryMap'])->name('library-map');

    Route::get('/panoramas', [GuestController::class, 'panoramas'])->name('panoramas');

    Route::get('/floors', [GuestFloorController::class, 'index'])->name('floors.index');
    Route::get('/floors/{floor}', [GuestFloorController::class, 'show'])->name('floors.show');

    Route::get('/gallery', [GuestGalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/{gallery}', [GuestGalleryController::class, 'show'])->name('gallery.show');
    Route::get('/gallery/category/{category}', [GuestGalleryController::class, 'category'])->name('gallery.category');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});




Route::get('/pano/{pano}', [PanoramaController::class, 'view'])->name('pano.view');




Route::get('/', function () {
    return redirect()->route('guest.dashboard');
})->name('home');




Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {



    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');




    Route::resource('maps', LibraryMapController::class);
    Route::post('/maps/{map}/set-default', [LibraryMapController::class, 'setDefault'])->name('maps.set-default');




    Route::get('/pano', [PanoramaController::class, 'index'])->name('pano.index');
    Route::get('/pano/create', [PanoramaController::class, 'create'])->name('pano.create');
    Route::post('/pano', [PanoramaController::class, 'store'])->name('pano.store');
    Route::get('/pano/{pano}/edit', [PanoramaController::class, 'edit'])->name('pano.edit');
    Route::post('/pano/{pano}/update', [PanoramaController::class, 'update'])->name('pano.update');
    Route::post('/pano/{pano}/replace', [PanoramaController::class, 'replace'])->name('pano.replace');
    Route::delete('/pano/{pano}', [PanoramaController::class, 'destroy'])->name('pano.destroy');



    Route::resource('floors', FloorController::class);



    Route::resource('galleries', GalleryController::class);



    Route::resource('contact-messages', ContactMessageController::class)->except(['create', 'edit']);
    Route::post('/contact-messages/{contactMessage}/mark-read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-read');
    Route::post('/contact-messages/{contactMessage}/mark-replied', [ContactMessageController::class, 'markAsReplied'])->name('contact-messages.mark-replied');
    Route::post('/contact-messages/{contactMessage}/mark-closed', [ContactMessageController::class, 'markAsClosed'])->name('contact-messages.mark-closed');
});

use App\Http\Controllers\ChatController;
Route::post('/chat', ChatController::class)->name('chat.invoke');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
