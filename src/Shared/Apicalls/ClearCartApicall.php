<?php
namespace Siroko\Shared\Apicalls;

use Illuminate\Support\Facades\Http;
use Siroko\Shared\Apicalls\IApiCallService;
use Siroko\Shared\Apicalls\Exceptions\ApiCallException;

class ClearCartApicall implements IApiCallService {
    public function api_call(string $endpoint, string $method, mixed $data = null): mixed {
        $res = Http::delete($endpoint, $data);
        if (isset($res)) return $res->json();
        throw new ApiCallException();
    }
}
?>