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
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/search', [OmdbController::class, 'index'])->name('omdb.search');
Route::get('/titles/{id}', [OmdbController::class, 'show'])->name('omdb.show');

Route::resource('movies', MovieController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
