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
        } else if ($act == "create-process") {
            include "pages/unit/create-process.php";
        } else if ($act == "create-image-process") {
            include "pages/unit/create-image-process.php";
        } else if ($act == "show") {
            include "pages/unit/show.php";
        } else if ($act == "delete") {
            include "pages/unit/delete-process.php";
        } else if ($act == "delete-image") {
            include "pages/unit/delete-image-process.php";
        }
        break;
    default:
        include "pages/error-page/404.php";
}
