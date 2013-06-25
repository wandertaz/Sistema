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
	 			<span> (73x83)</span>
			</div>

			<?php if(isset($registro->imagem) && $registro->imagem): ?>
				<div class="input text obrigatorio">
					<label for="imagem">Imagem Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $registro->imagem; ?>" target="_blank">Ver Imagem</a>
				</div>
			<?php endif; ?>

			<div class="input text obrigatorio">
	 			<label for="data">Data</label>
	 			<input name="data" id="data" type="text" value="<?php echo (isset($registro) ? br_date($registro->data) : ''); ?>" class="required datepicker" readonly="readonly" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="texto">Texto</label><br />
				<textarea  rows="15" cols="80" name="texto" class="editor"><?php echo (isset($registro) ? $registro->texto : ''); ?></textarea>
			</div>
<!--
			<div class="input text obrigatorio">
	 			<label for="arquivo">Arquivo </label>
	 			<input id="arquivo" type="file" name="arquivo" size="47">
			</div>

			<?php if(isset($registro->arquivo) && $registro->arquivo): ?>
				<div class="input text obrigatorio">
					<label for="arquivo">Arquivo Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $registro->arquivo; ?>" target="_blank">Ver Vídeo</a>
				</div>
			<?php endif; ?>
-->

			<div class="input text obrigatorio">
	 			<label for="link">Link do Áudio (Sound Cloud)</label>
	 			<input name="link" id="link" type="text" value="<?php echo (isset($registro) ? $registro->link : ''); ?>" class="required" />
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>