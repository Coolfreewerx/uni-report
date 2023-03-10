<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('/sectors', \App\Http\Controllers\SectorController::class);

Route::resource('/notes', \App\Http\Controllers\NoteController::class);

Route::resource('/charts', \App\Http\Controllers\ChartController::class);

Route::get('your_posts', [\App\Http\Controllers\PostController::class, 'your_posts']) -> name('your_posts');