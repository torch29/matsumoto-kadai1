<div>
    {{--ここからmodalの表示--}}
    {{--<form action="/admin" class="search-form" method="get">--}}
    <form wire:submit.prevent="wireSearch" class="search-form">
        @csrf
        <div class="search-form__item">
            <input type="text" class="search-form__item-input" wire:model.defer="keyword" value="{{ $keyword }}" placeholder="名前やメールアドレスを入力してください">
            <div class="select__wrapper">
                <select wire:model.defer="gender_select" class="search-form__item-select">
                    <option value="" selected>性別</option>
                    <option value="9">全て</option>
                    @foreach ($genders as $key => $val)
                    <option value="{{ $key }}" {{ $key == $gender_select ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
            <div class="select__wrapper">
                <select wire:model.defer="category_select" class="search-form__item-select">
                    <option value="" selected>お問い合わせの種類</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}" {{ $category['id'] == $category_select ? 'selected' : '' }}>{{ $category['content'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="select__wrapper">
                <input type="date" wire:model.defer="date" class="search-form__item-select" value="{{ $date }}">
            </div>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-search" type="submit">検索</button>
            <button class="search-form__button-reset" type="reset" type="button" onclick="location.href='/admin'">リセット</button>
            {{--<button type="button" class="search-form__button-reset" wire:click="resetSearch">リセット</button>--}}
        </div>
    </form>

    <div class="nav-area">
        <div class="nav__export-button">
            <button class="export-button__submit">エクスポート</button>
        </div>
        <div class="nav__page-link">
            {{ $contacts->links('vendor.livewire.bootstrap') }}
            {{--リアルタイムでない検索のとき つかう $contacts->links('vendor.pagination.admin-bootstrap') --}}
        </div>
    </div>

    {{--問い合わせ内容テーブル表示--}}
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
                    <button wire:click="openModal({{ $contact->id }})" type="button" class="contact-table__item-button">詳細</button>
                </td>
            </tr>
            @endforeach
        </table>

        {{--モーダルウィンドウ--}}
        @if($showModal && $selectedContact)
        <div class="modal-dialog">
            <div class="modal-dialog__button">
                <button wire:click="closeModal()" type="button" class="modal-dialog__button-close">×</button>
            </div>
            <table class="modal__content">
                <tr class="modal-table__row">
                    <th class="modal-table__heading">お名前</th>
                    <td class="modal-table__item">
                        {{ $selectedContact->last_name  . ' ' . $selectedContact->first_name }}
                    </td>
                </tr>
                <tr class="modal-table__row">
                    <th class="modal-table__heading">性別</th>
                    <td class="modal-table__item">{{ $genders[$selectedContact->gender] }}</td>
                </tr>
                <tr class="modal-table__row">
                    <th class="modal-table__heading">メールアドレス</th>
                    <td class="modal-table__item">{{ $selectedContact->email }}</td>
                </tr>
                <tr class="modal-table__row">
                    <th class="modal-table__heading">電話番号</th>
                    <td class="modal-table__item">{{ $selectedContact->tel }}</td>
                </tr>
                <tr class="modal-table__row">
                    <th class="modal-table__heading">住所</th>
                    <td class="modal-table__item">{{ $selectedContact->address }}</td>
                </tr>
                <tr class="modal-table__row">
                    <th class="modal-table__heading">建物名</th>
                    <td class="modal-table__item">{{ $selectedContact->building }}</td>
                </tr>
                <tr class="modal-table__row">
                    <th class="modal-table__heading">お問い合わせの種類</th>
                    <td class="modal-table__item">{{ $selectedContact->category->content }}</td>
                </tr>
                <tr class="modal-table__row">
                    <th class="modal-table__heading">お問い合わせ内容</th>
                    <td class="modal-table__item">{{ $selectedContact->detail }}</td>
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
                        @if ($selectedContact->img_path)
                        <img src="{{ asset(str_replace('public/', 'storage/', $selectedContact->img_path)) }}" width="40%">
                        @else
                        <p>画像は送信されていません。</p>
                        @endif
                    </td>
                </tr>
            </table>
            <div class="delete__button">
                <button wire:click="deleteContact" class="delete__button-submit" type="button">削除</button>
            </div>
        </div>
        @endif

    </div>