<?php
namespace Siroko\App\Cart\Domain;

class Cart {
    public string $id;
    public string $user_id;
    public array $items;
    public function __construct(string $id, string $user_id, array $items) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->items = $items;
    }

    public function get_total(): string {
        $total = 0;
        if (isset($this->items) && is_array($this->items) && sizeof($this->items) > 0) {
            foreach ($this->items as $item) {
                $total += ($item->quantity * $item->price); 
            }
        }
        return $total;
    }

    public function get_iva(): string {
        $iva = 0;
        $total = $this->get_total();
        if (isset($total) && $total > 0) {
            $iva = (21 * $total) / 100;
        }
        return $iva;
    }

    public function get_subtotal(): string {
        $subtotal = 0;
        $iva = $this->get_iva();
        $total = $this->get_total();
        if (isset($total) && $total > 0 && isset($iva) && $iva > 0) {
            $subtotal = $total - $iva;
        }
        return $subtotal;
    }

}
?>