<?php
namespace Siroko\App\Cart\Infrastructure\Persistence;

use Siroko\App\Cart\Domain\Cart;
use Siroko\App\Cart\Domain\CartItem;
use Siroko\Shared\Apicalls\GetCartApiCall;
use Siroko\Shared\Crud\AddServiceInterface;
use Siroko\Shared\Crud\GetServiceInterface;
use Siroko\Shared\Utils\UtilsApicallService;
use Siroko\Shared\Crud\DeleteServiceInterface;
use Siroko\Shared\Crud\UpdateServiceInterface;
use Siroko\App\Product\Infrastructure\ProductRepository;

class CartRepository implements GetServiceInterface, AddServiceInterface, UpdateServiceInterface, DeleteServiceInterface {
    private GetCartApiCall $get_cart_apicall;
    private ProductRepository $product_repo;
    public function __construct(private readonly GetCartApiCall $getCartApicall, private readonly ProductRepository $productRepo) {
        $this->get_cart_apicall = $getCartApicall;
        $this->product_repo = $productRepo;
    }

    public function get(string $id): mixed {
        $cart_res = $this->get_cart_apicall->api_call("", "GET", "");
        $cart_obj = new Cart($cart_res["id"], $cart_res["user"], []);
        if (isset($cart_res["items"]) && is_array($cart_res["items"]) && sizeof($cart_res["items"]) > 0) {
            foreach ($cart_res["items"] as $cart_item) {
                $product = $this->product_repo->get($cart_item["id"]);
                $cart_item_obj = new CartItem($product->id, $product->name, $cart_item["quantity"], $product->price, ($product->price * $cart_item["quantity"]));
                array_push($cart_obj->items, $cart_item_obj);
            }
        }
        return $cart_obj;
    }

    public function add(mixed $object, string $authorization = null): mixed {

    }

    public function update(string $id, mixed $object): mixed {

        
    }    

    public function delete(string $id) {

    }
}
?>