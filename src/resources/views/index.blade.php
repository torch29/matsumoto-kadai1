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
            </div>
        </div>
        <div class="contact-form__group">
            <div class="form__group-title">
                <span class="form__label--item-span">性別</span>
                <p class="form__label--required">※</p>
            </div>
            <div class="contact-form__group-content">
                <div class="form__input--text">
                    <input type="radio" name="gender" id="gender1" checked >
                    <label for="gender1">男性</label>
                    <input type="radio" name="gender" id="gender2">
                    <label for="gender2">女性</label>
                    <input type="radio" name="gender" id="gender3">
                    <label for="gender3">その他</label>
                </div>
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
            </div>
        </div>
        <div class="contact-form__group">
            <div class="form__group-title">
                <label class="form__label--item">お問い合わせの種類</label>
                <p class="form__label--required">※</p>
            </div>
            <div class="contact-form__group-content">
                <div class="form__input--text">
                    <select class="form__item-select" name="category_id" value="選択してください">
                        <option value="" selected>選択してください</option>
                    </select>
                </div>
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
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
@endsection