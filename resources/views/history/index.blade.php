@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        {{-- タイトル --}}
        <h1 class="text-2xl font-bold mb-6">🗂 平均スコア履歴</h1>

        {{-- 日付ごとにグループ化された $scores をループ --}}
        @foreach ($scores as $date => $dayScores)
            <div class="mb-8">
                {{-- 日付ヘッダー --}}
                <h2 class="text-lg font-semibold flex items-center gap-2 mb-2">
                    📅 {{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}
                </h2>

                <div class="border-t border-gray-300 pt-3">
                    @php
                        // その日（$dayScores）のベストスコアを取得
                        $best = $dayScores->min('average_score');
                    @endphp

                    {{-- 1日分のスコアを時刻順に表示 --}}
                    @foreach ($dayScores as $score)
                        <div class="flex items-center justify-between mb-1
                                    {{ $score->average_score == $best ? 'text-red-600 font-bold' : '' }}">
                            <span>
                                {{-- ベストスコアなら🏆アイコンを表示 --}}
                                @if ($score->average_score == $best)
                                    🏆
                                @endif
                                {{ $score->created_at->format('H:i') }}　
                                {{ number_format($score->average_score) }}ms
                            </span>

                            {{-- 削除ボタン --}}
                            <form method="POST" action="{{ route('history.destroy', $score->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs text-red-500 underline hover:text-red-700">
                                    削除
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        {{-- ページネーション（$scores が Paginator の場合） --}}
        <div class="mt-6">
            {{ $scores->links() }}
        </div>
    </div>
@endsection