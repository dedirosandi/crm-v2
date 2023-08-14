<?php
$pages = @$_GET['pages'];
$act = @$_GET['act'];

switch ($pages) {
        // DASHBOARD
    case "":
    case "dashboard":
        include "pages/main/index.php";
        break;
        // UNIT
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
        // CUSTOMER
    case "customer":
        if ($act == "") {
            include "pages/customer/index.php";
        } else if ($act == "create") {
            include "pages/customer/create.php";
        } else if ($act == "create-process") {
            include "pages/customer/create-process.php";
        }
        break;
        // USER
    case "user":
        if ($act == "") {
            include "pages/user/index.php";
        } else if ($act == "create") {
            include "pages/user/create.php";
        } else if ($act == "create-process") {
            include "pages/user/create-process.php";
        } else if ($act == "status-process") {
            include "pages/user/status-process.php";
        }
        break;
        // SURVEY
    case "survey":
        if ($act == "") {
            include "pages/survey/index.php";
        } else if ($act == "create") {
            include "pages/survey/create.php";
        } else if ($act == "create-process") {
            include "pages/survey/create-process.php";
        } else if ($act == "status-process") {
            include "pages/survey/status-process.php";
        }
        break;
        // ERROR
    default:
        include "pages/error/404.php";
}
