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
	 			<label for="autodiagnosticos_grupos_perguntas_id_grupo_pergunta">Grupo de Perguntas</label>
	 			<?php echo form_dropdown("autodiagnosticos_grupos_perguntas_id_grupo_pergunta", $grupos, set_value("autodiagnosticos_grupos_perguntas_id_grupo_pergunta", (isset($registro) ? $registro->autodiagnosticos_grupos_perguntas_id_grupo_pergunta : "")), "class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="pergunta">Pergunta</label>
	 			<input name="pergunta" id="pergunta" type="text" value="<?php echo (isset($registro) ? $registro->pergunta : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="nota">Observação/Nota</label>
	 			<input name="nota" id="nota" type="text" value="<?php echo (isset($registro) ? $registro->nota : ''); ?>"  />
			</div>

			<div class="input text obrigatorio">
	 			<label for="peso1">Pontuação da Opção 1</label>
	 			<input name="peso1" id="peso1" type="text" value="<?php echo (isset($registro) ? $registro->peso1 : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="peso2">Pontuação da Opção 2</label>
	 			<input name="peso2" id="peso2" type="text" value="<?php echo (isset($registro) ? $registro->peso2 : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="peso3">Pontuação da Opção 3</label>
	 			<input name="peso3" id="peso3" type="text" value="<?php echo (isset($registro) ? $registro->peso3 : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="peso4">Pontuação da Opção 4</label>
	 			<input name="peso4" id="peso4" type="text" value="<?php echo (isset($registro) ? $registro->peso4 : ''); ?>" class="required" />
			</div>

			<input name="id_pergunta" id="id_pergunta" type="hidden" value="<?php echo (isset($registro) ? $registro->id_pergunta : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>