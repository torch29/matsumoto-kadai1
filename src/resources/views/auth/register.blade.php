@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('auth')
<div class="header-utilities">
    <button class="header-utilities__button" type="button" onclick="location.href='/login'">login</button>
</div>
@endsection

@section('content')
<div class="register__content">
    <div class="section__title">
        <h2>Register</h2>
    </div>

    <form action="/register" class="register-form" method="post">
        @csrf
        <div class="register-form__item">
            <label for="name" class="register-form__item-label">お名前</label>
            <input type="text" name="name" id="name" class="register-form__item-input" value="{{ old('name') }}" placeholder="例: 山田 太郎">
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="register-form__item">
            <label for="email" class="register-form__item-label">メールアドレス</label>
            <input type="email" name="email" id="email" class="register-form__item-input" value="{{ old('email') }}" placeholder="例: test@example.com">
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="register-form__item">
            <label for="password" class="register-form__item-label">パスワード</label>
            <input type="password" name="password" id="password" class="register-form__item-input" placeholder="例: coachtech1234">
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="register-form__button">
            <input type="hidden" name="id">
            <button class="register-form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection