<?php
$pages = @$_GET['pages'];
$act = @$_GET['act'];

switch ($pages) {
    case "dashboard":
    case "":
        include "pages/main/index.php";
        break;
    case "data":
        if ($act == "") {
            include "pages/data/view/view-data.php";
        } else if ($act == "tambah-data") {
            include "pages/data/view/view-tambah-data.php";
        }
        break;
    default:
        include "pages/error-page/404.php";
}
