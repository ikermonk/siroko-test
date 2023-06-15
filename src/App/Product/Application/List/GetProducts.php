<?php
namespace Siroko\App\Product\Application\List;

use Siroko\App\Product\Infrastructure\ProductRespository;

class GetProducts {
    private ProductRespository $product_repo;
    public function __construct(private readonly ProductRespository $productRepo) {
        $this->product_repo = $productRepo;
    }

    public function get_products(): array {
        return $this->product_repo->list();
    }
}
?>