@extends('layouts.common')
@section('title')
<title>登録完了</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endsection
@section('content')
<form class="register-complete__content" action="/conpletion" method="post">
    @csrf
    <div class="register-complete__title">
        <h1>登録が完了しました</h1>
    </div>

    <div class="register-complete__link">
        <p>こちらからログインしてください</p>
        <a href="{{ route('login') }}">ログイン</a>
    </div>

</form>
@endsection