<?php
namespace Siroko\App\Cart\Application\Update;

use Siroko\Shared\Request\RequestRemoveItem;
use Siroko\App\Cart\Infrastructure\Persistence\CartRepository;

class DeleteItem {
    private CartRepository $cart_repo;
    public function __construct(private readonly CartRepository $cartRepo) {
        $this->cart_repo = $cartRepo;
    }

    public function remove_item(RequestRemoveItem $request): void {
        $data["id_line"] = $request->id;
        $data["user_id"] = $request->user_id;
        $this->cart_repo->delete($data);
    }
}
?>