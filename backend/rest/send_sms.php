<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["phone"]) || empty($data["phone"])) {
        echo json_encode(["success" => false, "message" => "Broj telefona je obavezan."]);
        exit;
    }

    $phone = $data["phone"];
    $message = "Vaš zahtjev za promjenu lozinke je primljen. Molimo ukucajte Vašu novu lozinku na aplikaciji.";

    function sendSMS($mobile_number, $message) {
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
                        "from" => "Moje Zdravlje",
                        "text" => $message
                    ]
                ]
            ]),
            CURLOPT_HTTPHEADER => array(
                'Authorization: App 63214a1c89bd8950db834c43f2120fb5-8c52b9a3-eb80-4004-b179-a642a73503ab',
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    $response = sendSMS($phone, $message);
    echo json_encode(["success" => true, "message" => "SMS poslan!", "response" => $response]);
} else {
    echo json_encode(["success" => false, "message" => "Nevažeći zahtjev."]);
}
?>
