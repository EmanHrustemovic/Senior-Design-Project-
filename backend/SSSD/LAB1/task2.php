<?php

class CurlUtil {
    private static function sendRequest($url, $method, $headers = [], $data = null) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
        ]);

        if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function getRequest($url) {
        $headers = [
            'X-Custom-Header: Value1',
            'Authorization: Bearer YourToken'
        ];
        return self::sendRequest($url, 'GET', $headers);
    }

    public static function postRequest($url) {
        $headers = [
            'Content-Type: application/json'
        ];
        $data = json_encode(['name' => 'John', 'email' => 'john@example.com']);
        return self::sendRequest($url, 'POST', $headers, $data);
    }

    public static function deleteRequest($url) {
        return self::sendRequest($url, 'DELETE');
    }

    public static function putRequestForm($url) {
        $headers = [
            'Content-Type: application/x-www-form-urlencoded'
        ];
        $data = http_build_query(['name' => 'Jane', 'email' => 'jane@example.com']);
        return self::sendRequest($url, 'PUT', $headers, $data);
    }

    public static function patchRequest($url) {
        $headers = [
            'User-Agent: MyCustomUserAgent/1.0'
        ];
        $data = json_encode(['status' => 'active']);
        return self::sendRequest($url, 'PATCH', $headers, $data);
    }

    public static function putRequestJson($url) {
        $headers = [
            'Content-Type: application/json',
            'X-Request-ID: 789'
        ];
        $data = json_encode(['theme' => 'dark', 'notifications' => 'enabled']);
        return self::sendRequest($url, 'PUT', $headers, $data);
    }
}


$url = "https://eovf7ospbscaqrb.m.pipedream.net";

echo CurlUtil::getRequest("$url/data");
echo CurlUtil::postRequest("$url/users");
echo CurlUtil::deleteRequest("$url/users/123");
echo CurlUtil::putRequestForm("$url/users/123");
echo CurlUtil::patchRequest("$url/users/123");
echo CurlUtil::putRequestJson("$url/settings/456");

?>