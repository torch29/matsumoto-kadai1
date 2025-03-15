@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection


@section('content')
<div class="contact-form__content">
    <div class="contact-form__title">
        <h2>Contact</h2>
    </div>
    <form action="/confirm" class="contact-form" method="post">
    @csrf
        <div class="contact-form__group">
            <div class="form__group-title">
                <label for="name" class="form__label--item">お名前</label>
                <p class="form__label--required">※</p>
            </div>
            <div class="contact-form__group-content">
                <div class="form__input--text">
                    <input type="text" name="last_name" id="name" placeholder="例：山田" value="{{ old('last_name') }}">
                    <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}">
                </div>
                @error('last_name')
                {{ $message }}
                @enderror
                @error('first_name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="contact-form__group">
            <div class="form__group-title">
                <span class="form__label--item-span">性別</span>
                <p class="form__label--required">※</p>
            </div>
            <div class="contact-form__group-content">
                <div class="form__input--text">
                    <input type="radio" name="gender" id="gender1" value="1"  checked>
                    <label for="gender1">男性</label>
                    <input type="radio" name="gender" id="gender2" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>
                    <label for="gender2">女性</label>
                    <input type="radio" name="gender" id="gender3" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>
                    <label for="gender3">その他</label>
                </div>
                @error('gender')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="contact-form__group">
            <div class="form__group-title">
                <label for="email" class="form__label--item">メールアドレス</label>
                <p class="form__label--required">※</p>
            </div>
            <div class="contact-form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" id="email" placeholder="例：test@example.com" value="{{ old('email') }}">
                </div>
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="contact-form__group">
            <div class="form__group-title">
                <label for="tel1" class="form__label--item">電話番号</label>
                <p class="form__label--required">※</p>
            </div>
            <div class="contact-form__group-content">
                <div class="form__input--text">
                    <input type="tel" name="tel1" id="tel1" placeholder="080" value="{{ old('tel1') }}">
                    <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                    <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                </div>
                @if ($errors->has('tel_group'))
                    @foreach ($errors->get('tel_group') as $error)
                        <div class="error">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="contact-form__group">
            <div class="form__group-title">
                <label for="address" class="form__label--item">住所</label>
                <p class="form__label--required">※</p>
            </div>
            <div class="contact-form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" id="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                </div>
                @error('address')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="contact-form__group">
            <div class="form__group-title">
                <label for="building" class="form__label--item">建物名</label>
                <p class="form__label--required">※</p>
            </div>
            <div class="contact-form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" id="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
                @error('building')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="contact-form__group">
            <div class="form__group-title">
                <label class="form__label--item">お問い合わせの種類</label>
                <p class="form__label--required">※</p>
            </div>
            <div class="contact-form__group-content">
                <div class="form__input--text">
                    <select class="form__item-select" name="category_id" value="">
                        <option value="" selected>選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="contact-form__group">
            <div class="form__group-title">
                <label for="detail" class="form__label--item">お問い合わせ内容</label>
                <p class="form__label--required">※</p>
            </div>
            <div class="contact-form__group-content">
                <div class="form__input--text">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                </div>
                @error('detail')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
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

@endsection