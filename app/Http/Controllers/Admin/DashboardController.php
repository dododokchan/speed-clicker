<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Score;

class DashboardController extends Controller
{
    //管理ダッシュボード
    public function index()
    {
        $user = auth()->user(); //ログイン中ユーザー
        $scores = $user->scores()->orderByDesc('created_at');

        $played = $scores->count(); //記録件数
        $bestAvg = $scores->min('average_score'); //自己最速平均
        $latestAvg = $scores->value('average_score'); //直近1件
        $bestScore = $scores->max('score');
        $latestScore = $scores->first()->score ?? null; //

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
