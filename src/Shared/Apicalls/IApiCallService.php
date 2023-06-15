<?php
namespace Siroko\Shared\Apicalls;

interface IApiCallService {
    public function api_call(string $endpoint, string $method, string $data = null): mixed;
}
?>