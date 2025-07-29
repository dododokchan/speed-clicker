<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Score;

class DashboardController extends Controller
{
    // 管理ダッシュボード
    public function index()
    {
        $user = auth()->user();                 // ログイン中ユーザー

        // 1 回のクエリで全スコアを取得しコレクション操作
        $scores = $user->scores()
                       ->orderByDesc('created_at')
                       ->get();

        $played       = $scores->count();                       // 記録件数
        $bestAvg      = $scores->min('average_score');          // 自己最速平均
        $latestAvg    = optional($scores->first())->average_score; // 直近 1 件
        $bestScore    = $scores->max('score');                  // 最速タイム
        $latestScore  = optional($scores->first())->score;      // 直近のタイム

        return view('admin.dashboard', compact(
            'user',
            'played',
            'bestAvg',
            'latestAvg',
            'bestScore',
            'latestScore'
        ));
    }
}
