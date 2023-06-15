<?php
namespace Siroko\Shared\Utils;

class UtilsApicallService {

    public function get_response_headers(mixed $response): mixed {
        $response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);

        // Convert headers into an array
        $headers = array();
        $header_data = explode("\n",$response[0]);
        $headers['status'] = $header_data[0]; // Does not contain a key, have to explicitly set
        array_shift($header_data); // Remove status, we've already set it above
        foreach($header_data as $part) {
            $h = explode(":", $part);
            $headers[trim($h[0])] = trim($h[1]);
        }
        return $headers;
    }

    public function get_response_data(mixed $response): mixed {
        $response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);
        return json_decode($response[1], TRUE);
    }

}
?>