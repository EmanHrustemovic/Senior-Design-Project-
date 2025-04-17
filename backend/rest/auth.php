<?php

Flight::route('POST /api/register', function () {
    $data = Flight::request()->data;

    $otp_secret = OtpService::generateSecret();
    $user = [
        'email' => $data['email'],
        'password' => $data['password'],
        'otp_secret' => $otp_secret
    ];

    try {
        Flight::korisnikDao()->create($user);

        $qrUrl = OtpService::getQrCodeUrl($otp_secret, $data['email']);
        Flight::json(["status" => "ok", "qr" => $qrUrl]);
    } catch (Exception $e) {
        Flight::json(["error" => $e->getMessage()], 400);
    }
});

Flight::route('POST /api/login', function () {
    $data = Flight::request()->data;

    $user = Flight::korisnikDao()->findByEmail($data['email']);
    if (!$user) {
        Flight::json(["error" => "Korisnik ne postoji"], 404);
        return;
    }

    if (!AuthService::verifyPassword($data['password'], $user['password_hash'])) {
        Flight::json(["error" => "Pogrešna lozinka"], 401);
        return;
    }

    if (!OtpService::verifyOtp($user['otp_secret'], $data['otp'])) {
        Flight::json(["error" => "Neispravan OTP kod"], 401);
        return;
    }

    Flight::json(["status" => "login uspješan"]);
});
