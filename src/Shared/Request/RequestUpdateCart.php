<?php
namespace Siroko\Shared\Request;

use stdClass;
use Illuminate\Support\Facades\Log;

class RequestUpdateCart {
    public string $id_cart;
    public string $user_id;
    public array $items;
    public function __construct(string $user_id, mixed $objet) {
        $data = $this->getData($objet);
        $this->id_cart = $data->id_cart;
        $this->user_id = $user_id;
        $this->items = $data->items;
    }

    public function getData(mixed $objet): mixed {
        $data = null;
        if (isset($objet) && is_array($objet) && sizeof($objet) > 0) {
            $data = new stdClass();
            $data->items = [];
            foreach ($objet as $key => $val) {
                if ($key === "cart_id") $data->id_cart = $val;
                elseif (str_contains($key, 'quantity')) {
                    $item = $this->get_item_info($key, $val);
                    array_push($data->items, $item);
                }
            }
        }
        return $data;
    }

    public function validate(): bool {
        Log::info("Data => " . $this->id_cart . " // " . json_encode($this->items));
        return isset($this->id_cart) && $this->id_cart !== ""
            && isset($this->user_id) && $this->user_id !== ""
            && isset($this->items) && is_array($this->items) && sizeof($this->items);
    }

    private function get_item_info(string $item, string $quantity): mixed {
        $item_exploded = explode("-", $item);
        $id_line = $item_exploded[1];
        $line = new stdClass();
        $line->id = $id_line;
        $line->quantity = $quantity;
        return $line;
    }

}
?>