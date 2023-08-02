<?php
session_start();
session_unset();
session_destroy();
session_start();
$_SESSION["notification"] = "Anda berhasil logout !!!";
$_SESSION["notification_color"] = "green";
header("location: ../");
exit;
