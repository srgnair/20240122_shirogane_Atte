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

<!-- @if (session('status') == 'verification-link-sent')
<div class="mb-4 font-medium text-sm text-green-600">
    新しい認証メールが送信されました。
</div>
@endif

<div class="mt-4 flex items-center justify-between">
    <form method="POST" action="/email/verification-notification">
        @csrf

        <div>
            <button type="submit">
                認証メールを再送する
            </button>
        </div>
    </form>

    <form method="POST" action="/logout">
        @csrf

        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
            ログアウト
        </button>
    </form>
</div> -->

@endsection