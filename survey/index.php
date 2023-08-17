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
            color: #007bff;
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
        <h3>Survey Form</h3>
        <?php if (!$customerData) { ?>
            <div class="text-center">
                <h5>Undangan ini bukan untuk anda</h5>
            </div>
        <?php } else { ?>
            <?php if (!$surveyData) { ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="" disabled selected>Select your gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
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