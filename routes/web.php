<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpeechController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransactionController;
//Route::get('/', function () {
    //return view('welcome');
//});

Route::get('/', [SpeechController::class, 'showWelcomePage'])->name('welcome');
Route::view('/speech', 'speech');
Route::post('/speech/transcribe', [SpeechController::class, 'transcribe'])
    ->name('speech.transcribe');
Auth::routes();
Route::middleware('auth')->group(function () {
    //
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/chat', [App\Http\Controllers\SpeechController::class, 'handle'])->name('chat.handle');
Route::get('/transactions/create', [TransactionController::class, 'create'])
        ->name('transactions.create');

    Route::post('/transactions', [TransactionController::class, 'store'])
        ->name('transactions.store');
});




