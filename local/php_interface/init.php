<?php
$file1 = $_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/UserGroupHandler.php";
$file2 = $_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/ClearCachel.php";

if (file_exists($file1)) {
    require_once($file1);
}

if (file_exists($file2)) {
    require_once($file2);
}


?>