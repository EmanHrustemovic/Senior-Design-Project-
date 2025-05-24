<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://43n328.api.infobip.com/sms/2/text/advanced',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{"messages":[{"destinations":[{"to":"+38762483097"}],"from":"InfoSMS","text":"This is a sample message"}]}',
    CURLOPT_HTTPHEADER => array(
        'Authorization: {authorization}',
        'Content-Type: application/json',
        'Accept: application/json'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

//MOJA FUNCKIJA 
function sendSMS($mobile_number, $code)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://43n328.api.infobip.com/sms/2/text/advanced',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
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
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic ' . base64_encode('63214a1c89bd8950db834c43f2120fb5-8c52b9a3-eb80-4004-b179-a642a73503ab'),
            'Content-Type: application/json',
            'Accept: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}


$phone = "+38762483097";//Ne znam kako ovo da promijenim 
// da uhvatim broj sa frontenda kad klikne POSALJI SMS
$code = rand(100000, 999999);

echo sendSMS($phone, $code);