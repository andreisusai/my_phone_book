<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Phone Book</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="bg-gray-200">
    <nav class="fixed w-full z-10 top-0 p-6 bg-white flex justify-between mb-4 shadow">
        <ul class="flex items-center">
            <li>
                <a href="{{ route('home') }}" class="p-3">Home</a>
            </li>
            @auth
            <li>
                <a href="{{ route('entreprises') }}" class="p-3">Entreprises</a>
            </li>
            <li>
                <a href="{{ route('collaborateurs') }}" class="p-3">Collaborateurs</a>
            </li>
            @endauth
        </ul>
        <ul class="flex items-center">
            @auth
            <li>
                <span class="p-3">{{ ucfirst(auth()->user()->role) }}</span>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
            @endauth

            @guest
            <li>
                <a href="{{ route('login') }}" class="p-3">Login</a>
            </li>
            @endguest
        </ul>
    </nav>
    @yield('content')
</body>

</html>