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
	 			<label for="curriculos_id_curriculo">Currículo</label>
	 			<?php echo form_dropdown("curriculos_id_curriculo", $curriculos, set_value("curriculos_id_curriculo", (isset($registro) ? $registro->curriculos_id_curriculo : "")), "id=\"curriculos_id_curriculo\" class=\"required\" "); ?>
			</div>

			<div class="input text">
	 			<label for="vaga_id_vaga">Vaga</label>
	 			<?php echo form_dropdown("vaga_id_vaga", $vagas, set_value("vaga_id_vaga", (isset($registro) ? $registro->vaga_id_vaga : "")), "id=\"vaga_id_vaga\" class=\"required\" "); ?>
			</div>

			<input name="id_candidatura" id="id_candidatura" type="hidden" value="<?php echo (isset($registro) ? $registro->id_candidatura : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>