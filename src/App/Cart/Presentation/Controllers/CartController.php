<?php
namespace Siroko\App\Cart\Presentation\Controllers;

use Illuminate\Support\Facades\Redirect;

class CartController {
    public function index() {
        // Array del Cart
        $cart = [
            "id" => 1,
            "user" => 1,
            "items" => [
                ["id" => 1, "cant" => 1],
                ["id" => 3, "cant" => 1]
            ]
        ];
        
        return view('cart', ["cart" => $cart]);
    }

    public function add() {
        return Redirect::to('cart');
    }

    public function update() {

    }

    public function remove() {

    }
    
    public function clear() {

    }    
}
?>