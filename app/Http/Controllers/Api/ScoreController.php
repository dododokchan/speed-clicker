<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScoreStoreRequest;
use App\Models\Score;
use Illuminate\Http\JsonResponse;

class ScoreController extends Controller
{
    /**
     * スコア保存
     *
     * @param  ScoreStoreRequest  $request  バリデーション済みリクエスト
     * @return JsonResponse
     */
    public function store(ScoreStoreRequest $request): JsonResponse
    {
        // 認証ユーザー取得 (Sanctumクッキー or Token)
        $user = $request->user();  // == Auth::user()

        // レコード作成
        $score = Score::create([
            'user_id'       => $user->id,
            'average_score' => $request->average_score,
        ]);

        // レスポンスを返す（201 Created）
        return response()->json([
            'message' => 'Score stored successfully',
            'data'    => $score,
        ], 201);
    }
}
