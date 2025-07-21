<x-guest-layout>
    <h1 class="text-3xl font-bold text-center mb-6">ログイン</h1>

    <div class="text-right mb-2">
        <a href="{{ route('register') }}" class="text-sm text-blue-500 hover:underline">新規会員登録はこちら</a>
    </div>

    <!-- ログインフォーム -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <label for="email">メールアドレス</label>
            <input id="email" class="w-full mt-1 p-2 border rounded" type="email" name="email" required autofocus />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">パスワード</label>
            <input id="password" class="w-full mt-1 p-2 border rounded" type="password" name="password" required />
        </div>

        <div class="mt-6">
            <button class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">ログイン</button>
        </div>
    </form>
</x-guest-layout>