<?php
namespace Siroko\App\Product\Application\Get;

use Siroko\Shared\Request\RequestId;

class GetProduct {
    private ProductRespository $product_repo;
    public function __construct(private readonly ProductRespository $productRepo) {
        $this->product_repo = $productRepo;
    }

    public function get_product(RequestId $requestId): array {
        return $this->product_repo->get($requestI->getId());
    }    
}
?>