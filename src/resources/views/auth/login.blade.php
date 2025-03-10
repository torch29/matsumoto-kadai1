@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('admin')
    <div class="header-utilities">
        <form action="/register" class="header-utilities__button" method="get">
        @csrf
            <button class="header-utilities__button-submit" type="submit">register</button>
        </form>
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
            <input type="email" name="email" class="login-form__item-input">
            <div class="form__error">エラー表示エリア</div>
        </div>
        <div class="login-form__item">
            <label for="password" class="login-form__item-label">パスワード</label>
            <input type="password" name="password" class="login-form__item-input">
            <div class="form__error">エラー表示エリア</div>
        </div>
        <div class="login-form__button">
            <form action="" class="header-utilities__button">
            @csrf
                <button class="login-form__button-submit" type="submit">ログイン</button>
            </form>
        </div>
    </form>


</div>
@endsection