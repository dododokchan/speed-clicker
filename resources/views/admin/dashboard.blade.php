@extends('layouts.app') {{-- 既存レイアウト起用 --}}

@section('content')
<div class="max-w-3xl mx-auto pt-10 space-y-6">

    <h1 class="text-2xl font-bold mb-4">管理メニュー</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <x-stat-card label="ユーザー名"   :value="$user->name" />
    <x-stat-card label="試行回数"     :value="$played" />
    <x-stat-card label="自己ベスト"    :value="$bestAvg ? $bestAvg . ' ms' : '—'" />
    <x-stat-card label="直近平均"      :value="$latestAvg ? $latestAvg . ' ms' : '—'" />
  </div>

    {{-- TODO: ユーザー／スコア管理テーブルやグラフを追加 --}}
</div>
@endsection