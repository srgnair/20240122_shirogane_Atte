@extends('layouts.common')
@section('title')
<title>ユーザー一覧</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection
@section('content')
<div class="date__table--wrapper">

    <table class="date__table">
        <thead class="date__th">
            <tr>
                <th>ユーザーid</th>
                <th>名前</th>
                <th>email</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)

            <tr class="admin_tr">
                <td class="admins_td">
                    {{ $user->id }}
                </td>
                <td class="admin_td">
                    <a class="admin__td--name" href="{{ route('userDateView', ['date' => now()->format('Y-m'), 'username' => $user->name]) }}">
                        {{ $user->name }}
                    </a>
                </td>
                <td class="admin_td">
                    {{ $user->email}}
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

</div>
@endsection