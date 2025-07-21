<nav class="bg-gray-800 text-white px-4 py-3 shadow-md">
    <div class="flex justify-between items-center">
        <a href="{{ route('game') }}" class="text-xl font-bold">Speed Clicker</a>

        <!-- ハンバーガーメニュー -->
        <div x-data="{ open:false }" class="relative">
            <!-- トグルボタン -->
            <button
                @click="open = !open"
                class="flex items-center px-3 py-2 border rounded hover:bg-gray-700 focus:outline-none"
            >
                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                </svg>
            </button>

            <!-- メニュー -->
            <div
                x-show="open"
                x-transition
                @click.outside="open = false"
                class="absolute right-0 mt-2 w-48 bg-white text-black rounded shadow-lg z-50"
            >
                @guest
                    <a href="{{ route('login') }}"     class="block px-4 py-2 hover:bg-gray-100">ログイン</a>
                    <a href="{{ route('register') }}"  class="block px-4 py-2 hover:bg-gray-100">新規登録</a>
                @else
                    <a href="{{ route('history') }}"          class="block px-4 py-2 hover:bg-gray-100">履歴</a>
                    <a href="{{ route('ranking') }}"          class="block px-4 py-2 hover:bg-gray-100">ランキング</a>
                    <a href="{{ route('admin.dashboard') }}"  class="block px-4 py-2 hover:bg-gray-100">管理メニュー</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">ログアウト</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>

    @guest
        <div class="text-sm text-center text-gray-200 mt-2">
            ようこそ！ゲストさん　
            <a href="{{ route('login') }}" class="underline">ログイン</a> /
            <a href="{{ route('register') }}" class="underline">会員登録</a>
        </div>
    @endguest
</nav>
