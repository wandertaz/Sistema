<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

			<input type="hidden" name="tipo_curso" id="tipo_curso" value="<?php echo $tipo;  ?>" />

			<div class="input text">
	 			<label for="curso_id">Curso</label>
	 			<?php echo form_dropdown("curso_id", $cursos, set_value("curso_id", (isset($registro) ? $registro->curso_id : "")), "id=\"curso_id\" class=\"required\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="titulo">T&iacute;tulo</label>
	 			<input name="titulo" id="titulo" type="text" value="<?php echo (isset($registro) ? $registro->titulo : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="numero">N&uacute;mero da Aula</label>
	 			<input name="numero" id="numero" type="text" value="<?php echo (isset($registro) ? $registro->numero : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="codigo_video">C&oacute;digo do V&iacute;deo (Youtube)</label>
	 			<input name="codigo_video" id="codigo_video" type="text" value="<?php echo (isset($registro) ? $registro->codigo_video : ''); ?>" class="" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="arquivo_artigo">Arquivo de Artigo </label>
	 			<input id="arquivo_artigo" type="file" name="arquivo_artigo" size="47">
			</div>

			<?php if(isset($registro->arquivo_artigo)): ?>
				<div class="input text obrigatorio">
					<label for="arquivo_artigo">Arquivo Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $registro->arquivo_artigo; ?>" target="_blank">Ver Artigo</a>
				</div>
			<?php endif; ?>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>