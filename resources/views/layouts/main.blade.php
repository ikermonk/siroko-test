<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Siroko</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header class="header">
            <div class="logo">
                <img src="{{ asset('img/logo-siroko.png') }}" alt="Imagen" class="imagen">
            </div>
            <div id="mini-shopping-cart" class="mini-shopping-cart">
                <a href="{{ route('cart') }}">
                    <div class="mini-shopping-cart carrito">
                        <img src="{{ asset('img/cart.jpg') }}" alt="Carrito" class="icono-carrito">
                        <span class="quantity">{{ $cart->get_total_items() }}</span>
                        <span class="total">{{ $cart->get_total() }}</span>
                    </div>
                </a>
            </div>
        </header>

        <div class="container">
            @yield('content')
        </div>

        <script type="module" src="{{ asset('js/siroko.js') }}"></script>
    </body>
</html>
