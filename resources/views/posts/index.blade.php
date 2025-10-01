<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            一覧表示
        </h2>
    </x-slot>
    <div class="mx-auto px-6">
        @if (session('message'))
            <div class="font-bold text-red-600">
                {{ session('message') }}
            </div>
        @endif
        <div class="mb-6 mt-4 flex justify-end">
            <form action="{{ route('posts.search') }}" method="GET" class="mb-4 ml-auto flex items-center space-x-2">
                <input type="text" name="q" placeholder="検索..." value="{{ request('q') }}"
                    class="rounded-lg border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500">

                <button type="submit"
                    class="rounded-lg bg-blue-700 px-4 py-2 text-white transition duration-300 ease-in-out hover:bg-indigo-700">
                    検索
                </button>
            </form>
        </div>
        @foreach ($posts as $post)
            <div class="mt-4 w-full rounded-2xl bg-white p-8">
                <h1 class="p-4 text-lg font-semibold">
                    件名:
                    <a href="{{ route('posts.show', $post) }}" class="text-blue-600">
                        {{ $post->title }}
                    </a>
                </h1>
                <hr class="w-full">
                <p class="mt-4 p-4">
                    {{ $post->body }}
                </p>
                <div class="p-4 text-sm font-semibold">
                    <p>
                        {{ $post->created_at }} / {{ $post->user->name ?? '' }}
                    </p>
                </div>
            </div>
        @endforeach
        <div class="mb4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
