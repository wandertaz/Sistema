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
	 			<label for="texto">Texto</label><br />
				<textarea name="texto" id="texto" class="required"><?php echo (isset($registro) ? $registro->texto : ''); ?></textarea>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="pontuacao_minima">Pontuação Mínima</label>
	 			<input name="pontuacao_minima" id="pontuacao_minima" type="text" value="<?php echo (isset($registro) ? $registro->pontuacao_minima : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="pontuacao_maxima">Pontuação Máxima</label>
	 			<input name="pontuacao_maxima" id="pontuacao_maxima" type="text" value="<?php echo (isset($registro) ? $registro->pontuacao_maxima : ''); ?>" class="required" />
			</div>

			<input name="id_resultado" id="id_resultado" type="hidden" value="<?php echo (isset($registro) ? $registro->id_resultado : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>