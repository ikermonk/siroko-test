<?php
namespace Siroko\Shared\Apicalls;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Siroko\Shared\Utils\UtilsApicallService;
use Siroko\Shared\Apicalls\Exceptions\ApiCallException;

class GetCartApiCall implements IApiCallService {
    private UtilsApicallService $utils_apicall_service;
    public function __construct(private readonly UtilsApicallService $utilsApicallService) {
        $this->utils_apicall_service = $utilsApicallService;
    }

    public function api_call(string $endpoint, string $method, string $data = null): mixed {
        $res = Http::get($endpoint);
        if (isset($res)) return $res->json();
        throw new ApiCallException();
    }
}
?>