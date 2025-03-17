<div>
    {{--ここからmodalの表示--}}
    {{--<form action="/contacts/search" class="search-form" method="get">--}}
    <form wire:submit.prevent="wireSearch" class="search-form">
        @csrf
        <div class="search-form__item">
            <input type="text" class="search-form__item-input" wire:model="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください">
            <select wire:model="gender_select" class="search-form__item-select">
                <option value="" selected>性別</option>
                <option value="9">全て</option>
                    @foreach ($genders as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
            </select>
            <select wire:model="category_select" class="search-form__item-select">
                <option value="" selected>お問い合わせの種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                    @endforeach
            </select>
            <input type="date" wire:model="date" class="search-form__item-select" value="年/月/日">
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
        {{ $contacts->links('vendor.pagination.admin-bootstrap') }}
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

{{--モーダルウィンドウ--}}
    @if($showModal && $selectedContact)
    <div class="modal-dialog">
        <table class="modal__content">
            <div class="modal-dialog__button">
                <button wire:click="closeModal()" type="button" class="modal-dialog__button-close">×</button>
            </div>
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
        </table>
        <div class="delete__button">
            <button wire:click="deleteContact" class="delete__button-submit" type="button">削除</button>
        </div>
    </div>
    @endif
    </table>
</div>