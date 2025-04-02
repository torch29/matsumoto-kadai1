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

    {{--<div class="profile__alert">
        @if(session('message'))
        <div class="profile__alert--success">
            {{ session('message') }}
</div>
@endif
</div>--}}

{{--adminに最初書いてた検索フォーム--}}
<form action="/search" class="search-form" method="get">
    @csrf
    <div class="search-form__item">
        <input type="text" class="search-form__item-input" name="keyword" value="" placeholder="名前やメールアドレスを入力してください">
        <div class="select__wrapper">
            <select name="gender_select" class="search-form__item-select">
                <option value="" selected>性別</option>
                <option value="9">全て</option>
                @foreach ($genders as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
        <div class="select__wrapper">
            <select name="category_select" class="search-form__item-select">
                <option value="" selected>お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="select__wrapper">
            <input type="date" name="date" class="search-form__item-select" value="年/月/日">
        </div>
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

{{--adminsの問い合わせ内容テーブル--}}
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

                {{--CSSでのモーダルテスト追記--}}
                <a href="#{{ $contact->id }}" class="contact-table__detail-button">詳細</button>

                    <div class="test-modal" id="{{ $contact->id }}">
                        <div class="test-modal__wrapper">
                            <a href="#" class="test-modal__close-button">×</a>
                            <div class="test-modal__content--detail">
                                {{--モーダルダイアログの内容ここから--}}
                                <table class="modal__content">
                                    <tr class="modal-table__row">
                                        <th class="modal-table__heading">お名前</th>
                                        <td class="modal-table__item">
                                            {{ $contact->last_name . ' ' . $contact->first_name }}
                                        </td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__heading">性別</th>
                                        <td class="modal-table__item">{{ $genders[$contact->gender] }}</td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__heading">メールアドレス</th>
                                        <td class="modal-table__item">{{ $contact->email }}</td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__heading">電話番号</th>
                                        <td class="modal-table__item">{{ $contact->tel }}</td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__heading">住所</th>
                                        <td class="modal-table__item">{{ $contact->address }}</td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__heading">建物名</th>
                                        <td class="modal-table__item">{{ $contact->building }}</td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__heading">お問い合わせの種類</th>
                                        <td class="modal-table__item">{{ $contact->category->content }}</td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__heading">お問い合わせ内容</th>
                                        <td class="modal-table__item">{{ $contact->detail }}</td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__heading">アンケートの回答</th>
                                        <td class="modal-table__item">
                                            {{ $contact->channels->pluck('content')->implode('，') }}
                                        </td>
                                    </tr>
                                    <tr class="modal-table__row">
                                        <th class="modal-table__heading">画像</th>
                                        <td class="modal-table__item">
                                            @if ($contact->img_path)
                                            <img src="{{ asset(str_replace('public/', 'storage/', $contact->img_path)) }}" width="40%">
                                            @else
                                            <p>画像は送信されていません。</p>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <form action="/delete" class="test-modal__form" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class="delete__button">
                                        <input type="hidden" name="id" value="{{ $contact->id }}">
                                        <button name="deleteContact" class="delete__button-submit" type="submit">削除</button>
                                    </div>
                                </form>
                                {{--モーダルダイアログの内容ここまで--}}
                            </div>
                        </div>
                    </div>
                    {{--CSSでのモーダルテスト追記ここまで--}}

                    {{--元のボタン
                    <button class="contact-table__item-button">詳細</button>
--}}
            </td>
        </tr>
        @endforeach
    </table>
</div>
</div>

{{-- ここから追記 bootstrapによるmodal
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                    </button>

                    <div class="modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Modal body text goes here.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

追記ここまで --}}


@endsection

@section('modal')
<livewire:modal>
    @endsection