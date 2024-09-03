<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Dropshipping Store')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Add any other CSS or JavaScript files here -->
</head>
<body>
    <header>
        <nav>
            <ul>

                <li><a href="{{ route('cart.index') }}">Cart</a></li>

            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} My Dropshipping Store</p>
    </footer>
</body>
</html>