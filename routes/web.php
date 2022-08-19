<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::post('/posts/{post}/comments/store', [\App\Http\Controllers\PostController::class, 'storeComment'])
    ->name('posts.comments.store');

Route::resource('/posts', \App\Http\Controllers\PostController::class);

Route::resource('/tags', \App\Http\Controllers\TagController::class);

// //For adding an image
// Route::get('/add-image',[ImageUploadController::class,'addImage'])->name('images.add');

// //For storing an image
// Route::post('/store-image',[ImageUploadController::class,'storeImage'])
// ->name('images.store');

// //For showing an image
// Route::get('/view-image',[ImageUploadController::class,'viewImage'])->name('images.view');


Route::get('/role', [CategoryController::class, 'index']);
