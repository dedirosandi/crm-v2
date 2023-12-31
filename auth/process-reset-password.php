<?php
session_start();
require_once "../env/connection.php"; // Sisipkan file koneksi.php
require_once "../env/PHPMailer/src/PHPMailer.php";
require_once "../env/PHPMailer/src/SMTP.php";
require_once "../env/PHPMailer/src/Exception.php";
// Memulai session

// Pastikan bahwa email telah diisi
if (empty($_POST["email"])) {
    $_SESSION["notification"] = "Email harus diisi.";
    $_SESSION["notification_color"] = "red";
    header("location: ../reset-password");
    exit;
}

// Validasi email
$email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
if (!$email) {
    $_SESSION["notification"] = "Format email tidak valid.";
    $_SESSION["notification_color"] = "red";
    header("location: ../reset-password");
    exit;
}



// Cek apakah email terdaftar di database
$check = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE email = '$email' LIMIT 1");
$result = mysqli_fetch_assoc($check);
if (!$result) {
    $_SESSION["notification"] = "Email tidak terdaftar.";
    $_SESSION["notification_color"] = "red";
    $_SESSION['email'] = $email;
    header("location: ../reset-password");
    exit;
}

// Generate password baru (tanpa enkripsi)
// Karakter yang ingin Anda tambahkan ke dalam pool karakter yang digunakan
// $additionalCharacters = '!@#$%^&*()_+-=[]{}|;:,.<>?';

// Pool karakter yang digunakan untuk mengacak password
$characterPool = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

// Mengacak karakter dari pool
$passwordBaru = substr(str_shuffle(str_repeat($characterPool, 8)), 0, 8);


// Kirim email dengan password baru menggunakan PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Konfigurasi email
    require_once "../env/email-config.php";

    // Pengirim email
    $mail->setFrom('no-reply@skiddie.id', 'Reset Password'); // Ganti dengan email dan nama Anda

    // Penerima email
    $mail->addAddress($email, $result['name']); // Menggunakan nama dari database

    // Subjek email
    $mail->Subject = "Reset Password Akun " . $result['name'];

    // Isi email
    $mail->Body = "Password baru Anda: $passwordBaru";

    // Kirim email
    $mail->send();

    // Simpan password baru yang belum dienkripsi ke dalam database
    $hashedPasswordBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);
    $id = $result['id'];
    mysqli_query($koneksi, "UPDATE tb_user SET password = '$hashedPasswordBaru' WHERE id = $id");

    // Set notifikasi untuk halaman reset-password.php
    $_SESSION["notification"] = "Password baru telah dikirim ke email Anda.";
    $_SESSION["notification_color"] = "green";

    // Redirect ke halaman reset-password.php
    header("location: ../");
    exit;
} catch (Exception $e) {
    // Jika terjadi error dalam pengiriman email, tampilkan pesan kesalahan
    $_SESSION["notification"] = "Gagal mengirim email: " . $mail->ErrorInfo;
    $_SESSION["notification_color"] = "red";
    $_SESSION['email'] = $email;
    header("location: ../reset-password");
    exit;
}
