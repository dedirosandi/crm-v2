<?php
$image = $_FILES["image"];
$unit_is = $_POST["unit_is"];

$total = count($image['name']);

for ($i = 0; $i < $total; $i++) {
    $filename = $image['name'][$i];
    $filename = htmlspecialchars(mysqli_real_escape_string($koneksi, $filename));
    // $unit_is_value = htmlspecialchars(mysqli_real_escape_string($koneksi, $unit_is[$i]));

    // Pastikan folder tujuan untuk menyimpan gambar sudah benar sesuai dengan kebutuhan aplikasi Anda
    $target_directory = '../storage/image-unit/'; // Ganti dengan folder tujuan yang sesuai

    // Buat nama unik untuk gambar dengan menggabungkan timestamp
    $foto = time() . '_' . $filename;
    $target_file_path = $target_directory . $foto;

    // Pindahkan file yang diunggah ke folder tujuan
    if (!move_uploaded_file($image['tmp_name'][$i], $target_file_path)) {
        // Gagal mengunggah gambar
        $_SESSION["notification"] = "Failed to upload images.";
        $_SESSION["notification_color"] = "red";
        header("location:?pages=unit&act=show&unit_is=$unit_is");
        exit();
    }

    // Jika berhasil mengunggah gambar, masukkan nama file ke dalam database
    $insert = mysqli_query($koneksi, "INSERT INTO tb_unit_gallery (image, unit_is) VALUES ('$foto','$unit_is')");

    if (!$insert) {
        $_SESSION["notification"] = "Penambahan unit gagal !!!";
        $_SESSION["notification_color"] = "red";
        header("location:?pages=unit&act=show&unit_is=$unit_is");
        exit();
    }
}

$_SESSION["notification"] = "Penambahan unit berhasil !!!";
$_SESSION["notification_color"] = "green";
header("location:?pages=unit&act=show&unit_is=$unit_is");
exit();
