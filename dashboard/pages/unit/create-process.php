<?php
$type = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["type"]));
$block = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["block"]));
$location = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["location"]));
$excess_land = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["excess_land"]));
$unit_stock = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["unit_stock"]));


$rand = rand();
$filename = $_FILES['picture']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
$picture = $rand . '_' . $filename;
move_uploaded_file($_FILES['picture']['tmp_name'], '../storage/image-unit/' . $rand . '_' . $filename);

$insert = mysqli_query($koneksi, "INSERT INTO tb_unit (type, block, location, excess_land, unit_stock, picture, status) VALUES ('$type','$block','$location','$excess_land','$unit_stock','$picture','available')");
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
