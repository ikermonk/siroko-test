<?php
namespace Siroko\Shared\Request;

class RequestId {
    private string $id;
    private string $by;
    public function __construct(string $id, string $by = null) {
        $this->id = $id;
        $this->by = (isset($by) && $by !== "") ? $by : "";
    }

    public function getId(): string {
        return $this->id;
    }

    public function getBy(): string {
        return $this->by;
    }
}
?>