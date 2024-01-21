@extends('layouts.common')
@section('title')
<title>会員登録</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
@section('content')
<div class="signin-form__title">
    <h1>会員登録</h1>
</div>
@if (count($errors) > 0)
<p>入力に問題があります</p>
@endif
<form class="signin-form" action="/register/form" method="post">
    @csrf
    <div class="signin-form__form">
        @error('name')
        <p>{{$errors->first('name')}}</p>
        @enderror
        <div class="signin-form__password">
            <input type="text" class="form--control" name="name" value="{{ old('name') }}" placeholder="名前">
        </div>
        @error('email')
        <p>{{$errors->first('email')}}</p>
        @enderror
        <div class="signin-form__password">
            <input type="email" class="form--control" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
        </div>
        @error('password')
        <p>{{$errors->first('password')}}</p>
        @enderror
        <div class="signin-form__password">
            <input type="password" name="password" class="form--control" placeholder="パスワード">
        </div>
        @error('password_confirmation')
        <p>{{$errors->first('password_confirmation')}}</p>
        @enderror
        <div class="signin-form__password">
            <input type="password" name="password_confirmation" class="form--control" placeholder="確認用パスワード">
        </div>
        <div class="form--button">
            <button type="submit">会員登録</button>
        </div>
    </div>

    <div class="signin-form__link">
        <p>アカウントをお持ちの方はこちらから</p>
        <a href="{{ route('login') }}">ログイン</a>
    </div>

</form>
@endsection