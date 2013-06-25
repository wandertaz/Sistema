<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

	  	<input type="hidden" name="tipo_curso" id="tipo_curso" value="<?php echo $tipo;  ?>" />

			<div class="input text">
	 			<label for="aula_id">Aula</label>
	 			<?php echo form_dropdown("aula_id", $aulas, set_value("aula_id", (isset($registro) ? $registro->aula_id : "")), "id=\"aula_id\" class=\"required\" "); ?>
			</div>

			<div class="input text">
	 			<label for="tipo">Tipo</label>
	 			<?php echo form_dropdown("tipo", array('E' => 'Exercício', 'P' => 'Prova'), set_value("tipo", (isset($registro) ? $registro->tipo : "")), "id=\"tipo\" class=\"required\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="titulo">T&iacute;tulo</label>
	 			<input name="titulo" id="titulo" type="text" value="<?php echo (isset($registro) ? $registro->titulo : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="valor">Valor</label>
	 			<input name="valor" id="valor" type="text" value="<?php echo (isset($registro) ? $registro->valor : ''); ?>" class="required" />
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "id=\"ativo\" class=\"required\" "); ?>
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>