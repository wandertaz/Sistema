<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>
<!--
	  		<div class="input text">
	 			<label for="downloads_categorias_id_downloads_categorias">Categoria <br /><i>Se o cadastro for de subcategoria, escolha a Categoria que a pertence.</i></label>
	 			<?php echo form_dropdown("downloads_categorias_id_downloads_categorias", $categorias, set_value("downloads_categorias_id_downloads_categorias", (isset($registro) ? $registro->downloads_categorias_id_downloads_categorias : ""))); ?>
			</div>
-->
	 		<div class="input text obrigatorio">
	 			<label for="nome_categoria">Nome</label>
	 			<input name="nome_categoria" id="nome_categoria" type="text" value="<?php echo (isset($registro) ? $registro->nome_categoria : ''); ?>" class="required" />
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<input name="id_downloads_categorias" id="id_downloads_categorias" type="hidden" value="<?php echo (isset($registro) ? $registro->id_downloads_categorias : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>