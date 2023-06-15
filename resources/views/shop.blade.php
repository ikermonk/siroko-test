@extends('layouts.main')

@section('content')

    <h1>Listado de Productos</h1>
    <div class="content">
        <?php
        // Recorrer el array de productos y mostrarlos
        foreach ($products as $product) { ?>
            <form action="{{ route('cart.add') }}" method="post">
                @csrf
                <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                <div class="product">
                    <h3><?php echo $product->name; ?></h3>
                    <p><?php echo $product->price; ?> €</p>
                    <p>
                        <input type="submit" value="Comprar">
                    </p>
                </div>
            </form>
        <?php } ?>
    </div>
    
@endsection
