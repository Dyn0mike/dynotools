<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dynotools</title>

        <!-- Stylesheet -->
        @vite('resources/css/app.css')
        <script src="https://cdn.tailwindcss.com"></script>

    </head>
    <body class="bg-gray-200">
        <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
                <li>
                    <a href="{{ route('home') }}" class="p-3">Home</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
                </li>
                <li>
                    <!--<a href="{{ route('moons') }}" class="p-3">Moons</a>-->
                </li>
                <li>
                    <a href="{{ route('escal') }}" class="p-3">Escalations</a>
                </li>
            </ul>
            <ul class="flex items-center">
                @auth
                <li>
                    <a href="{{ route('dashboard') }}" class="p-3">{{ auth()->user()->name}}</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
                @endauth
                @guest
                <li>
                    <a href="{{ route('register') }}" class="p-3">Register</a>
                </li>
                <li>
                    <a href="{{ route('login') }}" class="p-3">Login</a>
                </li>
                @endguest
            </ul>
        </nav>
        
        @yield('content')
    </body>
</html>
