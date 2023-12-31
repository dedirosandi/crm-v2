<?php
// Memulai session
session_start();
$user_id = $_SESSION["id"];
require_once "../env/connection.php";

// Cek apakah pengguna sudah login (sesi login aktif)
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "login") {
    // Jika belum login, redirect kembali ke halaman login
    $_SESSION["notification_color"] = "red";
    $_SESSION["notification"] = "Anda belum login !!!";
    header("location: ../");
    exit;
}
// Set judul default jika tidak ada judul yang dikirim dari halaman
$title = "CRM";

if (isset($_GET['title'])) {
    // Jika judul dikirim dari halaman, gunakan judul tersebut
    $title = htmlspecialchars($_GET['title']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="../assets/css/pages/simple-datatables.css">
    <link rel="stylesheet" href="../assets/extensions/choices.js/public/assets/styles/choices.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <!-- sidebar -->
            <?php require_once "layouts/sidebar.php" ?>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <!-- routes -->
            <?php require_once "../routes/web.php" ?>

        </div>
    </div>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="../assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/js/pages/dashboard.js"></script>
    <script>
        // Mengubah judul halaman index.php saat halaman ini dimuat
        document.addEventListener("DOMContentLoaded", function() {
            document.title = "CRM - <?= htmlspecialchars($title); ?>";
        });
    </script>
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
    <script>
        function showConfirmation() {
            Swal.fire({
                text: 'Anda yakin ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna menekan tombol "Ya, Logout", submit form logout
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="../assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="../assets/js/pages/simple-datatables.js"></script>
    <script src="../assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="../assets/js/pages/form-element-select.js"></script>

</body>

</html>