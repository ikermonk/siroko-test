<?php
namespace Siroko\App\Cart\Application\Get;

use Siroko\Shared\Request\RequestId;
use Siroko\App\Cart\Infrastructure\Persistence\CartRepository;

class GetCart {
    private CartRepository $cart_repo;
    public function __construct(private readonly CartRepository $cartRepo) {
        $this->cart_repo = $cartRepo;
    }

    public function get_cart(RequestId $request) {
        return $this->cart_repo->get($request->getId());
    }
}
?>