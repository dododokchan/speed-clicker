<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScoreController;

//Route::post('/scores', [ScoreController::class, 'store']);

Route::middleware('auth:sanctum')->post('/scores', [ScoreController::class, 'store'])
    ->name('scores.store');