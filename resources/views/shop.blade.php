@extends('layouts.main')

@section('content')

    <h1>Listado de Productos</h1>
    <div class="content">
        @foreach ($products as $product)
            <form action="{{ route('cart.add') }}" method="post">
                @csrf
                <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                <div class="product">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->price }} €</p>
                    <p>
                        <input type="number" id="quantity" name="quantity" value="1" min="1">
                    </p>
                    <p>
                        <input type="submit" value="Comprar">
                    </p>
                </div>
            </form>
        @endforeach
    </div>
    
@endsection
