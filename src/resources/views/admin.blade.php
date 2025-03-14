@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('admin')
<div class="header-utilities">
    <form action="/logout" class="header-utilities__button" method="post">
    @csrf
        <button class="header-utilities__button-submit" type="submit">logout</button>
    </form>
    <h3>てすと</h3>
</div>
@endsection

@section('content')
<div>


adminに最初書いてた検索フォーム（adminsubに保存）
    <form action="/contacts/search" class="search-form" method="get">
    @csrf
        <div class="search-form__item">
            <input type="text" class="search-form__item-input" name="keyword" value="{{ old('keyword') }}">
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
            <input type="date" name="date" value="年/月/日">
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
        <p>ページネーション</p>
        {{ $contacts->links() }}
        </div>
    </div>

adminsubの問い合わせ内容テーブル表示
    <div class="contact-table__content">
        <table class="contact-table">
            <tr class="contact-table__row">
                <th class="contact-table__header">お名前</th>
                <th class="contact-table__header">性別</th>
                <th class="contact-table__header">メールアドレス</th>
                <th class="contact-table__header">お問い合わせの種類</th>
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


<div>
    ///adminに移動したmodalに書くべき検索フォーム
    <div>
    <form action="/contacts/search" class="search-form" method="get">
    {{--<form wire:submit.prevent="search" class="search-form">--}}
        @csrf
        <div class="search-form__item">
            <input type="text" class="search-form__item-input" wire:model="keyword" value="{{ old('keyword') }}">
            <select wire:model="gender_select" class="search-form__item-select">
                <option value="" selected>性別</option>
                <option value="9">全て</option>
                    @foreach ($genders as $key => $val)
                    {{--@foreach ($genders as $gender)--}}
                        {{--<option value="{{ $gender }}">{{ $gender }}</option>--}}
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
            </select>
            <select wire:model="category_select" class="search-form__item-select">
                <option value="" selected>お問い合わせの種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                    @endforeach
            </select>
            <input type="date" wire:model="date" value="年/月/日">
        </div>
        <div class="search-form__button">
            <button class="search-form__button-search" type="submit">検索</button>
            <button class="search-form__button-reset" type="reset" type="button" onclick="location.href='/admin'">リセット</button>
            
            {{--<button type="button" class="search-form__button-reset" wire:click="resetSearch">リセット</button>--}}
        </div>
</form>
</div>

@endsection

@section('modal')
<livewire:modal>
@endsection