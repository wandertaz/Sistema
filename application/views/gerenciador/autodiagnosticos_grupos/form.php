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
	 			<label for="autodiagnosticos_id_autodiagnostico">Autodiagnóstico</label>
	 			<?php echo form_dropdown("autodiagnosticos_id_autodiagnostico", $autodiagnosticos, set_value("autodiagnosticos_id_autodiagnostico", (isset($registro) ? $registro->autodiagnosticos_id_autodiagnostico : "")), "class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="nome_grupo">Nome do Grupo</label>
	 			<input name="nome_grupo" id="nome_grupo" type="text" value="<?php echo (isset($registro) ? $registro->nome_grupo : ''); ?>" class="required" />
			</div>

			<input name="id_grupo_pergunta" id="id_grupo_pergunta" type="hidden" value="<?php echo (isset($registro) ? $registro->id_grupo_pergunta : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>