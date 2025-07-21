@extends('layouts.app') {{-- 既存レイアウト起用 --}}

@section('content')
<div class="max-w-3xl mx-auto pt-10 space-y-6">

    <h1 class="text-2xl font-bold mb-4">管理画面</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-4 bg-white rounded shadow text-center">
            <p class="text-sm text-gray-500">ユーザー数</p>
            <p class="text-3xl font-bold">{{ $users }}</p>
        </div>

        <div class="p-4 bg-white rounded shadow text-center">
            <p class="text-sm text-gray-500">スコア件数</p>
            <p class="text-3xl font-bold">{{ $scores }}</p>
        </div>

        <div class="p-4 bg-white rounded shadow text-center">
            <p class="text-sm text-gray-500">最速平均</p>
            <p class="text-3xl font-bold">{{ $bestAvg }} ms</p>
        </div>
    </div>

    {{-- TODO: ユーザー／スコア管理テーブルやグラフを追加 --}}
</div>
@endsection