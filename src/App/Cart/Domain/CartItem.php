<?php
namespace Siroko\App\Cart\Domain;

class CartItem {
    public string $id;
    public string $uuid;
    public string $product_id;
    public string $name;
    public int $quantity;
    public string $price;
    public string $line_total;
    public function __construct(string $id, string $uuid, string $product_id, string $name, int $quantity, string $price, string $line_total) {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->product_id = $product_id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->line_total = $line_total;
    }
}
?>