<?php
include __DIR__ . DIRECTORY_SEPARATOR . "static" . DIRECTORY_SEPARATOR . "app.php";
use \App\Entity\Vaga;
define("TITLE", "Cadastrar Vaga");

if (isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])) {
    $obVaga = new Vaga;
    $obVaga -> TITLE = $_POST['titulo'];
    $obVaga -> DESCRIPTION = $_POST['descricao'];
    $obVaga -> ACTIVE = $_POST['ativo'];
    $obVaga -> cadastrar();

    header("Location: /index.php?status=success");
    exit();

}

require __DIR__ . DS . "includes" . DS . "header.php";
require __DIR__ . DS . "includes" . DS . "formulario.php";
require __DIR__ . DS . "includes" . DS . "footer.php";
?>
