<?php
require_once "../env/connection.php"; // Sesuaikan dengan lokasi file koneksi Anda

// Fungsi untuk mengenkripsi ID pengguna
function encryptUserID($userID)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $key = substr(str_shuffle($characters), 0, 8);
    return base64_encode($userID ^ $key);
}

// Fungsi untuk mendekripsi ID pengguna
function decryptUserID($encryptedID, $key)
{
    $userID = base64_decode($encryptedID);
    return $userID ^ $key;
}

// Ambil ID pengguna dari query string
if (isset($_GET['customer_id'])) {
    $encryptedID = $_GET['customer_id'];

    // Mendekripsi ID pengguna
    $key = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
    $userID = decryptUserID(urldecode($encryptedID), $key);

    // Pengecekan apakah ID pengguna ada di tabel tb_customer
    $customerData = query("SELECT * FROM tb_customer WHERE id = '$userID'");

    if (!$customerData) {
        echo "Invalid customer ID.";
        exit();
    }

    // Di sini Anda dapat menggunakan $userID untuk mengambil data survei dari basis data
    $surveyData = query("SELECT * FROM tb_survey_responses WHERE customer_is = '$userID'");
} else {
    echo "Invalid customer ID.";
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Survey</title>
</head>

<body>
    <h1>Survey</h1>
    <?php if (isset($surveyData)) : ?>
        <p>Hello, please complete the survey below:</p>
        <!-- Tampilkan formulir survei -->
        <form action="submit_survey.php" method="post">
            <!-- Tambahkan elemen-elemen survei di sini -->
            <!-- Contoh: -->
            <label for="answer1">Question 1: How satisfied are you?</label>
            <input type="radio" name="answer1" value="Satisfied"> Satisfied
            <input type="radio" name="answer1" value="Neutral"> Neutral
            <input type="radio" name="answer1" value="Dissatisfied"> Dissatisfied
            <br>
            <label for="answer2">Question 2: What do you like most?</label>
            <textarea name="answer2" rows="4" cols="50"></textarea>
            <br>
            <input type="submit" value="Submit">
        </form>
    <?php else : ?>
        <p>No survey data available.</p>
    <?php endif; ?>
</body>

</html>