<?php
$no_order = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["no_order"]));
$date_order = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["date_order"]));
$name = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["name"]));
$address = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["address"]));
$id_card = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["id_card"]));
$phone = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["phone"]));
$email = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["email"]));
$unit_is = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["unit_is"]));
$sales_is = $_SESSION["id"];

// Pastikan bahwa email telah diisi
if ($_SESSION["user_is"] == 'admin') {
    $_SESSION["notification"] = "Gagal, Anda bukan Sales !!!";
    $_SESSION["notification_color"] = "red";
    header("location: ../reset-password");
    exit;
}

$jumlah_terjual = 1; // Ganti dengan jumlah yang sesuai

$GetStock = query("SELECT * FROM tb_unit WHERE id='$unit_is'")[0];

$stok_sekarang = $GetStock["unit_stock"];

$stok_terbaru = $stok_sekarang - $jumlah_terjual;


$update = mysqli_query($koneksi, "UPDATE tb_unit SET unit_stock = $stok_terbaru WHERE id = $unit_is");
$insert = mysqli_query($koneksi, "INSERT INTO tb_customer (no_order, date_order, name, address, id_card, phone, email, unit_is, sales_is) VALUES ('$no_order','$date_order','$name','$address','$id_card','$phone','$email','$unit_is','$sales_is')");
if ($insert) {
    $_SESSION["notification"] = "Penambahan Customer berhasil !!!";
    $_SESSION["notification_color"] = "green";
    header("location:?pages=customer");
    exit();
} else {
    $_SESSION["notification"] = "Penambahan Customer gagal !!!";
    $_SESSION["notification_color"] = "red";
    header("location:?pages=customer");
    exit();
}
