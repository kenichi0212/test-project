<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            <!-- フォームやコンテンツ本体は、ここで {{ $slot }} として受け取られます -->
            {{ $slot }}
        </main>
    </div>

    <!-- スクロールアップボタンのHTMLとJavaScriptをコンポーネントレイアウトの閉じタグの前に移動 -->
    <button id="to-top-button"
        class="pointer-events-none fixed bottom-14 right-8 z-50 rounded-full bg-blue-500 p-3 text-white opacity-0 shadow-lg transition-opacity duration-300 hover:bg-blue-600"
        onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>
    <script>
        // ボタン要素を、HTML要素が読み込まれた後に取得
        const toTopButton = document.getElementById('to-top-button');

        // どのくらいスクロールしたらボタンを表示するか (例: 300px)
        const scrollThreshold = 300;

        // スクロールイベントリスナーを追加
        window.addEventListener('scroll', () => {
            if (window.scrollY > scrollThreshold) {
                // スクロール量が閾値を超えたらボタンを表示
                toTopButton.classList.remove('opacity-0', 'pointer-events-none');
                toTopButton.classList.add('opacity-100');
            } else {
                // 閾値以下の場合はボタンを非表示
                toTopButton.classList.remove('opacity-100');
                toTopButton.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        // ページロード時にも一度チェックし、ボタンが非表示であることを確認
        if (window.scrollY === 0) {
            toTopButton.classList.add('pointer-events-none');
        }
    </script>
</body>

</html>
