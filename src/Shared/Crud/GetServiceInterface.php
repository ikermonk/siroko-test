<?php 
namespace Siroko\Shared\Crud;

interface GetServiceInterface {
    public function get(string $id): mixed;
}
?>