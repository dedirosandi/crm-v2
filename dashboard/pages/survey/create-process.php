<?php
$name = $_POST["name"];

$total = count($name);

for ($i = 0; $i < $total; $i++) {
    $name[$i] = htmlspecialchars(mysqli_real_escape_string($koneksi, $name[$i]));
    $insert = mysqli_query($koneksi, "INSERT INTO tb_survey (name) VALUES ('$name[$i]')");
}

if ($insert) {
    $_SESSION["notification"] = "Penambahan data survey berhasil !!!";
    $_SESSION["notification_color"] = "green";
    header("location:?pages=user");
    exit;
} else {
    $_SESSION["notification"] = "Penambahan data survey gagal !!!";
    $_SESSION["notification_color"] = "red";
    header("location:?pages=user");
    exit;
}
