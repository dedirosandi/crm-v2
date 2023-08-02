<?php
require_once "../env/connection.php";

$email = mysqli_escape_string($koneksi, $_POST["email"]);
$password = mysqli_escape_string($koneksi, $_POST["password"]);
$check = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE email = '$email' LIMIT 1");
$result = mysqli_fetch_assoc($check);
if ($result) {
    if (password_verify($password, $result["password"])) {
        $id = $result["id"];
        $email = $result["email"];
        $user_is = $result["user_is"];
        $status_is = $result["status_is"];

        $_SESSION["id"] = $id;
        $_SESSION["email"] = $email;
        $_SESSION["user_is"] = $user_is;
        $_SESSION["login"] = "login";

        if ($status_is === "0") {
            echo "<script>
            Toastify({
                text: 'Akun Tidak Aktif',
                backgroundColor: 'linear-gradient(to right, #00b09b, #96c93d)',
                duration: 3000,
            }).showToast();
          </script>";
        } elseif ($status_is === "1") {
            header("location:../../../?pages=dashboard");
            exit;
        }
    } else {
        echo "<script>
            Toastify({
                text: 'Password salah',
                backgroundColor: 'linear-gradient(to right, #00b09b, #96c93d)',
                duration: 3000,
            }).showToast();
          </script>";
    }
} else {
    echo "<script>
            Toastify({
                text: 'Tidak Terdaftar',
                backgroundColor: 'linear-gradient(to right, #00b09b, #96c93d)',
                duration: 3000,
            }).showToast();
          </script>";
}
