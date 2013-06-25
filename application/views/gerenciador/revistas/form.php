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
	 			<label for="idioma_id">Idioma</label>
	 			<?php echo form_dropdown("idioma_id", $idiomas, set_value("idioma_id", (isset($registro) ? $registro->idioma_id : "")), "id=\"idioma_id\" class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="titulo">Título</label>
	 			<input name="titulo" id="titulo" type="text" value="<?php echo (isset($registro) ? $registro->titulo : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="descricao">Descrição</label>
				<textarea name="descricao" id="descricao" class="required"><?php echo (isset($registro) ? $registro->descricao : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="imagem">Imagem </label>
	 			<input id="imagem" type="file" name="imagem" size="47">
	 			<span> (180x258)</span>
			</div>

			<?php if(isset($registro->imagem) && $registro->imagem): ?>
				<div class="input text obrigatorio">
					<label for="imagem">Imagem Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $registro->imagem; ?>" target="_blank">Ver Imagem</a>
				</div>
			<?php endif; ?>

			<div class="input text obrigatorio">
	 			<label for="arquivo">Arquivo </label>
	 			<input id="arquivo" type="file" name="arquivo" size="47">
			</div>

			<?php if(isset($registro->arquivo) && $registro->arquivo): ?>
				<div class="input text obrigatorio">
					<label for="arquivo">Arquivo da Revista Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $registro->arquivo; ?>" target="_blank">Ver Revista</a>
				</div>
			<?php endif; ?>

			<div class="input text obrigatorio">
	 			<label for="link">Link (Revista virtual)</label>
	 			<input name="link" id="link" type="text" value="<?php echo (isset($registro) ? $registro->link : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data">Data</label>
	 			<input name="data" id="data" type="text" value="<?php echo (isset($registro) ? $registro->data : ''); ?>" class="required" />
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>