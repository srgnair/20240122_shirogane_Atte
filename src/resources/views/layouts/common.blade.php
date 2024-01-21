<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <div class="wrapper">

        <header>
            <div class="header__logo">Atte</div>
            <nav>
                <ul class="header__ul">
                    @if (Auth::check())
                    <li>
                        <form method="GET" action="{{ route('stampView') }}">
                            @csrf
                            <div class="button__header">
                                <button class="button__header--button" type="submit">ホーム</button>
                            </div>
                        </form>
                    </li>
                    <li>
                        <form method="GET" action="{{ route('dateView') }}">
                            @csrf
                            <div class="button__header">
                                <button class="button__header--button" type="submit">日付一覧</button>
                            </div>
                        </form>
                    </li>
                    <li>
                        <form method="GET" action="{{ route('usersView') }}">
                            @csrf
                            <div class="button__header">
                                <button class="button__header--button" type="submit">ユーザー一覧</button>
                            </div>
                        </form>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="button__header">
                                <button class="button__header--button" type="submit">ログアウト</button>
                            </div>
                        </form>
                    </li>
                    @endif
                </ul>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            <p>
                <small>Atte,inc.</small>
            </p>
        </footer>
    </div>
</body>

</html>