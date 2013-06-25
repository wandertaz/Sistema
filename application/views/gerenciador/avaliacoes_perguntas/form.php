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
	 			<label for="area">Área</label>
	 			<?php echo form_dropdown("area", array('G' => 'Geral', 'I' => 'Instrutor', 'C' => 'Conteúdo', 'P' => 'Programa'), set_value("area", (isset($registro) ? $registro->area : "")), "id=\"area\" class=\"required\""); ?>
			</div>

			<div class="input text">
	 			<label for="tipo">Tipo de Pergunta</label>
	 			<?php echo form_dropdown("tipo", array('' => 'Tipo', 'A' => 'Aberto', 'F' => 'Fechado'), set_value("tipo", (isset($registro) ? $registro->tipo : "")), "id=\"tipo\" class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="titulo">Título</label>
	 			<input name="titulo" id="titulo" type="text" value="<?php echo (isset($registro) ? $registro->titulo : ''); ?>" class="required" />
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>