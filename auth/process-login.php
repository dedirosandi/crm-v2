<?php
// Memulai session
session_start();

// Jika form login telah dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once "../env/connection.php";

    $email = mysqli_escape_string($koneksi, $_POST["email"]);
    $password = mysqli_escape_string($koneksi, $_POST["password"]);
    $check = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE email = '$email'");
    $result = mysqli_fetch_assoc($check);

    if (mysqli_num_rows($check) === 1) {
        if (password_verify($password, $result["password"])) {
            $id = $result["id"];
            $email = $result["email"];
            $user_is = $result["user_is"];
            $status_is = $result["status_is"];

            $_SESSION["id"] = $id;
            $_SESSION["email"] = $email;
            $_SESSION["user_is"] = $user_is;
            $_SESSION["login"] = "login";

            if ($status_is === "0") {
                // Tampilkan notifikasi menggunakan session
                $_SESSION["notification"] = "Akun anda sudah tidak aktif !!!";
                $_SESSION["notification_color"] = "red";
                header("location:../");
                exit;
            } elseif ($status_is === "1") {
                // Tampilkan notifikasi menggunakan session
                $_SESSION["notification"] = "Login Berhasil";
                $_SESSION["notification_color"] = "green";
                header("location:../dashboard");
                exit;
            }
        } else {
            // Tampilkan notifikasi menggunakan session
            $_SESSION["notification"] = "Password anda salah !!!";
            $_SESSION["notification_color"] = "red";
            header("location:../");
            exit;
        }
    } else {
        // Tampilkan notifikasi menggunakan session
        $_SESSION["notification"] = "Email anda tidak terdaftar !!!";
        $_SESSION["notification_color"] = "red";
        header("location:../");
        exit;
    }
} else {
    // Jika form login tidak dikirimkan, redirect kembali ke halaman login
    header("location:../");
    exit;
}
