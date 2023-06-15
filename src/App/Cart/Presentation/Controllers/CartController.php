<?php
namespace Siroko\App\Cart\Presentation\Controllers;

use Siroko\Shared\Request\RequestId;
use Illuminate\Support\Facades\Redirect;
use Siroko\App\Cart\Application\Get\GetCart;

class CartController {
    private GetCart $get_cart_service;
    public function __construct(private readonly GetCart $getCartService) {
        $this->get_cart_service = $getCartService;
    }

    public function index() {
        $requestCart = new RequestId("1");
        $cart = $this->get_cart_service->get_cart($requestCart);        
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