@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('auth')
    <div class="header-utilities">
        <button class="header-utilities__button" type="button" onclick="location.href='/register'">register</button>
    </div>
@endsection

@section('content')
<div class="login__content">
    <div class="section__title">
        <h2>Login</h2>
    </div>

    <form action="/login" class="login-form" method="post">
    @csrf
        <div class="login-form__item">
            <label for="email" class="login-form__item-label">メールアドレス</label>
            <input type="email" name="email" id="email" class="login-form__item-input" value="{{ old('email') }}" placeholder="例: test@example.com">
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="login-form__item">
            <label for="password" class="login-form__item-label">パスワード</label>
            <input type="password" name="password" id="password" class="login-form__item-input" placeholder="例: coachtech1234">
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="login-form__button">
            <button class="login-form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection