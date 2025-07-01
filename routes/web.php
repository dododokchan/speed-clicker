<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\ScoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('game');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // 既存のプロフィール関連ルート
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Speed Clicker のスコア保存
    Route::post('/api/scores', [ScoreController::class, 'store'])
         ->name('api.scores.store');
});

Route::middleware('auth')->get('/game', function () {
    return view('game');
})->name('game');

/* ★ ここがログイン／登録などのルートを読み込む一行 */
require __DIR__.'/auth.php';
