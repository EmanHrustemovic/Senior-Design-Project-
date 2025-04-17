<?php

use OTPHP\TOTP;

class OtpService
{
    public static function generateSecret()
    {
        $otp = TOTP::create();
        return $otp->getSecret();
    }

    public static function getQrCodeUrl($secret, $username = "user")
    {
        $otp = TOTP::create($secret);
        $otp->setLabel($username);
        return $otp->getQrCodeUri();
    }

    public static function verifyOtp($secret, $code)
    {
        $otp = TOTP::create($secret);
        return $otp->verify($code);
    }
}
