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
use Siroko\App\Cart\Application\Update\DeleteItem;
use Siroko\App\Cart\Application\Update\AddLineToCart;

class CartController {
    private UserService $user_service;
    private GetCart $get_cart_service;
    private AddLineToCart $add_line_cart_service;
    private DeleteItem $delete_item_service;
    public function __construct(private readonly GetCart $getCartService, private readonly UserService $userService, 
    private readonly AddLineToCart $addLineCartService, private readonly DeleteItem $deleteItemService) {
        $this->user_service = $userService;
        $this->get_cart_service = $getCartService;
        $this->add_line_cart_service = $addLineCartService;
        $this->delete_item_service = $deleteItemService;
    }

    public function index() {
        //Get User:
        $user = $this->user_service->get_user_session();
        $requestCart = new RequestId($user);
        $cart = $this->get_cart_service->get_cart($requestCart);
        return view('cart', ["cart" => $cart]);
    }

    public function add(Request $request) {
        try {
            //Get User:
            $user = $this->user_service->get_user_session();
            //Get User Cart:
            $requestCart = new RequestId($user);
            $cart = $this->get_cart_service->get_cart($requestCart);
            //Add Line to Cart:
            if(isset($request["product_id"]) && $request["product_id"] !== "" && isset($request["quantity"]) && $request["quantity"] > 0) {
                $requestAddToCart = new RequestAddItem($cart->id, $user, $request["product_id"], $request["quantity"]);
                $this->add_line_cart_service->add($requestAddToCart);
                return Redirect::to('cart');
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
        return Redirect::to('cart');
    }

    public function update(Request $request) {
        dd($request->all());
    }       

    public function remove(Request $request) {
        try {
            if (isset($request["line_id"]) && $request["line_id"] !== "") {
                //Remove Cart Line:
                $requestDelete = new RequestId($request["line_id"]);
                $this->delete_item_service->remove_item($requestDelete);
                return Redirect::to('cart');
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
        return Redirect::to('cart');
    }
    
    public function clear(Request $request) {
        dd($request->all());
    }

    public function confirm(Request $request) {
        dd($request->all());
    } 

}
?>