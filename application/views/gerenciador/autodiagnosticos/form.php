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
	 			<label for="tipos_autodiagnosticos_id_tipo_autodiagnostico">Área</label>
	 			<?php echo form_dropdown("tipos_autodiagnosticos_id_tipo_autodiagnostico", $tipos, set_value("tipos_autodiagnosticos_id_tipo_autodiagnostico", (isset($registro) ? $registro->tipos_autodiagnosticos_id_tipo_autodiagnostico : "")), "class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="nome">Nome</label>
	 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="breve_descricao">Breve Descrição</label>
				<textarea name="breve_descricao" id="breve_descricao" class="required"><?php echo (isset($registro) ? $registro->breve_descricao : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="texto">Texto</label><br />
				<textarea name="texto" id="texto" ><?php echo (isset($registro) ? $registro->texto : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="preco">Preço</label>
	 			<input name="preco" id="preco" type="text" class="required" value="<?php echo (isset($registro) ? number_format($registro->preco, 2, ',', '.') : ''); ?>"  maxlength="9" onkeypress="return formataMoeda(this, '.', ',', event);" />
			</div>

			<input name="id_autodiagnostico" id="id_autodiagnostico" type="hidden" value="<?php echo (isset($registro) ? $registro->id_autodiagnostico : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>