<?php
namespace Siroko\Shared\Apicalls;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Siroko\Shared\Apicalls\Exceptions\ApiCallException;

class AddLineToCartApicall implements IApiCallService {
    public function api_call(string $endpoint, string $method, mixed $data = null): mixed {
        $res = Http::post($endpoint, $data);
        if (isset($res)) return $res->json();
        throw new ApiCallException();
    }
}
?>