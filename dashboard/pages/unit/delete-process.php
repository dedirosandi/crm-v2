<?php
$unit_is = $_POST["unit_is"];
$GetImage = query("SELECT * FROM tb_unit_gallery WHERE unit_is='$unit_is'");


if ($GetImage) {
    foreach ($GetImage as $image) {
        if (file_exists("../storage/image-unit/" . $image["image"])) {
            unlink("../storage/image-unit/" . $image["image"]);
        }
    }
}

$delete_unit = mysqli_query($koneksi, "DELETE FROM tb_unit WHERE id = '$unit_is'");
$delete_gallery = mysqli_query($koneksi, "DELETE FROM tb_unit_gallery WHERE unit_is='$unit_is'");

if ($delete_unit && $delete_gallery) {
    $_SESSION["notification"] = "Penghapusan unit berhasil !!!";
    $_SESSION["notification_color"] = "green";
    header("location: ?pages=unit");
    exit();
} else {
    $_SESSION["notification"] = "Penghapusan unit gagal !!!";
    $_SESSION["notification_color"] = "red";
    header("location: ?pages=unit");
    exit();
}
