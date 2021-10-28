<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\OmdbController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/search', [OmdbController::class, 'index'])->name('omdb.search');
Route::get('/titles/{id}', [OmdbController::class, 'show'])->name('omdb.show');

Route::post('/titles/{id}/favorite', [MovieController::class, 'favorite'])->name('movies.favorite');
Route::post('titles/{id}/unfavorite', [MovieController::class, 'unfavorite'])->name('movies.unfavorite');

require __DIR__.'/auth.php';
