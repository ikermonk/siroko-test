<?php
namespace Siroko\Shared\Request;

class RequestId {
    private string $id;
    private string $by;
    public function __construct(string $id, string $by) {
        $this->id = $id;
        $this->by = $by;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getBy(): string {
        return $this->by;
    }

    public function validate(): bool {
        return isset($this->id) && $this->id !== "";
    }
}
?>