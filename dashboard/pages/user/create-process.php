<?php
if (!isset($_SESSION["login"]) || $_SESSION["user_is"] !== "admin") {
    // Jika belum login, redirect kembali ke halaman login
    $_SESSION["notification_color"] = "red";
    $_SESSION["notification"] = "Anda tidak diizinkan !!!";
    header("location: ../");
    exit;
}
require_once "../env/PHPMailer/src/PHPMailer.php";
require_once "../env/PHPMailer/src/SMTP.php";
require_once "../env/PHPMailer/src/Exception.php";


// Jika form register telah dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Ambil data dari form
    $name = mysqli_escape_string($koneksi, $_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = mysqli_escape_string($koneksi, $_POST["password"]);
    $user_is = mysqli_escape_string($koneksi, $_POST["user_is"]);

    // Lakukan validasi data
    if (!$email || empty($password)) {
        $_SESSION["notification"] = "Email & Password harus diisi dan sesuai format.";
        $_SESSION["notification_color"] = "red";
        header("location:?pages=user");
        exit;
    }

    // Cek apakah email sudah terdaftar
    $check = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        // Tampilkan notifikasi menggunakan session
        $_SESSION["notification"] = "Email sudah terdaftar, gunakan email lain.";
        $_SESSION["notification_color"] = "red";
        header("location:?pages=user");
        exit;
    }

    // Enkripsi password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan data user ke dalam database
    $insert_query = "INSERT INTO tb_user (name, email, password, user_is, status_is) 
                     VALUES ('$name','$email', '$hashed_password', '$user_is', '1')"; // Asumsi user_is = 'user' dan status_is = 1 (aktif)
    $result = mysqli_query($koneksi, $insert_query);

    if ($result) {
        // Kirim email dengan password ke email user
        sendPasswordEmail($email, $password);

        // Tampilkan notifikasi menggunakan session
        $_SESSION["notification"] = "Registrasi berhasil. Password telah dikirim ke email";
        $_SESSION["notification_color"] = "green";
        header("location:?pages=user");
        exit;
    } else {
        // Tampilkan notifikasi menggunakan session
        $_SESSION["notification"] = "Registrasi gagal. Terjadi kesalahan saat menyimpan data.";
        $_SESSION["notification_color"] = "red";
        header("location:?pages=user");
        exit;
    }
} else {
    // Jika form register tidak dikirimkan, redirect kembali ke halaman registrasi
    header("location:?pages=user");
    exit;
}

// Fungsi untuk mengirimkan email dengan password ke email user
function sendPasswordEmail($email, $password)
{
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Ganti dengan alamat SMTP server Anda
    $mail->SMTPAuth   = true;
    $mail->Username   = 'skiddie.id@gmail.com'; // Ganti dengan username email Anda
    $mail->Password   = 'zbjewozgaszkvjno'; // Ganti dengan password email Anda
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // Gunakan TLS untuk Gmail
    $mail->Port       = 587; // Gunakan port 587 untuk TLS pada Gmail

    // Pengirim email
    $mail->setFrom('noreply@skiddie.com', 'Admin Marketing Gallery'); // Ganti dengan email dan nama Anda

    // Penerima email
    $mail->addAddress($email);

    // Subjek email
    $mail->Subject = "Your Password";

    // Isi email
    $mail->Body = "Your password: $password";

    // Kirim email
    if (!$mail->send()) {
        // Jika terjadi error dalam pengiriman email, tampilkan pesan kesalahan
        $_SESSION["notification"] = "Gagal mengirim email: " . $mail->ErrorInfo;
        $_SESSION["notification_color"] = "red";
    }
}
