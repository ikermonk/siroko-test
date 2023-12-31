<?php
namespace Siroko\App\Cart\Presentation\Controllers;

use Exception;
use Illuminate\Http\Request;
use ProductNotFoundException;
use Illuminate\Support\Facades\Log;
use Siroko\Shared\User\UserService;
use Siroko\Shared\Request\RequestId;
use Illuminate\Support\Facades\Redirect;
use Siroko\Shared\Request\RequestAddItem;
use Siroko\App\Cart\Application\Get\GetCart;
use Siroko\Shared\Request\RequestRemoveItem;
use Siroko\Shared\Request\RequestUpdateCart;
use Siroko\App\Cart\Application\Update\DeleteItem;
use Siroko\App\Cart\Application\Update\UpdateCart;
use Siroko\App\Cart\Application\ClearCart\ClearCart;
use Siroko\App\Cart\Application\Update\AddLineToCart;

class CartController {
    private UserService $user_service;
    private GetCart $get_cart_service;
    private AddLineToCart $add_line_cart_service;
    private DeleteItem $delete_item_service;
    private UpdateCart $update_cart_service;
    private ClearCart $clear_cart_service;
    public function __construct(private readonly GetCart $getCartService, private readonly UserService $userService, 
    private readonly AddLineToCart $addLineCartService, private readonly DeleteItem $deleteItemService, private readonly UpdateCart $updateCartService,
    private readonly ClearCart $clearCartService) {
        $this->user_service = $userService;
        $this->get_cart_service = $getCartService;
        $this->add_line_cart_service = $addLineCartService;
        $this->delete_item_service = $deleteItemService;
        $this->update_cart_service = $updateCartService;
        $this->clear_cart_service = $clearCartService;
    }

    public function index() {
        //Get User:
        $user = $this->user_service->get_user_session();
        //Get Cart
        $requestCart = new RequestId($user, "user");
        $cart = $this->get_cart_service->get_cart($requestCart);
        return view('cart', ["cart" => $cart]);
    }

    public function add(Request $request) {
        try {
            //Get User:
            $user = $this->user_service->get_user_session();
            //Get User Cart:
            $requestCart = new RequestId($user, "user");
            $cart = $this->get_cart_service->get_cart($requestCart);
            //Add Line to Cart:
            if(isset($request["product_id"]) && $request["product_id"] !== "" && isset($request["quantity"]) && $request["quantity"] > 0) {
                $requestAddToCart = new RequestAddItem($cart->uuid, $user, $request["product_id"], $request["quantity"]);
                $cart = $this->add_line_cart_service->add($requestAddToCart);
                return Redirect::route('cart');
            }
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de agregar este Producto.'
            ], 409);
        } catch (ProductNotFoundException $e) {
            Log::error("CartController - add - ProductNotFoundException: " . $e->getMessage());
            return response()->json([
                'message' => 'El producto que intentas agregar no existe.'
            ], 500);
        } catch (Exception $e) {
            Log::error("CartController - add - Exception: " . $e->getMessage());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de agregar este Producto.'
            ], 500);
        }
    }

    public function change(Request $request) {
        switch ($request["action"]) {
            case "clear": 
                return $this->clear($request);
                break;
            case "update":
                return $this->update($request);
                break;
            case "checkout":
                return $this->confirm($request);
                break;
        }
        return Redirect::route('cart');
    }

    public function update(Request $request) {
        try {
            //Get User:
            $user = $this->user_service->get_user_session();
            //Update Cart:
            $requestUpdateCart = new RequestUpdateCart($user, $request->all());
            if ($requestUpdateCart->validate()) {
                $cart = $this->update_cart_service->update($requestUpdateCart);
                return Redirect::route('cart');
            }
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de actualizar el Carrito.'
            ], 409);
        } catch (Exception $e) {
            Log::error("CartController - add - Exception: " . $e->getMessage());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de agregar este Producto.'
            ], 500);
        }
    }       

    public function remove(Request $request) {
        try {
            //Request:
            $data = $request->all();
            $requestDelete = new RequestRemoveItem($data["line_id"], $data["id_cart"]);
            if ($requestDelete->validate()) {
                //Remove Cart Line:
                $cart = $this->delete_item_service->remove_item($requestDelete);
                return Redirect::route('cart');
            }
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de agregar este Producto.'
            ], 409);
        } catch (Exception $e) {
            Log::error("CartController - remove - Exception: " . $e->getMessage());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de eliminar este Producto.'
            ], 500);
        }
    }
    
    public function clear(Request $request) {
        try {
            //Get User:
            $user = $this->user_service->get_user_session();
            //Clear Cart:
            $requestId = new RequestId($request->id_cart, "");
            if ($requestId->validate()) {
                $cart = $this->clear_cart_service->clear($requestId);
                return Redirect::route('cart');
            }
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de actualizar el Carrito.'
            ], 409);
        } catch (Exception $e) {
            Log::error("CartController - add - Exception: " . $e->getMessage());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de agregar este Producto.'
            ], 500);
        }
    }

    public function confirm(Request $request) {
        //Get User:
        $user = $this->user_service->get_user_session();
        //Get Cart
        $requestCart = new RequestId($user, "user");
        $cart = $this->get_cart_service->get_cart($requestCart);
        if (isset($cart) && isset($cart->items) && is_array($cart->items) && sizeof($cart->items) > 0) {
            return view('checkout', ["cart" => $cart]);
        }
        return Redirect::route('/', ["cart" => $cart]);
    } 

}
?>