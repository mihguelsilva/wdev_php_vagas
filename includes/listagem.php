<?php
$mensagem = '';

if (isset($_GET['status']))
{
    switch($_GET['status'])
    {
	case 'success':
	$mensagem = '<div class="alert alert-success mt-3">Ação executada com sucesso!</div>';
	break;
	case 'error':
	$mensagem = '<div class="alert alert-danger mt-3">Ação não executada!</div>';
	break;
    } 
}

$resultados = "";
foreach($vagas as $vaga)
{
    $resultados .= "<tr>
    <td>". $vaga -> ID ."</td>
    <td>". $vaga -> TITLE ."</td>
    <td>". $vaga -> DESCRIPTION ."</td>
    <td>". ($vaga -> ACTIVE == 'y' ? 'Ativo' : 'Inativo') ."</td>
    <td>". date('d/m/Y à\s H:i:s', strtotime($vaga -> DATA)) ."</td>
    <td>
        <a href='editar.php?id=".$vaga->ID."'><button type='button' class='btn btn-primary'>Editar</button></a>
        <a href='excluir.php?id=".$vaga->ID."'><button type='button' class='btn btn-danger'>Excluir</button></a>
    </td>
    </tr>";
}


?>

<main>
    <?=$mensagem?>
    <section>
	<a href="cadastrar.php">
	    <button class="btn btn-success mt-3">Nova Vaga</button>
	</a>
    </section>

    <section>
	<table class="table bg-light mt-3">
	    <thead>
		<tr>
		    <th>ID</th>
		    <th>Título</th>
		    <th>Descrição</th>
		    <th>Status</th>
		    <th>Data</th>
		    <th>Ações</th>
		</tr>
	    </thead>
	    <tbody>
		<?php echo $resultados; ?>
	    </tbody>
	</table>
    </section>
</main>
