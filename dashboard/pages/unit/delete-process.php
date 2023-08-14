<?php
$unit_is = $_POST["unit_is"];

$GetPicture = query("SELECT * FROM tb_unit WHERE id='$unit_is'")[0];


unlink("../storage/image-unit/" . $GetPicture["picture"]);


$delete_unit = mysqli_query($koneksi, "DELETE FROM tb_unit WHERE id = '$unit_is'");

if ($delete_unit) {
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
