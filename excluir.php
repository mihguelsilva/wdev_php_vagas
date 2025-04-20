<?php
include __DIR__ . DIRECTORY_SEPARATOR . "static" . DIRECTORY_SEPARATOR . "app.php";
use \App\Entity\Vaga;

// VALIDACAO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id']))
{
    header('Location: /index.php?status=error');
    exit();
}

// BUSCAR VAGA ESPECIFICA
$obVaga = Vaga::getVaga($_GET['id']);

// VALIDAR VAGA
if (!$obVaga instanceof Vaga)
{
    header('Location: /index.php?status=error');
    exit();
}

if (isset($_POST['excluir'])) {
    $obVaga -> excluir();

    header("Location: /index.php?status=success");
    exit();

}

require __DIR__ . DS . "includes" . DS . "header.php";
require __DIR__ . DS . "includes" . DS . "confirmar_exclusao.php";
require __DIR__ . DS . "includes" . DS . "footer.php";
?>
