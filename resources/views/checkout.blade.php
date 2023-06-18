@extends('layouts.main', ['cart' => $cart])

@section('content')

    <h1>Checkout</h1>
    <div class="content">
        @if (isset($cart) && isset($cart->items) && is_array($cart->items) && sizeof($cart->items) > 0)
            <form action="{{ route('cart.change') }}" method="post">
                @csrf
                <input type="hidden" id="cart_id" name="cart_id" value="{{ $cart->id }}">
                <div class="content-table">
                    <table>
                        <thead>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            @foreach($cart->items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->line_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="content-subtotal">
                    <p>
                        <span><strong>Subtotal:</strong></span> {{ $cart->get_subtotal() }}
                    </p>
                </div>
                <div class="content-iva">
                    <p>
                        <span><strong>IVA(21%):</strong></span> {{ $cart->get_iva() }}
                    </p>
                </div>
                <div class="content-total">
                    <p>
                        <span><strong>Total:</strong></span> {{ $cart->get_total() }}
                    </p>
                </div>
                <div class="content-actions">
                    <a href="{{ route('shop') }}" class="button">Seguir Comprando</a>
                    <a href="#" class="button">Pagar</a>
                </div>
            </form>
        @else
            <p>No has agregado ningún producto al carrito.</p>
            <div class="content-actions">
                <a href="{{ route('shop') }}" class="button">Seguir Comprando</a>
            </div>
        @endif  
    </div>

@endsection
