<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>

<header class="header">
    <div class="header__inner">
        <div class="header__logo">
            <a href="/">FashionablyLate</a>
        </div>
        <div class="header-utilities">
            <form action="" class="header-utilities__button">
            @csrf
                <button class="header-utilities__button-submit" type="submit">register</button>
            </form>
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

</body>
</html>