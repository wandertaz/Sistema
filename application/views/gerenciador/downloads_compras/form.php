<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

	  		<div class="input text">
	 			<label for="downloads_categorias_id_downloads_categorias">Linha de Negócio</label>
	 			<?php echo form_dropdown("downloads_categorias_id_downloads_categorias", $categorias, set_value("downloads_categorias_id_downloads_categorias", (isset($registro) ? $registro->downloads_categorias_id_downloads_categorias : "")), "class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="titulo">Título</label>
	 			<input name="titulo" id="titulo" type="text" value="<?php echo (isset($registro) ? $registro->titulo : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="descricao">Descrição</label>
				<textarea name="descricao" id="descricao" class="required"><?php echo (isset($registro) ? $registro->descricao : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="preco">Preço</label>
	 			<input name="preco" id="preco" type="text" class="required" value="<?php echo (isset($registro) ? number_format($registro->preco, 2, ',', '.') : ''); ?>"  maxlength="9" onkeypress="return formataMoeda(this, '.', ',', event);" />
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<input name="id_downloads" id="id_downloads" type="hidden" value="<?php echo (isset($registro) ? $registro->id_downloads : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>