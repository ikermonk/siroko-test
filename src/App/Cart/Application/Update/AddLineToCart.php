<?php
namespace Siroko\App\Cart\Application\Update;

use Siroko\App\Cart\Domain\Cart;
use Siroko\Shared\Request\RequestAddItem;
use Siroko\App\Product\Infrastructure\ProductRepository;
use Siroko\App\Cart\Infrastructure\Persistence\CartRepository;

class AddLineToCart {
    private CartRepository $cart_repo;
    private ProductRepository $product_repo;
    public function __construct(private readonly CartRepository $cartRepo, private readonly ProductRepository $productRepo) {
        $this->cart_repo = $cartRepo;
        $this->product_repo = $productRepo;
    }

    //Cart and Product Id
    public function add(RequestAddItem $requestAddToCart): Cart {
        $data["id_cart"] = $requestAddToCart->id_cart;
        $data["user_id"] = $requestAddToCart->user_id;
        $data["product_id"] = $requestAddToCart->product_id;
        $data["quantity"] = $requestAddToCart->quantity;
        return $this->cart_repo->add($data);
    }
}
?>