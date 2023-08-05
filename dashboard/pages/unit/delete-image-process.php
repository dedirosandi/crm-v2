<?php
$id = $_POST["id"];
$GetImage = query("SELECT * FROM tb_unit_gallery WHERE id='$id'")[0];

$unit_id = $GetImage["unit_is"];


$delete_gallery = mysqli_query($koneksi, "DELETE FROM tb_unit_gallery WHERE id='$id'");
unlink("../storage/image-unit/" . $GetImage["image"]);

if ($delete_gallery) {
    $_SESSION["notification"] = "Penghapusan Gambar berhasil !!!";
    $_SESSION["notification_color"] = "green";
    header("location: ?pages=unit&act=show&unit_is=$unit_is");
    exit();
} else {
    $_SESSION["notification"] = "Penghapusan Gambar gagal !!!";
    $_SESSION["notification_color"] = "red";
    header("location: ?pages=unit&act=show&unit_is=$unit_is");
    exit();
}
