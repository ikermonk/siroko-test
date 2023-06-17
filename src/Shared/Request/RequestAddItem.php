<?php
namespace Siroko\Shared\Request;

use Siroko\App\Cart\Domain\Cart;

class RequestAddItem {
    public string $id_cart;
    public string $user_id;
    public string $product_id;
    public int $quantity;
    public function __construct(string $id_cart, string $user_id, string $product_id, int $quantity) {
        $this->id_cart = $id_cart;
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }
}
?>