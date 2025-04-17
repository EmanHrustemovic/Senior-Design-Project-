<?php

class OtpDao {
    private PDO $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function saveUserOtpSecret(int $userId, string $secret): void {
        $stmt = $this->conn->prepare("UPDATE korisnici SET otp_secret = :secret WHERE id = :id");
        $stmt->execute(['secret' => $secret, 'id' => $userId]);
    }

    public function getUserOtpSecret(int $userId): ?string {
        $stmt = $this->conn->prepare("SELECT otp_secret FROM korisnici WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['otp_secret'] : null;
    }
}
