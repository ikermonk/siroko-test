<?php
namespace Siroko\Shared\Request;

use stdClass;
use Illuminate\Support\Facades\Log;

class RequestClearCart {
    public array $items;
    public function __construct(mixed $objet) {
        $data = $this->getData($objet);
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
                    $item = $this->get_item_line($key);
                    array_push($data->items, $item);
                }
            }
        }
        return $data;
    }

    private function get_item_line(string $item): mixed {
        $item_exploded = explode("-", $item);
        $id_line = $item_exploded[1];
        return $id_line;
    }

    public function validate(): bool {
        Log::info("Data => " . json_encode($this->items));
        return isset($this->items) && is_array($this->items) && sizeof($this->items);
    }
    
}
?>