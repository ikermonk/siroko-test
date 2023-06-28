<?php
namespace Siroko\App\Cart\Application\Update;

use Siroko\App\Cart\Domain\Cart;
use Siroko\Shared\Request\RequestRemoveItem;
use Siroko\App\Cart\Infrastructure\Persistence\CartRepository;

class DeleteItem {
    private CartRepository $cart_repo;
    public function __construct(private readonly CartRepository $cartRepo) {
        $this->cart_repo = $cartRepo;
    }

    public function remove_item(RequestRemoveItem $request): Cart {
        $data["id_line"] = $request->id;
        $data["id_cart"] = $request->id_cart;
        return $this->cart_repo->delete($data);
    }
}
?>