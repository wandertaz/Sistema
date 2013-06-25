<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

	 		<div class="input text obrigatorio">
	 			<label for="nome_tipo">Nome</label>
	 			<input name="nome_tipo" id="nome_tipo" type="text" value="<?php echo (isset($registro) ? $registro->nome_tipo : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="descricao">Descrição</label>
				<textarea name="descricao" id="descricao"><?php echo (isset($registro) ? $registro->descricao : ''); ?></textarea>
			</div>

			<!--<div class="input text obrigatorio">
	 			<label for="texto">Texto</label><br />
				<textarea name="texto" id="texto" ><?php echo (isset($registro) ? $registro->texto : ''); ?></textarea>
			</div>-->

			<input name="id_tipo_autodiagnostico" id="id_tipo_autodiagnostico" type="hidden" value="<?php echo (isset($registro) ? $registro->id_tipo_autodiagnostico : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>