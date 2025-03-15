<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cardo&display=swap" rel="stylesheet">
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
        @yield('auth')
    </div>
</header>

<main>
    @yield('content')
</main>

@livewireScripts
@yield('modal')
</body>
</html>