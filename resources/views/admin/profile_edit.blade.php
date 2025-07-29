<x-admin-layout>
    <h2 class="text-2xl font-bold mb-6">ユーザー情報編集</h2>

    @if(session('status'))
        <div class="mb-4 p-3 bg-green-50 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-6 max-w-md">
        @csrf @method('PATCH')

        {{-- ユーザー名 --}}
        <div>
            <label class="block text-sm font-semibold">ユーザー名</label>
            <input name="name" type="text"
                   value="{{ old('name', $user->name) }}"
                   class="w-full p-2 border rounded mt-1" maxlength="30" required>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        {{-- メール --}}
        <div>
            <label class="block text-sm font-semibold">メールアドレス</label>
            <input name="email" type="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full p-2 border rounded mt-1" required>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- パスワード --}}
        <div>
            <label class="block text-sm font-semibold">新しいパスワード</label>
            <input name="password" type="password" class="w-full p-2 border rounded mt-1">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <label class="block text-sm font-semibold">新しいパスワード 再入力</label>
            <input name="password_confirmation" type="password" class="w-full p-2 border rounded mt-1">
        </div>

        <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            更新
        </button>
    </form>
</x-admin-layout>