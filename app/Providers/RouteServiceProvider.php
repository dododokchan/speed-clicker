<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * アプリ起動時に呼ばれ、ルートを登録する
     */
    public function boot(): void
    {
        $this->routes(function () {
            // --- API ルート ---
            Route::middleware('api')          // ← ミドルウェア "api" を使う
                ->prefix('api')               // ← URL の頭に /api を付与
                ->group(base_path('routes/api.php')); // ← ここで routes/api.php を読み込む

            // --- Web ルート ---
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
