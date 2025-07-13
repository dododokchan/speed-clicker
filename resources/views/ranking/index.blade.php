@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">🏆全国ランキング TOP50🏆</h1>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b">
                <th class="py-2">順位</th>
                <th class="py-2">ユーザー名</th>
                <th class="py-2">ベスト(ms)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($top as $idx => $row)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2">{{ $idx + 1 }}</td>
                    <td class="py-2">{{ $row->user->name ?? '名無し' }}</td>
                    <td class="py-2">{{ number_format($row->best, 1) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection