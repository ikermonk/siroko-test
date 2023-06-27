<?php
namespace Siroko\App\Cart\Application\ClearCart;

use Siroko\App\Cart\Domain\Cart;
use Siroko\Shared\Request\RequestId;
use Siroko\App\Cart\Infrastructure\Persistence\CartRepository;

class ClearCart {
    private CartRepository $cart_repo;
    public function __construct(private readonly CartRepository $cartRepo) {
        $this->cart_repo = $cartRepo;
    }

    public function clear(RequestId $request): Cart {
        $data["id_cart"] = $request->getId();
        return $this->cart_repo->clear($data);
    }
}
?>