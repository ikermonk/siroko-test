<?php
namespace Siroko\App\Shop\Presentation\Controllers;

use Siroko\Shared\User\UserService;
use Siroko\Shared\Request\RequestId;
use Siroko\App\Cart\Application\Get\GetCart;
use Siroko\App\Product\Application\List\GetProducts;

class ShopController {
    private UserService $user_service;
    private GetCart $get_cart_service;
    private GetProducts $getProducts_service;
    public function __construct(private readonly GetProducts $getProductsService, private readonly UserService $userService, 
    private readonly GetCart $getCartService) {
        $this->user_service = $userService;
        $this->get_cart_service = $getCartService;
        $this->getProducts_service = $getProductsService;
    }

    public function index() {
        //Get User:
        $user = $this->user_service->get_user_session();
        $requestCart = new RequestId($user);
        $cart = $this->get_cart_service->get_cart($requestCart);
        //Get Products:
        $products = $this->getProducts_service->get_products();
        return view('shop', ["products" => $products, "cart" => $cart]);
    }
}
?>