<?php
$pages = @$_GET['pages'];
$act = @$_GET['act'];

switch ($pages) {
    case "dashboard":
    case "":
        include "pages/main/index.php";
        break;
    case "unit":
        if ($act == "") {
            include "pages/unit/index.php";
        } else if ($act == "create") {
            include "pages/unit/create.php";
        }
        break;
    default:
        include "pages/error-page/404.php";
}
