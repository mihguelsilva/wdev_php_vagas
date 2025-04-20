<?php
define("DS", DIRECTORY_SEPARATOR);
require $_SERVER["DOCUMENT_ROOT"] . DS . "vendor" . DS . "autoload.php";
use \App\Common\Environment;

Environment::load($_SERVER["DOCUMENT_ROOT"]);
?>
