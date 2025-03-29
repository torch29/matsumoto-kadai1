@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection


@section('content')
<div class="confirm-form__content">
    <div class="confirm-form__title">
        <h2>Confirm</h2>
    </div>
    <form action="/thanks" class="confirm-form" method="post">
    @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading">お名前</th>
                    <td class="confirm-table__item">
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                        <input type="text" value="{{ $contact['last_name'] . '　' . $contact['first_name'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading">性別</th>
                    <td class="confirm-table__item">
                        <input type="text" name="gender" value="{{ $genders[$contact['gender']] }}" readonly>
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading">メールアドレス</th>
                    <td class="confirm-table__item">
                        <input type="email" name="email" value="{{ $contact['email'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading"></th>
                    <td class="confirm-table__item">
                        <input type="tel" name="tel" value="{{ $contact['tel'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading"></th>
                    <td class="confirm-table__item">
                        <input type="text" name="address" value="{{ $contact['address'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading"></th>
                    <td class="confirm-table__item">
                        <input type="text" name="building" value="{{ $contact['building'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading"></th>
                    <td class="confirm-table__item">
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                        <input type="text" value="{{ $category['content'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading"></th>
                    <td class="confirm-table__item">
                        <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading"></th>
                    <td class="confirm-table__item">
                        {{-- アンケートの名称表示用 --}}
                        <input type="text" value="{{implode('，', $channelNames)}}" readonly>

                        @foreach($contact['channel_ids'] as $channel_id)
                            <input type="hidden" name="channel_ids[]" value="{{ $channel_id }}">
                        {{-- dump($channel_id) --}}
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>
        <div class="confirm__button">
            <button class="confirm__button-submit" type="submit">送信</button>
        {{--</div>
        <div class="confirm__button">--}}
            <input type="hidden" >
            <button class="confirm__button-back" type="button" onclick="history.back(-1)">修正</button>
        </div>
    </form>
@endsection