<?php
// session_start();
require_once "../env/PHPMailer/src/PHPMailer.php";
require_once "../env/PHPMailer/src/SMTP.php";
require_once "../env/PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'skiddie.id@gmail.com';
$mail->Password   = 'zbjewozgaszkvjno';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = 587;

$mail->setFrom('no-reply@skiddie.id', 'Skiddie ID - Survey');
$mail->Subject = 'Survey Invitation';

$selectedUsers = isset($_POST['customer_is']) ? $_POST['customer_is'] : [];

foreach ($selectedUsers as $selectedUser) {
    $GetCustomer = query("SELECT * FROM tb_customer WHERE id = '$selectedUser'");

    if ($GetCustomer) {
        $email = $GetCustomer[0]["email"];
        $name = $GetCustomer[0]["name"];

        $mail->addAddress($email, $name);

        $surveyLink = "https://skiddie.id/survey?customer_id=" . $selectedUser;
        $mail->Body = "Hello $name,\n\nPlease take a moment to complete our survey: $surveyLink";

        try {
            if (!$mail->send()) {
                throw new Exception("Gagal mengirim undangan survei");
            }

            $_SESSION["notification"] = "Undangan survei telah dikirim";
            $_SESSION["notification_color"] = "green";
        } catch (Exception $e) {
            $_SESSION["notification"] = "Terjadi kesalahan dalam mengirim email: " . $e->getMessage();
            $_SESSION["notification_color"] = "red";
        }

        $mail->clearAddresses();
    }
}

header("Location: ?pages=customer");
exit();
