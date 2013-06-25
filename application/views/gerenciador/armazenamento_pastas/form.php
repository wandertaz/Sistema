<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar/', array("id" => "form"));?>

	  	<fieldset>

	  		<div class="input text">
	 			<label for="inscritos_id">Dono Pasta<br /><i>Escolha o usuário que tem permissão de acesso a pasta.</i></label>
	 			<?php echo form_dropdown("inscritos_id", $categorias, set_value("inscritos_id", (isset($registro) ? $registro->inscritos_id : "")), "class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="nome_pasta">Nome Pasta</label>
	 			<input name="nome" id="nome_categoria" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<input name="id_pasta" id="id_downloads_categorias" type="hidden" value="<?php echo (isset($registro) ? $registro->id_pasta : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>