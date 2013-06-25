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
	 			<label for="pesquisas_perguntas_id_pesquisas_perguntas">Pergunta</label>
	 			<?php echo form_dropdown("pesquisas_perguntas_id_pesquisas_perguntas", $perguntas, set_value("pesquisas_perguntas_id_pesquisas_perguntas", (isset($registro) ? $registro->pesquisas_perguntas_id_pesquisas_perguntas : ""))); ?>
			</div>

			<div class="input text">
	 			<label for="tipo">Tipo</label>
	 			<?php echo form_dropdown("tipo", array('F' => 'Fechada', 'A' => 'Aberta'), set_value("tipo", (isset($registro) ? $registro->tipo : "")), "class=\"required\""); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="ordem">Ordem</label>
	 			<input name="ordem" id="ordem" type="text" value="<?php echo (isset($registro) ? $registro->ordem : ''); ?>" class="required" onkeypress="return apenasNumeros(event);" />
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="opcao">Opção</label>
	 			<input name="opcao" id="opcao" type="text" value="<?php echo (isset($registro) ? $registro->opcao : ''); ?>" class="required" />
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<input name="id_pesquisas_perguntas_opcoes" id="id_pesquisas_perguntas_opcoes" type="hidden" value="<?php echo (isset($registro) ? $registro->id_pesquisas_perguntas_opcoes : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>