<?php
namespace Siroko\App\Cart\Application\Update;

use Siroko\Shared\Request\RequestId;
use Siroko\App\Cart\Infrastructure\Persistence\CartRepository;

class DeleteItem {
    private CartRepository $cart_repo;
    public function __construct(private readonly CartRepository $cartRepo) {
        $this->cart_repo = $cartRepo;
    }

    public function remove_item(RequestId $request): void {
        $this->cart_repo->delete($request->getId());
    }
}
?>