<?php
$id = $_GET["id"];
$status_is = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["status_is"]));

$update = mysqli_query($koneksi, "UPDATE tb_user SET status_is = '$status_is' WHERE id = '$id'");
if ($update) {
    $_SESSION["notification"] = "Penambahan Customer berhasil !!!";
    $_SESSION["notification_color"] = "green";
    header("location:?pages=user");
    exit();
} else {
    $_SESSION["notification"] = "Penambahan Customer gagal !!!";
    $_SESSION["notification_color"] = "red";
    header("location:?pages=user");
    exit();
}
