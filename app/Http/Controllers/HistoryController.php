<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // ログインユーザーのスコアを日付順で取得（最新が上）
        $scores = Score::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($score) {
                return Carbon::parse($score->created_at)->format('Y-m-d');
            });

        return view('history.index', compact('scores'));
    }

    public function destroy($id)
    {
        $score = Score::findOrFail($id);

        if ($score->user_id !== Auth::id()) {
            abort(403); // 不正アクセス
        }

        $score->delete();

        return redirect()->route('history')->with('success', '削除しました');
    }
}