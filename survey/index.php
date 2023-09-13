<!DOCTYPE html>
<html lang="en">
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once "../env/connection.php"; // Sesuaikan dengan lokasi file koneksi Anda

// Ambil ID pengguna dari query string
$to = $_GET['to'];
$customerData = query("SELECT * FROM tb_customer WHERE email = '$to'");
$customer_is = $customerData[0]["id"];

$surveyData = query("SELECT * FROM tb_survey_responses WHERE customer_is = '$customer_is'");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Survey Form</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .survey-container {
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .survey-container h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .btn-custom {
            background-color: #007bff;
            border: none;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .survey-container label {
            /* color: #007bff; */
            font-weight: bold;
        }

        .survey-container select.form-select,
        .survey-container .form-control {
            border-color: #007bff;
        }

        @media (max-width: 576px) {
            .survey-container {
                margin: 20px auto;
                padding: 10px;
                width: 80%;
            }
        }
    </style>
</head>

<body>
    <div class="container survey-container">
        <?php if (!$customerData) { ?>
            <div class="text-center">
                <h5>404</h5>
            </div>
        <?php } else { ?>
            <?php if (!$surveyData) { ?>
                <h3>Survey Form</h3>
                <form method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Pengalaman kunjungan anda ke martketing gallery</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="pengalaman_kunjungan" id="pengalaman_kunjungan1" required>
                            <label class="form-check-label" for="pengalaman_kunjungan1">
                                Buruk 😨
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="2" type="radio" name="pengalaman_kunjungan" id="pengalaman_kunjungan2" required>
                            <label class="form-check-label" for="pengalaman_kunjungan2">
                                Cukup 😐
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="3" type="radio" name="pengalaman_kunjungan" id="pengalaman_kunjungan3" required>
                            <label class="form-check-label" for="pengalaman_kunjungan3">
                                Baik 🙂
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="4" type="radio" name="pengalaman_kunjungan" id="pengalaman_kunjungan4" required>
                            <label class="form-check-label" for="pengalaman_kunjungan4">
                                Terkesan 😊
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="5" type="radio" name="pengalaman_kunjungan" id="pengalaman_kunjungan4" required>
                            <label class="form-check-label" for="pengalaman_kunjungan4">
                                Sangat Memuaskan 🥰
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Kenyamanan & kebersihan martketing gallery</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="kenyamanan_kebersihan" id="kenyamanan_kebersihan1" required>
                            <label class="form-check-label" for="kenyamanan_kebersihan1">
                                Buruk 😨
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="2" type="radio" name="kenyamanan_kebersihan" id="kenyamanan_kebersihan2" required>
                            <label class="form-check-label" for="kenyamanan_kebersihan2">
                                Cukup 😐
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="3" type="radio" name="kenyamanan_kebersihan" id="kenyamanan_kebersihan3" required>
                            <label class="form-check-label" for="kenyamanan_kebersihan3">
                                Baik 🙂
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="4" type="radio" name="kenyamanan_kebersihan" id="kenyamanan_kebersihan4" required>
                            <label class="form-check-label" for="kenyamanan_kebersihan4">
                                Terkesan 😊
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="5" type="radio" name="kenyamanan_kebersihan" id="kenyamanan_kebersihan4" required>
                            <label class="form-check-label" for="kenyamanan_kebersihan4">
                                Sangat Memuaskan 🥰
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">informasi tentang properti di martketing gallery</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="informasi_properti" id="informasi_properti1" required>
                            <label class="form-check-label" for="informasi_properti1">
                                Buruk 😨
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="2" type="radio" name="informasi_properti" id="informasi_properti2" required>
                            <label class="form-check-label" for="informasi_properti2">
                                Cukup 😐
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="3" type="radio" name="informasi_properti" id="informasi_properti3" required>
                            <label class="form-check-label" for="informasi_properti3">
                                Baik 🙂
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="4" type="radio" name="informasi_properti" id="informasi_properti4" required>
                            <label class="form-check-label" for="informasi_properti4">
                                Terkesan 😊
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="5" type="radio" name="informasi_properti" id="informasi_properti4" required>
                            <label class="form-check-label" for="informasi_properti4">
                                Sangat Memuaskan 🥰
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">informasi navigasi peta ke martketing gallery</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="navigasi_peta" id="navigasi_peta1" required>
                            <label class="form-check-label" for="navigasi_peta1">
                                Buruk 😨
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="2" type="radio" name="navigasi_peta" id="navigasi_peta2" required>
                            <label class="form-check-label" for="navigasi_peta2">
                                Cukup 😐
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="3" type="radio" name="navigasi_peta" id="navigasi_peta3" required>
                            <label class="form-check-label" for="navigasi_peta3">
                                Baik 🙂
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="4" type="radio" name="navigasi_peta" id="navigasi_peta4" required>
                            <label class="form-check-label" for="navigasi_peta4">
                                Terkesan 😊
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="5" type="radio" name="navigasi_peta" id="navigasi_peta4" required>
                            <label class="form-check-label" for="navigasi_peta4">
                                Sangat Memuaskan 🥰
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Responsibilitas staff martketing gallery</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="respons_staf" id="respons_staf1" required>
                            <label class="form-check-label" for="respons_staf1">
                                Buruk 😨
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="2" type="radio" name="respons_staf" id="respons_staf2" required>
                            <label class="form-check-label" for="respons_staf2">
                                Cukup 😐
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="3" type="radio" name="respons_staf" id="respons_staf3" required>
                            <label class="form-check-label" for="respons_staf3">
                                Baik 🙂
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="4" type="radio" name="respons_staf" id="respons_staf4" required>
                            <label class="form-check-label" for="respons_staf4">
                                Terkesan 😊
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="5" type="radio" name="respons_staf" id="respons_staf4" required>
                            <label class="form-check-label" for="respons_staf4">
                                Sangat Memuaskan 🥰
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Penjelasan sales martketing gallery tentang produk</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="penjelasan_sales" id="penjelasan_sales1" required>
                            <label class="form-check-label" for="penjelasan_sales1">
                                Buruk 😨
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="2" type="radio" name="penjelasan_sales" id="penjelasan_sales2" required>
                            <label class="form-check-label" for="penjelasan_sales2">
                                Cukup 😐
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="3" type="radio" name="penjelasan_sales" id="penjelasan_sales3" required>
                            <label class="form-check-label" for="penjelasan_sales3">
                                Baik 🙂
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="4" type="radio" name="penjelasan_sales" id="penjelasan_sales4" required>
                            <label class="form-check-label" for="penjelasan_sales4">
                                Terkesan 😊
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="5" type="radio" name="penjelasan_sales" id="penjelasan_sales4" required>
                            <label class="form-check-label" for="penjelasan_sales4">
                                Sangat Memuaskan 🥰
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="feedback" class="form-label">Feedback</label>
                        <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-custom btn-block text-white">Submit</button>
                </form>

            <?php } else { ?>
                <div class="text-center">
                    <h5>Anda sudah mengisi</h5>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>