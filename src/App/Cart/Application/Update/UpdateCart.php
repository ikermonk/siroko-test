<?php
namespace Siroko\App\Cart\Application\Update;

use Siroko\App\Cart\Domain\Cart;
use Siroko\Shared\Request\RequestUpdateCart;
use Siroko\App\Cart\Infrastructure\Persistence\CartRepository;

class UpdateCart {
    private CartRepository $cart_repo;
    public function __construct(private readonly CartRepository $cartRepo) {
        $this->cart_repo = $cartRepo;
    }

    public function update(RequestUpdateCart $request): Cart {
        return $this->cart_repo->update($request->id_cart, $request->items, $request->user_id);
    }
}
?>