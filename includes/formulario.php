<main>
    <section>
	<a href="/">
	    <button class="btn btn-success mt-3">Voltar</button>
	</a>
    </section>

    <h2 class="mt-3"><?php echo TITLE;?></h2>

    <form method="POST">
	<div class="form-group">
	    <label class="label-group" for="titulo">Título</label>
	    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $obVaga -> TITLE;?>" required>
	</div>

	<div class="form-group">
	    <label class="label-group" for="descricao">Descrição</label>
	    <textarea class="form-control" id="descricao" name="descricao" rows="5" required><?php echo $obVaga->DESCRIPTION;?></textarea>
	</div>

	<div class="form-group">
	    <label class="label-group">Status</label>

	    <div>
		<!-- Faz com que os elementos fiquem na mesma linha form-check-inline -->
		<div class="form-check-inline">
		    <label class="form-control">
			<input type="radio" name="ativo" value="y" checked> Ativo
		    </label>
		</div>

		<div class="form-check-inline">
		    <label class="form-control">
			<input type="radio" name="ativo" value="n" <?php echo $obVaga->ACTIVE=='n' ? 'checked' : ''?>> Inativo
		    </label>
		</div>
	    </div>

	    <div class="form-group mt-3">
		<button type="submit" class="btn btn-success">Enviar</button>
	    </div>
	</div>
    </form>
</main>
