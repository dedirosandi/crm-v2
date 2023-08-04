<?php
$type = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["type"]));
$block = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["block"]));
$location = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["location"]));
$excess_land = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["excess_land"]));
$unit_stock = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["unit_stock"]));


$insert = mysqli_query($koneksi, "INSERT INTO tb_unit (type, block, location, excess_land, unit_stock, status) VALUES ('$type','$block','$location','$excess_land','$unit_stock','available')");
if ($insert) {
    $_SESSION["notification"] = "Penambahan unit berhasil !!!";
    $_SESSION["notification_color"] = "green";
    header("location:?pages=unit");
    exit();
} else {
    $_SESSION["notification"] = "Penambahan unit gagal !!!";
    $_SESSION["notification_color"] = "red";
    header("location:?pages=unit");
    exit();
}
