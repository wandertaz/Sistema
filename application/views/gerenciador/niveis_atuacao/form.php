<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

	 		<div class="input text obrigatorio">
	 			<label for="nome_nivel">Nome</label>
	 			<input name="nome_nivel" id="nome_nivel" type="text" value="<?php echo (isset($registro) ? $registro->nome_nivel : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="ordem">Ordem</label>
	 			<input name="ordem" id="ordem" type="text" value="<?php echo (isset($registro) ? $registro->ordem : ''); ?>" class="required" />
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<input name="id_nivel" id="id_nivel" type="hidden" value="<?php echo (isset($registro) ? $registro->id_nivel : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>