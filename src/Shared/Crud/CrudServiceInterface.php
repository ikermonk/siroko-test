<?php
namespace Siroko\Shared\Crud;

use Siroko\Shared\Crud\AddServiceInterface;
use Siroko\Shared\Crud\GetServiceInterface;
use Siroko\Shared\Crud\ListServiceInterface;
use Siroko\Shared\Crud\DeleteServiceInterface;
use Siroko\Shared\Crud\UpdateServiceInterface;

interface CrudServiceInterface extends GetServiceInterface, ListServiceInterface, AddServiceInterface, UpdateServiceInterface, DeleteServiceInterface {
}

?> 