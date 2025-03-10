@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('admin')
    <div class="header-utilities">
        <form action="" class="header-utilities__button">
        @csrf
            <button class="header-utilities__button-submit" type="submit">register</button>
        </form>
    </div>
@endsection

@section('content')
@endsection