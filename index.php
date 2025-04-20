<?php
include __DIR__ . DIRECTORY_SEPARATOR . "static" . DIRECTORY_SEPARATOR . "app.php";
use \App\Entity\Vaga;

$vagas = Vaga::getVagas();

require __DIR__ . DS . "includes" . DS . "header.php";
require __DIR__ . DS . "includes" . DS . "listagem.php";
require __DIR__ . DS . "includes" . DS . "footer.php";
?>
