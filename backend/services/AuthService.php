<?php

class AuthService
{
    public static function hashPassword($password)
    {
        if (self::isPasswordPwned($password)) {
            throw new Exception("⚠️ Vaša lozinka je kompromitovana. Molimo Vas izaberite drugu.");
        }
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    private static function isPasswordPwned($password)
    {
        $sha1 = strtoupper(sha1($password));
        $prefix = substr($sha1, 0, 5);
        $suffix = substr($sha1, 5);

        $url = "https://api.pwnedpasswords.com/range/" . $prefix;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return str_contains($response, $suffix);
    }
}
