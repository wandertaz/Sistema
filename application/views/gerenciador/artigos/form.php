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
	 			<label for="autor">Autor</label>
	 			<input name="autor" id="autor" type="text" value="<?php echo (isset($registro) ? $registro->autor : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_publicacao">Data de Publicação</label>
	 			<input name="data_publicacao" id="data_publicacao" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_publicacao) : ''); ?>" class="required datepicker" readonly="readonly" />
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
	 			<span> (85x125)</span>
			</div>

			<?php if(isset($registro->imagem) && $registro->imagem): ?>
				<div class="input text obrigatorio">
					<label for="imagem">Imagem Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $registro->imagem; ?>" target="_blank">Ver Imagem</a>
				</div>
			<?php endif; ?>

			<div class="input text obrigatorio">
	 			<label for="texto">Texto</label><br />
				<textarea  rows="15" cols="80" name="texto" class="editor"><?php echo (isset($registro) ? $registro->texto : ''); ?></textarea>
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>