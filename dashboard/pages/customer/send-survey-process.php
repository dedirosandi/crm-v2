<?php
require_once "../../env/PHPMailer/src/PHPMailer.php";
require_once "../../env/PHPMailer/src/SMTP.php";
require_once "../../env/PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

// Inisialisasi PHPMailer
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com'; // Ganti dengan alamat SMTP server Anda
$mail->SMTPAuth   = true;
$mail->Username   = 'skiddie.id@gmail.com'; // Ganti dengan username email Anda
$mail->Password   = 'zbjewozgaszkvjno'; // Ganti dengan password email Anda
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Ganti dengan metode enkripsi yang sesuai dengan server Anda
$mail->Port       = 587; // Ganti dengan port SMTP server Anda

// Set pengirim dan subjek email
$mail->setFrom('skiddie.id@gmail.com', 'Skiddie ID - Survey'); // Alamat email dan nama pengirim
$mail->Subject = 'Survey Invitation'; // Subjek email


// Ambil data pengguna yang terpilih melalui checkbox
$selectedUsers = isset($_POST['customer_is']) ? $_POST['customer_is'] : [];

// Loop untuk mengirim email ke masing-masing pengguna yang terpilih
foreach ($selectedUsers as $selectedUser) {
    // Ambil data pengguna berdasarkan ID
    $GetCustomer = query("SELECT * FROM tb_customer WHERE id = '$selectedUser'"); // Ganti query sesuai dengan data pengguna

    if ($GetCustomer) {
        $email = $GetCustomer[0]["email"];
        $name = $GetCustomer[0]["name"];


        // Set alamat email penerima dan nama penerima
        $mail->addAddress($email, $name);

        // Isi konten email (misalnya link ke survei)
        $surveyLink = "https://example.com/survey?customer_id=" . $selectedUser; // Ganti dengan URL survei Anda
        $mail->Body = "Hello $name,\n\nPlease take a moment to complete our survey: $surveyLink";

        // Kirim email
        if (!$mail->send()) {
            $_SESSION["notification"] = "Gagal !!!";
            $_SESSION["notification_color"] = "red";
            header("location:?pages=customer");
            exit();
        } else {
            $_SESSION["notification"] = "Berhasil !!!";
            $_SESSION["notification_color"] = "green";
            header("location:?pages=customer");
            exit();
        }

        // Bersihkan alamat penerima untuk email berikutnya
        $mail->clearAddresses();
    }
}
