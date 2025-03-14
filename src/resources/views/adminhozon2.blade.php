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

@section('modal')
<livewire:modal>
@endsection