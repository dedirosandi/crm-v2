<?php
if (!isset($_SESSION["login"]) || $_SESSION["user_is"] !== "admin") {
    // Jika belum login, redirect kembali ke halaman login
    $_SESSION["notification_color"] = "red";
    $_SESSION["notification"] = "Anda tidak diizinkan !!!";
    header("location: ../");
    exit;
}
// $id = $_GET["id"];
$status_is = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["status_is"]));
$id = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["id"]));
// var_dump($id);
// die;

$update = mysqli_query($koneksi, "UPDATE tb_user SET status_is = '$status_is' WHERE id = '$id'");
if ($update) {
    $_SESSION["notification"] = "Perubahan Status berhasil !!!";
    $_SESSION["notification_color"] = "green";
    header("location:?pages=user");
    exit();
} else {
    $_SESSION["notification"] = "Perubahan Status gagal !!!";
    $_SESSION["notification_color"] = "red";
    header("location:?pages=user");
    exit();
}
