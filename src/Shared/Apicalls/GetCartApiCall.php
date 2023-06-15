<?php
namespace Siroko\Shared\Apicalls;

use Illuminate\Support\Facades\Log;
use Siroko\Shared\Utils\UtilsApicallService;
use Siroko\Shared\Apicalls\Exceptions\ApiCallException;

class GetCartApiCall implements IApiCallService {
    private UtilsApicallService $utils_apicall_service;
    public function __construct(private readonly UtilsApicallService $utilsApicallService) {
        $this->utils_apicall_service = $utilsApicallService;
    }

    public function api_call(string $endpoint, string $method, string $data = null): mixed {
        // Configure cURL
        /*
        $curl = curl_init($endpoint);
        curl_setopt($curl, CURLOPT_HEADER, TRUE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 500);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        //Headers:
        $headers = [];
        array_push($headers, 'Content-Type:application/json');
        //Exec CURL:
        $response = curl_exec($curl);
        Log::info("GetUserCartApiCall - Response: " . json_encode($response));
        $err = curl_error($curl);
        curl_close($curl);
        //Get Apicall Headers:
        $headers = $this->utils_apicall_service->get_response_headers($response);
        //Get Apicall Data:
        $res_obj = $this->utils_apicall_service->get_response_data($response);
        Log::info("GetUserCartApiCall - Data: " . json_encode($res_obj));
        //Return:
        if ($res_obj !== null) return $res_obj;
        throw new ApiCallException();
        */
        $cart = [
            "id" => 1,
            "user" => 1,
            "items" => [
                ["id" => 1, "quantity" => 1],
                ["id" => 3, "quantity" => 1]
            ]
        ];
        return $cart;

    }
}
?>