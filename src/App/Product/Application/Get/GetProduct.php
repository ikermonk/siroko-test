<?php
namespace Siroko\App\Product\Application\Get;

use Siroko\Shared\Request\RequestId;
use Siroko\App\Product\Infrastructure\ProductRepository;

class GetProduct {
    private ProductRepository $product_repo;
    public function __construct(private readonly ProductRepository $productRepo) {
        $this->product_repo = $productRepo;
    }

    public function get_product(RequestId $requestId): array {
        return $this->product_repo->get($requestI->getId());
    }    
}
?>