<?php
namespace Siroko\Shared\Crud;

interface AddServiceInterface {
    public function add(mixed $object, string $authorization = null): mixed;
}
?>