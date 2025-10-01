<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            フォーム
        </h2>
    </x-slot>
    <div class="mx-auto max-w-7xl px-6">


        <x-message :message="session('message')" />

        <form method="post" action="{{ route('posts.store') }}">
            @csrf
            <div class="mt-8">
                <div class="flex w-full flex-col">
                    <label for="title" class="mt-4 font-semibold">件名</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <input type="text" name="title" class="w-full rounded-md border border-gray-300 px-3 py-2"
                        id="title" value="{{ old('title') }}" required>
                </div>
            </div>

            <div class="flex w-full flex-col">
                <label for="body" class="mt-4 font-semibold">本文</label>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                <textarea name="body" class="w-full rounded-md border border-gray-300 px-3 py-2" id="body" cols="30"
                    rows="5" required>{{ old('body') }}</textarea>
            </div>

            <button type="submit"
                class="mt-4 inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900">
                送信する
            </button>
        </form>
    </div>
</x-app-layout>
