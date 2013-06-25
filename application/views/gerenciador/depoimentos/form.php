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
	 			<label for="tipo">Tipo</label>
	 			<?php echo form_dropdown("tipo", $tipos, set_value("tipo", (isset($registro) ? $registro->tipo : "")), "class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="nome">Nome</label>
	 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="empresa">Empresa</label>
	 			<input name="empresa" id="empresa" type="text" value="<?php echo (isset($registro) ? $registro->empresa : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="depoimento">Depoimento</label>
				<textarea name="depoimento" id="depoimento" class="required"><?php echo (isset($registro) ? $registro->depoimento : ''); ?></textarea>
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>