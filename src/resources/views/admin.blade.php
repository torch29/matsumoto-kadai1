@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('admin')
<div class="header-utilities">
    <form action="" class="header-utilities__button">
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

{{--検索フォーム--}}
    <form action="" class="search-form" method="post">
    @csrf
        <div class="search-form__item">
            <input type="text" class="search-form__item-input" name="content" value="{{ old('content') }}">
            <select name="gender" class="search-form__item-select">
                <option value="性別" class="value">性別</option>
            </select>
            <select name="category_id" class="search-form__item-select">
                <option value="">お問い合わせの種類</option>
            </select>
            <select name="created_at" class="search-form__item-select">
                <option value="">年/月/日</option>
            </select>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-search">検索</button>
            <button class="search-form__button-reset">リセット</button>
        </div>
    </form>

    <div class="nav-area">
        <div class="nav__export-button">
            <button class="export-button__submit">エクスポート</button>
        </div>
        <div class="nav__page-link">
        <p>ページネーション</p>
        {{--{{ $authors->links() }}--}}
        </div>
    </div>

{{--問い合わせ内容テーブル表示--}}
    <div class="contact-table__content">
        <table class="contact-table">
            <tr class="contact-table__row">
                <th class="contact-table__header">お名前</th>
                <th class="contact-table__header">性別</th>
                <th class="contact-table__header">メールアドレス</th>
                <th class="contact-table__header">お問い合わせの種類</th>
            </tr>
            <tr class="contact-table__row">
                <td class="contact-table__item">苗字</td>
                <td class="contact-table__item">名前</td>
                <td class="contact-table__item">性別</td>
                <td class="contact-table__item">メールアドレス</td>
                <td class="contact-table__item">問い合わせカテゴリ</td>
                <td class="contact-table__item">詳細</td>
            </tr>
        </table>
    </div>
</div>
@endsection
