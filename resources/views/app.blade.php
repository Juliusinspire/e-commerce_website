<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            @if (Auth::check())
                <li><a href="/dashboard">Dashboard</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="/login">Login</a></li>
                <li><a href="/signup">Signup</a></li>
            @endif
        </ul>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
