<?php
namespace Siroko\App\Product\Infrastructure;

use Siroko\App\Product\Domain\Product;
use Siroko\Shared\Crud\GetServiceInterface;
use Siroko\Shared\Crud\ListServiceInterface;

class ProductRespository implements GetServiceInterface, ListServiceInterface {
    
    public function get(string $id): mixed {
        $products = $this->list();
        foreach ($products as $product) {
            if ($product->id === $id) return $product;
        }

        throw new ProductNotFoundException(); 
    }

    public function list(): array {
        $products = [];
        $products_env = json_decode($_ENV['PRODUCTS'], true);
        foreach ($products_env as $productJson) {
            $product = new Product($productJson["id"], $productJson["name"], $productJson["price"]);
            array_push($products, $product);
        }
        return $products;
    }
    
}
?>
