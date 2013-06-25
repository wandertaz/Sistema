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
	 			<label for="interessado_respondido">Marcar Como respondido</label>
	 			<?php echo form_dropdown("interessado_respondido", array('S' => 'Sim', 'N' => 'Não'), set_value("interessado_respondido", (isset($registro) ? $registro->interessado_respondido : "")), "class=\"required\""); ?>
			</div>

			<input name="avise_me_id" id="avise_me_id" type="hidden" value="<?php echo (isset($registro) ? $registro->avise_me_id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>