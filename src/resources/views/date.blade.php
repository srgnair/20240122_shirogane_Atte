@extends('layouts.common')
@section('title')
<title>日付一覧</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection
@section('content')
<div class="date__table--wrapper">
    <div class="date__link">

        <a class="date__link--button" href="{{ route('dateView', ['date' => $prevDate->format('Y-m-d')]) }}">
            ＜
        </a>

        <span>
            {{ $dateFromUrlFormat }}
        </span>

        <a class="date__link--button" href="{{ route('dateView', ['date' => $nextDate->format('Y-m-d')]) }}">
            ＞
        </a>
    </div>

    <table class="date__table">
        <thead class="date__th">
            <tr>
                <th>名前</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
        </thead>

        <tbody>

            @foreach($users as $user)
            @foreach($user->attendances as $attendance)

            @if(date('Y-m-d', strtotime($attendance->clock_in_time)) === $dateFromUrlFormat)

            <tr class="admin__tr">
                <td class="admin__td">

                    <a class="admin__td--name" href="{{ route('userDateView', ['date' =>Carbon\Carbon::parse($date)->format('Y-m'), 'username' => $user -> name]) }}">
                        {{ $user->name }}
                    </a>

                </td>
                <td class="admin_td">

                    {{\Carbon\Carbon::parse($attendance->clock_in_time)->format('H:i:s')}}

                </td>
                <td class="admin_td">

                    {{\Carbon\Carbon::parse($attendance->clock_out_time)->format('H:i:s')}}

                </td>
                <td class="admin_td">
                    @php
                    $totalRestTime = \Carbon\CarbonInterval::create(0, 0, 0);
                    $date = (new DateTime($attendance->clock_in_time))->format('Y-m-d');
                    @endphp

                    @foreach($user->rests as $rest)
                    @if (date('Y-m-d', strtotime($rest->rest_end_time)) === $dateFromUrlFormat)

                    @php
                    $startRestTime = \Carbon\Carbon::parse($rest->rest_start_time);
                    $endRestTime = \Carbon\Carbon::parse($rest->rest_end_time);
                    $restDuration = $startRestTime->diff($endRestTime);
                    $totalRestTime = $totalRestTime->add($restDuration);
                    @endphp
                    @endif
                    @endforeach

                    {{$totalRestTime->format('%H:%I:%S')}}

                </td>

                <td class="admin_td">
                    @if($attendance->clock_in_time !== null && $attendance->clock_out_time !== null)

                    @php
                    $clockIn = \Carbon\Carbon::parse($attendance->clock_in_time);
                    $clockOut = \Carbon\Carbon::parse($attendance->clock_out_time);
                    $workHours = $clockIn->diff($clockOut);
                    @endphp

                    @foreach($user->rests as $rest)
                    @php
                    $restStart = \Carbon\Carbon::parse($rest->rest_start_time);
                    $restEnd = \Carbon\Carbon::parse($rest->rest_end_time);
                    @endphp
                    @endforeach

                    {{ $workHours->format('%H:%i:%s') }}
                    @else
                    -
                    @endif
                </td>

            </tr>
            @endif
            @endforeach
            @endforeach

        </tbody>
    </table>

    <div class="date__paginate">
        {{ $attendances->links() }}
    </div>

</div>
@endsection