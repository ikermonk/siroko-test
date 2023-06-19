<?php
namespace Siroko\Shared\Crud;

interface UpdateServiceInterface {
    public function update(string $id, mixed $object, string $user_id = null): mixed;
}
?>