<?php
namespace Siroko\Shared\Crud;

interface UpdateServiceInterface {
    public function update(string $id, mixed $object): mixed;
}
?>