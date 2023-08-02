<!DOCTYPE html>
<html lang="en">
<?php
// Memulai session
session_start();

// Cek apakah pengguna sudah login (sesi login aktif)
if (isset($_SESSION["login"]) && $_SESSION["login"] === "login") {
    // Redirect ke halaman dashboard
    header("location: dashboard");
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login CRM</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left-reset">
                    <h1 class="auth-title">Reset password</h1>
                    <form action="auth/process-reset-password.php" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="email" class="form-control form-control-xl" placeholder="Enter email" value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative">
                            <a href="/">Login ?</a>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Reset Now</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
    <?php
    // Tampilkan notifikasi jika ada
    if (isset($_SESSION["notification"])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.js'></script>";
        echo "<script>
                Toastify({
                    text: '" . $_SESSION["notification"] . "',
                    duration: 8000,
                    gravity: 'bottom', // Atur posisi notifikasi (top, bottom, left, right)
                    position: 'right', // Atur posisi notifikasi lebih tepat (top-left, top-center, top-right, bottom-left, bottom-center, bottom-right, left-center, right-center)
                    close: true, // Tampilkan tombol close
                    stopOnFocus: true, // Hentikan durasi notifikasi saat kursor diarahkan ke notifikasi
                    style: {
                        background: '" . $_SESSION["notification_color"] . "', // Gaya latar belakang notifikasi
                    }
                }).showToast();
            </script>";

        // Hapus notifikasi dari session setelah ditampilkan
        unset($_SESSION["notification"]);
        unset($_SESSION["notification_color"]);
    }
    ?>
    </div>
</body>

</html>