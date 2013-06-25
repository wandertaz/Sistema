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
	 			<label for="exercicio_id">Exerc&iacute;cio</label>
	 			<?php echo form_dropdown("exercicio_id", $exercicios, set_value("exercicio_id", (isset($registro) ? $registro->exercicio_id : "")), "id=\"exercicio_id\" class=\"required\""); ?>
			</div>


	 		<div class="input text obrigatorio">
	 			<label for="pergunta">Pergunta</label>
	 			<input name="pergunta" id="pergunta" type="text" value="<?php echo (isset($registro) ? $registro->pergunta : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="ordem">Ordem</label>
	 			<input name="ordem" id="ordem" type="text" value="<?php echo (isset($registro) ? $registro->ordem : ''); ?>" class="required" />
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