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
	 			<label for="inscritos_id">Empresa</label>
	 			<?php echo form_dropdown("inscritos_id", $inscritos, set_value("inscritos_id", (isset($registro) ? $registro->inscritos_id : "")), "class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="titulo">Titulo</label>
	 			<input name="titulo" id="titulo" type="text" value="<?php echo (isset($registro) ? $registro->titulo : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="descricao">Descrição</label><br />
				<textarea name="descricao" id="descricao" ><?php echo (isset($registro) ? $registro->descricao : ''); ?></textarea>
			</div>

			<div class="input text">
	 			<label for="status">Status</label>
	 			<?php echo form_dropdown("status", array('A' => 'Em Andamento', 'C' => 'Concluído'), set_value("status", (isset($registro) ? $registro->status : "")), "class=\"required\""); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="arquivo">Arquivo do Resultado (PDF) </label>
	 			<input id="arquivo" type="file" name="arquivo" size="47">
			</div>

			<?php if(isset($registro->arquivo) && $registro->arquivo): ?>
				<div class="input text obrigatorio">
					<label for="arquivo">Arquivo Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $registro->arquivo; ?>" target="_blank">Ver Arquivo</a>
				</div>
			<?php endif; ?>

			<input name="id_processo" id="id_processo" type="hidden" value="<?php echo (isset($registro) ? $registro->id_processo : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>