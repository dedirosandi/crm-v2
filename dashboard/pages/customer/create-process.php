<?php
$no_order = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["no_order"]));
$date_order = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["date_order"]));
$name = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["name"]));
$address = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["address"]));
$id_card = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["id_card"]));
$phone = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["phone"]));
$email = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["email"]));
$unit_is = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["unit_is"]));
$salles_is = $_SESSION["id"];



$insert = mysqli_query($koneksi, "INSERT INTO tb_customer (no_order, date_order, name, address, id_card, phone, email, unit_is, salles_is) VALUES ('$no_order','$date_order','$name','$address','$id_card','$phone','$email','$unit_is','$salles_is')");
if ($insert) {
    $_SESSION["notification"] = "Penambahan Customer berhasil !!!";
    $_SESSION["notification_color"] = "green";
    header("location:?pages=unit");
    exit();
} else {
    $_SESSION["notification"] = "Penambahan Customer gagal !!!";
    $_SESSION["notification_color"] = "red";
    header("location:?pages=unit");
    exit();
}
