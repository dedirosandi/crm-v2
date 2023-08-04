<?php
$unit_is = $_GET["unit_is"];

$delete = mysqli_query($koneksi, "DELETE FROM tb_dokumen WHERE id = '$id_dokumen'");
unlink("files/dokumen/" . $GetDokumen["file_dokumen"]);

if ($delete) {
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
