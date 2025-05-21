<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BookController::class, 'index']);
Route::get('/top-author', [BookController::class, 'topAuthor']);
Route::get('/form-rating', [BookController::class, 'formRating']);
Route::get('/form-rating/{authorId}', [BookController::class, 'getBooksByAuthor']);
Route::post('/add-rating', [BookController::class, 'store']);

