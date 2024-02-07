<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;


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

Route::get('/', function () {
    return view('create');
})->name('create');

Route::get('/generate', function () {
    return view('generate');
});

Route::get('/show', function () {
    return view('show');
});

Route::get('/message', function () {
    return view('message');
});

Route::get('/block', function () {
    return view('block');
})->name('block');

Route::post('/regenerate-link', [MessageController::class, 'regenerateLink'])->name('regenerateLink');
Route::post('/generate-link', [MessageController::class, 'generateLink'])->name('generateLink');
Route::get('/link/{token}', [MessageController::class, 'showLink']);
Route::post('/validate/{token}', [MessageController::class, 'validateLink']);
Route::get('/message/{token}', [MessageController::class, 'showMessage'])->name('message.show');

