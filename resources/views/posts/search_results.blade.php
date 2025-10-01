<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            「{{ $query }}」の検索結果
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{-- セッションメッセージはレイアウト外に表示しても良い --}}
        @if (session('message'))
            <div class="mb-4 font-bold text-red-600">
                {{ session('message') }}
            </div>
        @endif

        @if ($posts->count())
            {{-- ★★★ ここから投稿のループを開始する ★★★ --}}
            <div class="space-y-6">
                @foreach ($posts as $post)
                    {{-- 各投稿の表示ブロック --}}
                    <div class="w-full rounded-2xl bg-white p-6 shadow-md transition duration-300 hover:shadow-lg">
                        <h1 class="text-lg font-semibold text-gray-900">
                            件名:
                            {{-- posts.showへのリンク --}}
                            <a href="{{ route('posts.show', $post) }}" class="text-indigo-700 hover:text-indigo-900">
                                {{ $post->title }}
                            </a>
                        </h1>
                        <hr class="mt-2 w-full">
                        
                        {{-- 本文の抜粋（Str::limitを使用） --}}
                        <p class="mt-4 leading-relaxed text-gray-600">
                            {{ \Illuminate\Support\Str::limit($post->body, 100) }}
                        </p>
                        
                        <div class="mt-4 flex justify-end">
                            {{-- 投稿者名 --}}
                            <p class="text-sm font-semibold text-gray-500">
                                投稿者: {{ $post->user->name ?? '名無し' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- ★★★ ページネーションリンク ★★★ --}}
            <div class="mt-10">
                {{ $posts->appends(['q' => $query])->links() }}
            </div>

        @else
            {{-- 検索結果がない場合 --}}
            <div class="rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-8 text-center">
                <p class="text-lg text-gray-600">該当する記事は見つかりませんでした。</p>
                <p class="mt-2 text-sm text-gray-400">別のキーワードでお試しください。</p>
            </div>
        @endif
        {{-- ★★★ @if ブロックの閉じタグ @endif を追加 ★★★ --}}

    </div>
</x-app-layout>