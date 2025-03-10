@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('admin')
    <div class="header-utilities">
        <form action="/login" class="header-utilities__button">
        @csrf
            <button class="header-utilities__button-submit" type="submit">login</button>
        </form>
    </div>
@endsection

@section('content')
<div class="register__content">
    <div class="section__title">
        <h2>Register</h2>
    </div>

    <form action="" class="register-form" method="post">
    @csrf
        <div class="register-form__item">
            <label for="name" class="register-form__item-label">お名前</label>
            <input type="text" name="name" class="register-form__item-input">
            <div class="form__error">エラー表示エリア</div>
        </div>
        <div class="register-form__item">
            <label for="email" class="register-form__item-label">メールアドレス</label>
            <input type="email" name="email" class="register-form__item-input">
            <div class="form__error">エラー表示エリア</div>
        </div>
        <div class="register-form__item">
            <label for="password" class="register-form__item-label">パスワード</label>
            <input type="password" name="password" class="register-form__item-input">
            <div class="form__error">エラー表示エリア</div>
        </div>
        <div class="register-form__button">
            <button class="register-form__button-submit" type="submit">登録</button>
        </div>
    </form>


</div>
@endsection