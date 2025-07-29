<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理メニュー | Speed Clicker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    {{-- 共通ナビゲーション --}}
    <x-navbar />
    <div class="min-h-screen py-8 px-4">
        {{ $slot }}
    </div>
</body>
</html>