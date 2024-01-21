@extends('layouts.common')
@section('title')
<title>ユーザー別日付一覧</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection
@section('content')
<div class="date__table--wrapper">
    <div class="date__link">

        <a class="date__link--button" href="{{ route('userDateView', ['date' => $prevDate->format('Y-m'), 'username' => $urlUser]) }}">
            ＜
        </a>

        <span>
            {{ $dateFromUrlFormat }}
        </span>

        <a class="date__link--button" href="{{ route('userDateView', ['date' => $nextDate->format('Y-m'), 'username' => $urlUser]) }}">＞</a>

    </div>

    <table class="date__table">
        <thead class="date__th">
            <tr>
                <th>名前</th>
                <th>日付</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
        </thead>

        <tbody>

            @if($user)
            @foreach($user->attendances as $attendance)

            @if(date('Y-m', strtotime($attendance->clock_in_time)) === $dateFromUrlFormat)

            <tr class="admin_tr">
                <td class="admins_td">
                    {{ $urlUser }}
                </td>
                <td class="admins_td">
                    {{ (new DateTime($attendance->clock_in_time))->format('m-d') }}
                </td>
                <td class="admin_td">
                    {{ (new DateTime($attendance->clock_in_time))->format('H:i:s') }}
                </td>
                <td class="admin_td">
                    @if($attendance->clock_out_time !== null)
                    {{ (new DateTime($attendance->clock_out_time))->format('H:i:s') }}
                    @else
                    -
                    @endif
                </td>
                <td class="admin_td">
                    @php
                    $date = (new DateTime($attendance->clock_in_time))->format('Y-m-d');
                    @endphp

                    @if ($totalRestTime[$date] ?? null !== null)
                    {{ gmdate('H:i:s', $totalRestTime[$date] ?? null) }}
                    @else
                    -
                    @endif
                </td>
                <td class="admin_td">
                    @if($attendance->clock_in_time !== null && $attendance->clock_out_time !== null)
                    @php

                    $clockIn = new DateTime($attendance->clock_in_time);
                    $clockOut = new DateTime($attendance->clock_out_time);
                    $interval = $clockIn->diff($clockOut);

                    $workHoursSeconds = $interval->s + $interval->i * 60 + $interval->h * 3600 + $interval->days * 86400;

                    $workHoursSeconds -= $totalRestTime[$date] ?? null;

                    $workHours = new DateTime('@' . $workHoursSeconds);

                    echo $workHours->format('H:i:s');

                    @endphp
                    @else
                    -
                    @endif
                </td>
            </tr>
            @endif
            @endforeach
            @endif
        </tbody>
    </table>

</div>
@endsection