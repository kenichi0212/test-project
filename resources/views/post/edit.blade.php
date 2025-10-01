<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            フォーム
        </h2>
    </x-slot>
    <div class="mx-auto max-w-7xl px-6">
        @if (session('message'))
            <div class="font-bold text-red-600">
                {{ session('message') }}
            </div>
        @endif
        <form method="post" action="{{ route('post.update', $post) }}">
            @csrf
            @method('patch')
            <div class="mt-8">
                <div class="flex w-full flex-col">
                    <label for="title" class="mt-4 font-semibold">件名</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <input type="text" name="title" class="w-auto rounded-md border border-gray-300 py-2"
                        id="title" value="{{ old('title', $post->title) }}">
                </div>
            </div>

            <div class="flex w-full flex-col">
                <label for="body" class="mt-4 font-semibold">本文</label>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                <textarea name="body" class="w-auto rounded-md border border-gray-300 py-2" id="body" cols="30"
                    rows="5">{{ old('body', $post->body) }}</textarea>
            </div>

            <x-primary-button class="mt-4">
                送信する
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
