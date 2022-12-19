<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BuyItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
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


Route::get('/', [BookController::class, 'index'])->name('home');


Route::get('/books/{book:slug}', [BookController::class, 'show']);
Route::post('/books/{book:slug}/comments', [CommentController::class, 'store']);

Route::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth');
Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->middleware('auth');
Route::post('/books/{book:slug}/favorites', [FavoriteController::class, 'store'])->middleware('auth');


Route::get('/cart', [BuyItemController::class, 'index'])->middleware('auth');
Route::post('/books/{book:slug}/cart', [BuyItemController::class, 'store'])->middleware('auth');
Route::delete('/cart/{item}', [BuyItemController::class, 'destroy'])->middleware('auth');
Route::delete('/cart', [BuyItemController::class, 'destroyAll'])->middleware('auth');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');


require __DIR__.'/auth.php';
