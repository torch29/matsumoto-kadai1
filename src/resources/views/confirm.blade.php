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
                        <input type="text" name="name" value="サンプルテキスト　山田　太郎" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading">性別</th>
                    <td class="confirm-table__item">
                        <input type="text" name="gender" value="サンプルテキスト　男性" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading">メールアドレス</th>
                    <td class="confirm-table__item">
                        <input type="email" name="email" value="サンプルテキスト　tes@example.com" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading"></th>
                    <td class="confirm-table__item">
                        <input type="tel" name="tel" value="サンプルテキスト　08012345678" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading"></th>
                    <td class="confirm-table__item">
                        <input type="text" name="address" value="サンプルテキスト　東京都仙田方1-2-3" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading"></th>
                    <td class="confirm-table__item">
                        <input type="text" name="building" value="サンプルテキスト　千駄ヶ谷マンション101" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading"></th>
                    <td class="confirm-table__item">
                        <input type="text" name="building" value="サンプルテキスト　商品の交換について" readonly>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__heading"></th>
                    <td class="confirm-table__item">
                        <input type="text" name="building" value="サンプルテキスト　届いた商品が注文した商品ではありませんでした。交換をお願いします。" readonly>
                    </td>
                </tr>
            </table>
        </div>
        <div class="confirm__button">
            <button class="confirm__button-submit" type="submit">送信</button>
        {{--</div>
        <div class="confirm__button">--}}
            <input type="hidden" >
            <button class="confirm__button-back">修正</button>
        </div>
    </form>
@endsection