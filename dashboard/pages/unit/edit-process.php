<?php
$id = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["id"]));
$type = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["type"]));
$block = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["block"]));
$location = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["location"]));
$excess_land = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["excess_land"]));
$unit_stock = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST["unit_stock"]));

$oldPicture = query("SELECT * FROM tb_unit WHERE id='$id'");
$PictureOld = $oldPicture[0]["picture"];

$rand = rand();
$filename = $_FILES['picture']['name'];

if (!empty($filename)) {
    // Hapus gambar lama hanya jika ada
    if (!empty($PictureOld)) {
        unlink("../storage/image-unit/" . $PictureOld);
    }

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $picture = $rand . '_' . $filename;

    move_uploaded_file($_FILES['picture']['tmp_name'], '../storage/image-unit/' . $rand . '_' . $filename);
} else {
    // Jika tidak ada gambar baru, gunakan gambar lama
    $picture = $PictureOld;
}

$update = mysqli_query($koneksi, "UPDATE tb_unit SET type = '$type', block = '$block', location = '$location', excess_land = '$excess_land', unit_stock = '$unit_stock', picture = '$picture' WHERE id = '$id'");

if ($update) {
    $_SESSION["notification"] = "Perubahan unit berhasil !!!";
    $_SESSION["notification_color"] = "green";
    header("location:?pages=unit");
    exit();
} else {
    $_SESSION["notification"] = "Perubahan unit gagal !!!";
    $_SESSION["notification_color"] = "red";
    header("location:?pages=unit");
    exit();
}
