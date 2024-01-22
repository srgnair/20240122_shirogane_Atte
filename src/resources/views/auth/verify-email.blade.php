@extends('layouts.common')
@section('title')
<title>登録完了</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endsection
@section('content')

<div class="verify__content">
    入力されたメールアドレスに認証メールを送信しました。<br>
    メール内の「認証する」をクリックすると認証が完了します。
</div>

@endsection