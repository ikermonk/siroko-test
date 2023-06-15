<?php
namespace Siroko\App\Product\Domain;

class Product {
    public string $id; 
    public string $name;
    public string $price;
    public function __construct(string $id, string $name, string $price) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price; 
    }
}
?>