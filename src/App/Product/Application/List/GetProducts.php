<?php
namespace Siroko\App\Product\Application\List;

use Siroko\App\Product\Infrastructure\ProductRepository;

class GetProducts {
    private ProductRepository $product_repo;
    public function __construct(private readonly ProductRepository $productRepo) {
        $this->product_repo = $productRepo;
    }

    public function get_products(): array {
        return $this->product_repo->list();
    }
}
?>