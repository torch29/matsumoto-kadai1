@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('admin')
    <div class="header-utilities">
        <button class="header-utilities__button-link" type="button" onclick="location.href='/login'">login</button>
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
            <input type="text" name="name" class="register-form__item-input" value="{{ old('name') }}">
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="register-form__item">
            <label for="email" class="register-form__item-label">メールアドレス</label>
            <input type="email" name="email" class="register-form__item-input" value="{{ old('email') }}">
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="register-form__item">
            <label for="password" class="register-form__item-label">パスワード</label>
            <input type="password" name="password" class="register-form__item-input">
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="register-form__button">
            <button class="register-form__button-submit" type="submit">登録</button>
        </div>
    </form>

{{--エラーあれば表示、確認用、後で消す--}}
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@endsection