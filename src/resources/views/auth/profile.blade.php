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
<div class="profile-entry__content">
    <div class="section__title">
        <h2>Profile</h2>
    </div>

    <form action="/profile_entry" class="profile-form" method="post">
        @csrf
        <div class="profile-form__item">
            <label for="name" class="profile-form__item-label">お名前：</label>
            {{--var_dump($id)--}}
            {{--dump($user->name)--}}
            <p>{{ ($user->name) }}さん</p>
            <p>プロフィールをご登録ください。</p>
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            {{--var_dump($inputs)--}}
        </div>
        <div class="profile-form__group">
            <div class="profile-form__group-title">
                <span class="form__label--item-span">性別</span>
            </div>
            <div class="profile-form__group-content">
                <div class="radio-btn-area">
                    <div class="radio-btn">
                        <input type="radio" name="gender" id="gender1" value="1" class="form__input--radio-btn" checked>
                        <label for="gender1"><span>男性</span></label>
                    </div>
                    <div class="radio-btn">
                        <input type="radio" name="gender" id="gender2" value="2" {{ old('gender') == 2 ? 'checked' : '' }} class="form__input--radio-btn">
                        <label for="gender2"><span>女性</span></label>
                    </div>
                    <div class="radio-btn">
                        <input type="radio" name="gender" id="gender3" value="3" {{ old('gender') == 3 ? 'checked' : '' }} class="form__input--radio-btn">
                        <label for="gender3"><span>その他</span></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-form__item">
            <label for="" class="profile-form__item-label">生年月日</label>
            <input type="date" name="birthday">
            {{--<input type="text" name="birthday" placeholder="1950/01/01">--}}
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">プロフィール登録</button>
        </div>
</div>
</form>

@endsection