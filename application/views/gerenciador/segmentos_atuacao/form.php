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
	 			<label for="segmentodeatuacao_nome">Nome</label>
	 			<input name="segmentodeatuacao_nome" id="segmentodeatuacao_nome" type="text" value="<?php echo (isset($registro) ? $registro->segmentodeatuacao_nome : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="ordem">Ordem</label>
	 			<input name="ordem" id="ordem" type="text" value="<?php echo (isset($registro) ? $registro->ordem : ''); ?>" class="required" />
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<input name="segmentodeatuacao_id" id="segmentodeatuacao_id" type="hidden" value="<?php echo (isset($registro) ? $registro->segmentodeatuacao_id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>