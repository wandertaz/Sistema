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
	 			<label for="pergunta_id">Pergunta</label>
	 			<?php echo form_dropdown("pergunta_id", $perguntas, set_value("pergunta_id", (isset($registro) ? $registro->pergunta_id : "")), "id=\"pergunta_id\" class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="resposta">Resposta</label>
	 			<input name="resposta" id="resposta" type="text" value="<?php echo (isset($registro) ? $registro->resposta : ''); ?>" class="required" />
			</div>

			<div class="input text">
	 			<label for="correta">Correta?</label>
	 			<?php echo form_dropdown("correta", array('S' => 'Sim', 'N' => 'Não'), set_value("correta", (isset($registro) ? $registro->correta : "")), "id=\"correta\" class=\"required\" "); ?>
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>