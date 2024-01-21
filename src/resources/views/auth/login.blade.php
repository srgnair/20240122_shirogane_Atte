@extends('layouts.common')
@section('title')
<title>ログイン</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')

<div class="signin-form__title">
    <h1>ログイン</h1>
</div>
@if (count($errors) > 0)
<p>入力に問題があります</p>
@endif
<form class="signin-form" method="POST" action="/login">
    @csrf
    <div class="signin-form__container">
        @error('email')
        <p>{{$errors->first('email')}}</p>
        @enderror
        <div class="signin-form__email">
            <input type="email" name="email" value="{{ old('email') }}" class="signin-form__control" placeholder="メールアドレス">
        </div>
        @error('password')
        <p>{{$errors->first('password')}}</p>
        @enderror
        <div class="signin-form__password">
            <input type="password" name="password" class="signin-form__control" placeholder="パスワード">
        </div>

        @error('email_verified_at')
        <p>{{$errors->first('mail_verified_at')}}</p>
        @enderror
        <div class="signin-form__button">
            <button type="submit">ログイン</button>
        </div>

    </div>

</form>

<div class="signin-form__link">
    <p>アカウントをお持ちでない方はこちらから</p>
    <a href="{{ route('registerForm') }}">会員登録</a>
</div>
@endsection