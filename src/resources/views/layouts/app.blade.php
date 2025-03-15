<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    </head>
    @yield('css')
    @livewireStyles
</head>

<body>

<header class="header">
    <div class="header__inner">
        <div class="header__logo">
            <p>FashionablyLate</p>
        </div>
        @yield('admin')
    </div>
</header>

<main>
    @yield('content')
</main>

@livewireScripts
@yield('modal')
</body>
</html>