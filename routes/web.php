<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\ScoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\Admin\DashboardController;

/**
 * ゲストもアクセスできるルート
 */
Route::get('/', fn () => redirect()->route('game')); // トップは /game へ
Route::get('/game', fn () => view('game'))->name('game'); // ゲーム画面
Route::get('/ranking', [RankingController::class, 'index'])->name('ranking'); // ランキング（閲覧のみ）

Route::middleware('auth')->group(function () {
    // 既存のプロフィール関連ルート
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 平均スコア履歴表示・削除
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::delete('/history/{id}', [HistoryController::class, 'destroy'])->name('history.destroy');

    // 管理ダッシュボード
    Route::prefix('admin')->name('admin.')->group(function () {
          Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
          Route::get('/profile', [ProfileController::class, 'editAdmin'])->name('profile.edit');
          Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        });
    });

/* ★ ここがログイン／登録などのルートを読み込む一行 */
require __DIR__.'/auth.php';
