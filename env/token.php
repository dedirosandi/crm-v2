<?php
function generateToken()
{
    // Cek apakah $_SESSION['token'] sudah ada
    if (isset($_SESSION['token'])) {
        // Cek apakah waktu terakhir token di-generate sudah lebih dari 3 menit (180 detik)
        $currentTime = time();
        $lastGeneratedTime = $_SESSION['token_generated_time'];
        $timeDifference = $currentTime - $lastGeneratedTime;

        if ($timeDifference < 180) {
            // Jika waktu belum mencapai 3 menit, gunakan token yang sudah ada
            return $_SESSION['token'];
        }
    }

    // Jika waktu sudah lebih dari 3 menit, generate token baru
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;
    $_SESSION['token_generated_time'] = time(); // Simpan waktu terakhir token di-generate
    return $token;
}
