<?php
namespace Siroko\App\Cart\Infrastructure\Persistence;

use Siroko\App\Cart\Domain\Cart;
use Siroko\App\Cart\Domain\CartItem;
use Siroko\Shared\Apicalls\GetCartApiCall;
use Siroko\Shared\Crud\AddServiceInterface;
use Siroko\Shared\Crud\GetServiceInterface;
use Siroko\Shared\Apicalls\ClearCartApicall;
use Siroko\Shared\Utils\UtilsApicallService;
use Siroko\Shared\Apicalls\DeleteItemApicall;
use Siroko\Shared\Apicalls\UpdateCartApicall;
use Siroko\Shared\Crud\DeleteServiceInterface;
use Siroko\Shared\Crud\UpdateServiceInterface;
use Siroko\Shared\Apicalls\AddLineToCartApicall;
use Siroko\App\Product\Infrastructure\ProductRepository;

class CartRepository implements GetServiceInterface, AddServiceInterface, UpdateServiceInterface, DeleteServiceInterface {
    private ProductRepository $product_repo;
    private GetCartApiCall $get_cart_apicall;
    private AddLineToCartApicall $add_line_to_cart_apicall;
    private DeleteItemApicall $delete_item_apicall;
    private UpdateCartApicall $update_cart_apicall;
    private ClearCartApicall $clear_cart_apicall;
    public function __construct(private readonly GetCartApiCall $getCartApicall, private readonly ProductRepository $productRepo, 
    private readonly AddLineToCartApicall $addLineToCartApicall, private readonly DeleteItemApicall $deleteItemApicall, 
    private readonly UpdateCartApicall $updateCartApicall, private readonly ClearCartApicall $clearCartApicall) {
        $this->product_repo = $productRepo;
        $this->get_cart_apicall = $getCartApicall;
        $this->add_line_to_cart_apicall = $addLineToCartApicall;
        $this->delete_item_apicall = $deleteItemApicall;
        $this->update_cart_apicall = $updateCartApicall;
        $this->clear_cart_apicall = $clearCartApicall;
    }

    public function get(string $id): mixed {
        $cart_res = $this->get_cart_apicall->api_call($_ENV["API_DOMAIN"] . "cart/" . $id, "GET", "");
        $cart_obj = new Cart($cart_res["id"], $cart_res["user_id"], []);
        if (isset($cart_res["items"]) && is_array($cart_res["items"]) && sizeof($cart_res["items"]) > 0) {
            foreach ($cart_res["items"] as $cart_item) {
                $product = $this->product_repo->get($cart_item["product_id"]);
                $cart_item_obj = new CartItem($cart_item["id"], $product->id, $product->name, $cart_item["quantity"], $product->price, ($product->price * $cart_item["quantity"]));
                array_push($cart_obj->items, $cart_item_obj);
            }
        }
        return $cart_obj;
    }

    public function add(mixed $object): mixed {
        $cart_res = $this->add_line_to_cart_apicall->api_call($_ENV["API_DOMAIN"] . "cart-item", "POST", $object);
        $cart_obj = new Cart($cart_res["id"], $cart_res["user_id"], []);
        if (isset($cart_res["items"]) && is_array($cart_res["items"]) && sizeof($cart_res["items"]) > 0) {
            foreach ($cart_res["items"] as $cart_item) {
                $product = $this->product_repo->get($cart_item["product_id"]);
                $cart_item_obj = new CartItem($cart_item["id"], $product->id, $product->name, $cart_item["quantity"], $product->price, ($product->price * $cart_item["quantity"]));
                array_push($cart_obj->items, $cart_item_obj);
            }
        }
        return $cart_obj;
    }

    public function update(string $id, mixed $object, string $user_id = null): mixed {
        $data['user_id'] = (isset ($user_id)) ? $user_id : null;
        $data['items'] = $object;
        $cart_res = $this->update_cart_apicall->api_call($_ENV["API_DOMAIN"] . "cart/" . $id, "PUT", $data);
        $cart_obj = new Cart($cart_res["id"], $cart_res["user_id"], []);
        if (isset($cart_res["items"]) && is_array($cart_res["items"]) && sizeof($cart_res["items"]) > 0) {
            foreach ($cart_res["items"] as $cart_item) {
                $product = $this->product_repo->get($cart_item["product_id"]);
                $cart_item_obj = new CartItem($cart_item["id"], $product->id, $product->name, $cart_item["quantity"], $product->price, ($product->price * $cart_item["quantity"]));
                array_push($cart_obj->items, $cart_item_obj);
            }
        }
        return $cart_obj;
    }    

    public function delete(mixed $object): Cart {
        $cart_res = $this->delete_item_apicall->api_call($_ENV["API_DOMAIN"] . "remove-item", "DELETE", $object);
        $cart_obj = new Cart($cart_res["id"], $cart_res["user_id"], []);
        if (isset($cart_res["items"]) && is_array($cart_res["items"]) && sizeof($cart_res["items"]) > 0) {
            foreach ($cart_res["items"] as $cart_item) {
                $product = $this->product_repo->get($cart_item["product_id"]);
                $cart_item_obj = new CartItem($cart_item["id"], $product->id, $product->name, $cart_item["quantity"], $product->price, ($product->price * $cart_item["quantity"]));
                array_push($cart_obj->items, $cart_item_obj);
            }
        }
        return $cart_obj;
    }

    public function clear(mixed $data): Cart {
        $cart_res = $this->clear_cart_apicall->api_call($_ENV["API_DOMAIN"] . "clear", "DELETE", $data);
        $cart_obj = new Cart($cart_res["id"], $cart_res["user_id"], []);
        if (isset($cart_res["items"]) && is_array($cart_res["items"]) && sizeof($cart_res["items"]) > 0) {
            foreach ($cart_res["items"] as $cart_item) {
                $product = $this->product_repo->get($cart_item["product_id"]);
                $cart_item_obj = new CartItem($cart_item["id"], $product->id, $product->name, $cart_item["quantity"], $product->price, ($product->price * $cart_item["quantity"]));
                array_push($cart_obj->items, $cart_item_obj);
            }
        }
        return $cart_obj;
    }

}
?>