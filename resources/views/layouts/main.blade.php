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
                <div class="mini-shopping-cart carrito">
                    <img src="{{ asset('img/cart.jpg') }}" alt="Carrito" class="icono-carrito">
                    <span class="quantity">5</span>
                    <span class="total">231 €</span>
                </div>
            </div>
            <div id="mini-shopping-cart-layer" class="mini-shopping-cart-layer">
                <div id="close-cart">
                    <img src="{{ asset('img/close.png') }}" alt="Cerrar">
                </div>
                <table class="shoopping-cart">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Quitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>K3S ZURICH</td>
                            <td>35 €</td>
                            <td>
                                <input type="number" id="quantity" name="quantity" value="1">
                            </td>
                            <td>35 €</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>M2 NEVADA</td>
                            <td>49 €</td>
                            <td>
                                <input type="number" id="quantity" name="quantity" value="2">
                            </td>
                            <td>98 €</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>ASPEN</td>
                            <td>49 €</td>
                            <td>2</td>
                            <td>98 €</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </header>

        <div class="container">
            @yield('content')
        </div>

        <script type="module" src="{{ asset('js/siroko.js') }}"></script>
    </body>
</html>
