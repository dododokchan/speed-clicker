<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;   // スコアモデルを読み込む

class RankingController extends Controller
{
    /**
     * ランキング一覧（トップ50）を表示
     */
    public function index()
    {
        // 各ユーザーの最速スコアを取得し、昇順で並べる
        $top = Score::selectRaw('user_id, MIN(average_score) AS best')
                    ->groupBy('user_id')
                    ->orderBy('best')
                    ->limit(50)
                    ->with('user:id,name') // ユーザー名も取得
                    ->get();

        return view('ranking.index', compact('top')); // resources/views/ranking/index.blade.php
    }
}