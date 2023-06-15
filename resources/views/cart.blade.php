@extends('layouts.main')

@section('content')

    <h1>Carrito de la Compra</h1>
    <div class="content">
        @if (isset($cart) && isset($cart->items) && is_array($cart->items))
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
            </div>
        @else
            <p>No has agregado ningún producto al carrito.</p>
        @endif  
    </div>

@endsection
