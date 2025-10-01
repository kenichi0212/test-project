<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            個別表示
        </h2>
    </x-slot>
    <div class="mx-auto px-6">
        @if (session('message'))
            <div class="p-4 font-bold text-red-600">
                {{ session('message') }}
            </div>
        @endif
        <div class="round-2xl w-full bg-white">
            <div class="mt-4 p-4">
                <h1 class="text-lg font-semibold">
                    {{ $post->title }}
                </h1>
                @if ($post->user_id === Auth::id())
                    <div class="flex text-right">
                        <a href="{{ route('posts.edit', $post) }}" class="flex-1">
                            <x-primary-button>
                                編集
                            </x-primary-button>
                        </a>

                        <form method="post" action="{{ route('posts.destroy', $post) }}" class=flex-2>
                            @csrf
                            @method('delete')
                            <x-primary-button class="ml-2 bg-red-700">
                                削除
                            </x-primary-button>
                        </form>
                    </div>
                @endif
                <hr class="w-full">
                <p class="whitespase-pre-line mt-4">
                    {{ $post->body }}
                </p>
                <div class="flex flex-row-reverse text-sm font-semibold">
                    <p> {{ $post->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
