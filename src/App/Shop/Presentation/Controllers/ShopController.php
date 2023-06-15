<?php
namespace Siroko\App\Shop\Presentation\Controllers;

use Siroko\App\Product\Application\List\GetProducts;

class ShopController {
    private GetProducts $getProducts_service;
    public function __construct(private readonly GetProducts $getProductsService) {
        $this->getProducts_service = $getProductsService;
    }

    public function index() {
        $products = $this->getProducts_service->get_products();
        return view('shop', ["products" => $products]);
    }
}
?>