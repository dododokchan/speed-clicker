{{-- ゲーム画面（ログイン必須＆認証済みユーザー想定） --}}
{{-- resources/views/game.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Speed Clicker Game</title>
    {{-- Tailwind（Vite ビルド済み CSS） --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/game.js'])
    {{-- CSRF トークンを JS からも参照できるように埋め込む --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>window.isLoggedIn = @json(auth()->check());</script>
</head>
<body class="min-h-screen flex flex-col items-center justify-center bg-gray-100 text-gray-800">

    <div class="w-full text-center mb-2">
            @guest
                ようこそ！ゲストさん　
                <a href="{{ route('login') }}" class="underline text-blue-600 hover:text-blue-800">ログイン</a> /
                <a href="{{ route('register') }}" class="underline text-blue-600 hover:text-blue-800">会員登録</a>
            @else
                ようこそ、{{ Auth::user()->name }}さん
            @endguest
    </div>

<!-- 右上固定バッジ -->
<div
    x-data="{ open: false }"      {{-- Alpine.js 状態 --}}
    class="fixed top-6 right-[7rem]"
>
    <div @mouseenter="open = true" @mouseleave="open = false" class="relative">
    <!-- 表示用ボタン -->
    <button
        class="bg-gray-800 ml-auto text-white text-sm px-4 py-2 rounded-full shadow-lg hover:bg-gray-700 transition"
    >
        Speed Clickerとは？
    </button>

    <!-- ツールチップ -->
    <div
        x-show="open"
        x-transition
        class="absolute right-0 top-full max-w-xl w-max p-4 text-sm text-gray-800 bg-white border border-gray-300 rounded-lg shadow-lg whitespace-normal"
        style="display: none;"                         {{-- x-show で制御するための初期非表示 --}}
    >
        5回の反応速度を測定し、</br>
        平均スコアを保存するミニゲームです
    </div>
</div>
</div>

    <header class="w-full flex flex-col items-center justify-center">
        {{-- 上部メッセージだけ中央表示 --}}

        {{-- ハンバーガーメニュー --}}
        <div x-data="{ open: false }" class="absolute top-4 right-4 z-50 flex justify-end w-full">
            <div class="relative"  @mouseenter="open = true" @mouseleave="open = false">
                <button class="focus:outline-none">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <div x-show="open"
                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-2 z-50">
                @guest
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">ログイン</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">新規登録</a>
                @else
                    <a href="{{ route('history') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">履歴</a>
                    <a href="{{ route('ranking') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">ランキング</a>
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">管理メニュー</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">ログアウト</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>
   <h1 class="flex items-center justify-center text-3xl font-bold gap-2 mb-8">
    <span class="text-4xl animate-run-in-place">🏃‍♂️</span>
    <span class="px-3">Speed Clicker</span>
    <span class="text-4xl animate-run-in-place">🏃‍♀️</span>
</h1>


    {{-- スタートボタン --}}
    <button id="startBtn"q
            class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
        Start!
    </button>

    {{-- クリック指示表示エリア --}}
    <div id="prompt"
         class="w-full mt-5 h-10 bg-red-500 text-white text-4xl font-bold text-center rounded-md shadow-lg hover:bg-red-600 transition hidden">
        click!!!!
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
