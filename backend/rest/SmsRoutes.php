<?php
require_once __DIR__ . '/../services/config.php';

Flight::route('POST /send-sms', function () {
    $data = Flight::request()->data;
    $phone = $data['phone'];
    $code = rand(100000, 999999);

    $response = sendSMS($phone, $code);
    Flight::json(['status' => 'sent', 'code' => $code, 'response' => $response]);
});

function sendSMS($mobile_number, $code)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://43n328.api.infobip.com/sms/2/text/advanced',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode([
            "messages" => [
                [
                    "destinations" => [["to" => $mobile_number]],
                    "from" => "LAB 1",
                    "text" => "Your verification code is: $code"
                ]
            ]
        ]),
        CURLOPT_HTTPHEADER => [
            'Authorization: App 63214a1c89bd8950db834c43f2120fb5-8c52b9a3-eb80-4004-b179-a642a73503ab',
            'Content-Type: application/json',
            'Accept: application/json'
        ]
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

?>