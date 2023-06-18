<?php
namespace Siroko\App\Cart\Application\ClearCart;

use Siroko\Shared\Request\RequestClearCart;
use Siroko\App\Cart\Infrastructure\Persistence\CartRepository;

class ClearCart {
    private CartRepository $cart_repo;
    public function __construct(private readonly CartRepository $cartRepo) {
        $this->cart_repo = $cartRepo;
    }

    public function clear(RequestClearCart $request): void {
        $this->cart_repo->clear($request->items);
    }
}
?>