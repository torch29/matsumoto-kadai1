<div>
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

{{--問い合わせ内容テーブル表示--}}
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
                    <button wire:click="openModal()" type="button" class="contact-table__item-button">詳細</button>

    @if($showModal)
        <div class="modal-dialog">
            <button wire:click="closeModal()" type="button">×</button>
            <table class="modal__content">
                <tr class="modal-table__row">
                    <th class="modal-table__heading">お名前</th>
                    <td class="modal-table__item">
                        {{ $contact->last_name }}
                        {{ $contact->first_name }}
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
            </table>
            <form action="/delete" class="form" method="post">
            @method('delete')
            @csrf
                <div class="delete__button">
                    <input type="hidden" name="id">
                    <button class="delete__button-submit" type="submit">削除</button>
                </div>
            </form>
        </div>
        
    @endif
</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>