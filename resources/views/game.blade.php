{{-- ゲーム画面（ログイン必須＆認証済みユーザー想定） --}}
{{-- resources/views/game.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Speed Clicker Game</title>
    {{-- Tailwind（Vite ビルド済み CSS） --}}
    @vite(['resources/css/app.css'])
    {{-- CSRF トークンを JS からも参照できるように埋め込む --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="min-h-screen flex flex-col items-center justify-center bg-gray-100 text-gray-800">
    <h1 class="text-3xl font-bold mb-8">Speed Clicker</h1>

    <!-- 右下固定バッジ -->
<div
    x-data="{ open: false }"      {{-- Alpine.js 状態 --}}
    class="fixed bottom-6 right-6"
>
    <!-- 表示用ボタン -->
    <button
        @mouseenter="open = true" @mouseleave="open = false"
        class="bg-gray-800 text-white text-sm px-3 py-2 rounded-full shadow-lg hover:bg-gray-700 transition"
    >
        Speed Clickerとは？
    </button>

    <!-- ツールチップ -->
    <div
        x-show="open"
        x-transition
        class="mt-2 w-64 p-4 text-sm text-gray-800 bg-white border border-gray-300 rounded-lg shadow-lg"
        style="display: none;"                         {{-- x-show で制御するための初期非表示 --}}
    >
        5回の反応時間を計測し、平均をスコアとして保存するミニゲームです。
        ログイン済みユーザーはスコアがデータベースに記録され、履歴や
        ランキングで確認できます。
    </div>
</div>


    {{-- スタートボタン --}}
    <button id="startBtn"q
            class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
        Start!
    </button>

    {{-- クリック指示表示エリア --}}
    <div id="prompt"
         class="mt-10 text-4xl font-semibold text-red-600 hidden">
        クリック！
    </div>

    {{-- 結果表示エリア --}}
    <div id="results" class="mt-8 w-80 space-y-2"></div>

    {{-- 平均スコア表示 --}}
    <div id="average"
         class="mt-6 text-2xl font-bold text-green-700"></div>

    {{-- Vite ビルド済み JS --}}
    @vite(['resources/js/game.js'])
</body>
</html>
