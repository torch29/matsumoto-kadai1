@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

@section('auth')
<div class="header-utilities">
    <form action="/logout" class="header-utilities__button" method="post">
    @csrf
        <button class="header-utilities__button-submit" type="submit">logout</button>
    </form>
</div>
@endsection

@section('content')
<div class="admin__content">
    <div class="section__title">
        <h2>Admin</h2>
    </div>

adminに最初書いてた検索フォーム
    <form action="/contacts/search" class="search-form" method="get">
    @csrf
        <div class="search-form__item">
            <input type="text" class="search-form__item-input" name="keyword" value="{{ old('keyword') }}"  placeholder="名前やメールアドレスを入力してください">
            <select name="gender_select" class="search-form__item-select">
                <option value="" selected>性別</option>
                <option value="9">全て</option>
                    @foreach ($genders as $key => $val)
                    {{--@foreach ($genders as $gender)--}}
                        {{--<option value="{{ $gender }}">{{ $gender }}</option>--}}
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
            </select>
            <select name="category_select" class="search-form__item-select">
                <option value="" selected>お問い合わせの種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                    @endforeach
            </select>
            <input type="date" name="date" class="search-form__item-select" value="年/月/日">
        </div>
        <div class="search-form__button">
            <button class="search-form__button-search">検索</button>
            <button class="search-form__button-reset" type="reset" type="button" onclick="location.href='/admin'">リセット</button>
        </div>
    </form>

    <div class="nav-area">
        <div class="nav__export-button">
            <button class="export-button__submit">エクスポート</button>
        </div>
        <div class="nav__page-link">
            {{ $contacts->links('vendor.pagination.admin-bootstrap') }}
        </div>
    </div>

adminsの問い合わせ内容テーブル
    <div class="contact-table__content">
        <table class="contact-table">
            <tr class="contact-table__row">
                <th class="contact-table__header" colspan="2">お名前</th>
                <th class="contact-table__header">性別</th>
                <th class="contact-table__header">メールアドレス</th>
                <th class="contact-table__header" colspan="2">お問い合わせの種類</th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="contact-table__row">
                <td class="contact-table__item">
                    {{ $contact->last_name }}
                </td>
                <td class="contact-table__item">
                    {{ $contact->first_name }}
                </td>
                <td class="contact-table__item">
                    {{ $genders[$contact->gender] }}
                </td>
                <td class="contact-table__item">
                    {{ $contact->email }}
                </td>
                <td class="contact-table__item">
                    {{ $contact->category->content }}
                </td>
                <td class="contact-table__item">
                    <button class="contact-table__item-button">詳細</button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection

@section('modal')
<livewire:modal>
@endsection