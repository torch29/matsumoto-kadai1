
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
                    <button wire:click="openModal({{ $contact->id }})" type="button" class="contact-table__item-button">詳細</button>

                </td>
            </tr>
            @endforeach

{{--モーダルウィンドウ--}}
    @if($showModal && $selectedContact)
    <div class="modal-dialog">
        <table class="modal__content">
            <button wire:click="closeModal()" type="button">×</button>
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
                <button wire:click="deleteContact" class="delete__button-submit" type="button">削除</button>
            </div>
        @endif
        </table>
    </div>
</div>