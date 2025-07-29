@extends('layouts.app') {{-- 既存レイアウト起用 --}}

@section('content')

<div class="max-w-3xl mx-auto pt-10 space-y-6">

    {{-- 更新完了メッセージ --}}
    @if (session('status') === 'profile-updated')
        <div class="mb-4 rounded bg-green-50 p-3 text-green-700 text-center">
            ユーザー情報を更新しました！
        </div>
    @endif

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">管理メニュー</h1>

        {{-- ユーザー情報編集リンク --}}
        <a href="{{ route('admin.profile.edit') }}"
           class="text-sm text-indigo-600 hover:underline whitespace-nowrap">
            ユーザー情報編集
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <x-stat-card label="ユーザー名" :value="$user->name" />
        <x-stat-card label="チャレンジ回数" :value="$played" />
        <x-stat-card label="自己ベスト"     :value="$bestAvg ? $bestAvg . ' ms' : '—'" />
        <x-stat-card label="最近の平均"     :value="$latestAvg ? $latestAvg . ' ms' : '—'" />
    </div>

    {{-- TODO: ユーザー／スコア管理テーブルやグラフを追加 --}}
</div>
@endsection