@extends('layouts.common')
@section('title')
<title>打刻システム</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/timestamp.css') }}">
@endsection
@section('content')
<div class="name">
    @if (Auth::check())
    <h2>{{ Auth::user()->name }}さんお疲れ様です！</h2>

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if(session('my_status'))
    <div class="alert alert-success">
        {{ session('my_status') }}
    </div>
    @endif

    @endif
</div>

<div class="timestamp__wrapper">
    <div class="box1">
        <form action="/start" method="POST">
            @csrf
            @method('POST')
            <button type="submit">勤務開始</button>
        </form>
    </div>
    <div class="box2">
        <form action="/end" method="POST">
            @csrf
            @method('POST')
            <button type="submit">勤務終了</button>
        </form>
    </div>
    <div class="box3">
        <form action="/reststart" method="POST">
            @csrf
            @method('POST')
            <button type="submit">休憩開始</button>
        </form>
    </div>
    <div class="box4">
        <form action="/restend" method="POST">
            @csrf
            @method('POST')
            <button type="submit">休憩終了</button>
    </div>
</div>
@endsection