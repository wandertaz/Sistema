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

			<div class="input text">
	 			<label for="inscritos_id">Inscrito</label>
	 			<?php echo form_dropdown("inscritos_id", $inscritos, set_value("inscritos_id", (isset($registro) ? $registro->inscritos_id : "")), "class=\"required\""); ?>
			</div>

			<div class="input text">
	 			<label for="status">Status</label>
	 			<?php echo form_dropdown("status", $status, set_value("status", (isset($registro) ? $registro->status : "")), "class=\"required\""); ?>
			</div>

			<input name="id_inscricao" id="id_inscricao" type="hidden" value="<?php echo (isset($registro) ? $registro->id_inscricao : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>