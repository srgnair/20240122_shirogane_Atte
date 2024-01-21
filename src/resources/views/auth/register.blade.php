@extends('layouts.common')
@section('title')
<title>入力内容確認</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection
@section('content')
<div class="register-form__title">
    <h1>内容確認</h1>
    <p>内容を確認して送信ボタンを押してください</p>
</div>

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form class="register-form" action="/register" method="POST">
    @csrf
    <div class="register-form__form">
        <div class="register-form__item">
            <label for="name">名前</label>
            <input class="register-form__item--control" type="text" name="name" value="{{ $user['name'] }}" readonly />
        </div>
        <div class="register-form__item">
            <label for="email">メールアドレス</label>
            <input class="register-form__item--control" type="email" name="email" value="{{ $user['email'] }}" readonly />
        </div>
        <div class="register-form__item">
            <label for="password">パスワード</label>
            <input class="register-form__item--control" type="password" name="password" value="{{ $user['password'] }}" readonly />
        </div>
        <div class="register-form__item">
            <label for="password_confirmation">パスワード確認</label>
            <input class="register-form__item--control" type="password" name="password_confirmation" value="{{ $user['password_confirmation'] }}" readonly />
        </div>

        <div class="register-form__link">
            <button type="submit">送信</button>
        </div>

        <div class="register-form__button--correct">
            <a onClick="history.back()">修正する</a>
        </div>

    </div>

</form>
@endsection