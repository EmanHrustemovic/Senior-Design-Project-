<?php

require_once __DIR__ . '/../services/OtpService.class.php';
require_once __DIR__ . '/../dao/OtpDao.class.php';

Flight::route('GET /otp/setup/@id', function($id) {
    $otpService = new OtpService();
    $otpDao = new OtpDao(Flight::db());

    $user = "eman@example.com"; // koristi email iz baze po ID-u

    $secret = $otpService->generateSecret();
    $otpDao->saveUserOtpSecret($id, $secret);

    $qrUrl = $otpService->getQrCodeUrl($user, $secret);

    Flight::json(['qr' => $qrUrl]);
});

Flight::route('POST /otp/verify/@id', function($id) {
    $data = Flight::request()->data->getData();
    $code = $data['code'];

    $otpService = new OtpService();
    $otpDao = new OtpDao(Flight::db());

    $secret = $otpDao->getUserOtpSecret($id);

    if (!$secret) {
        Flight::halt(400, "Secret not found for user.");
    }

    $isValid = $otpService->verifyCode($secret, $code);

    Flight::json(['valid' => $isValid]);
});
