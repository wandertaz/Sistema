<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

	  		<?php if($destinatarios): ?>

			<input type="hidden" name="tipo_curso" id="tipo_curso" value="<?php echo $tipo;  ?>" />
	 		<input type="hidden" name="curso_id" id="curso_id" value="<?php echo $curso_id;  ?>" />
	 		<input type="hidden" name="remetente_id" id="remetente_id" value="<?php echo $this->session->userdata('id');  ?>" />
	 		<input type="hidden" name="tipo_remetente" id="tipo_remetente" value="I" />

			<div class="input text">
	 			<label for="destinatario_id">Destinat&aacute;rios:</label>
 				<?php foreach($destinatarios as $id => $destinatario): ?>
 					<input type="checkbox" name="destinatarios[]" value="<?php echo $id; ?>" style="width:30px;" /><label><?php echo $destinatario; ?></label>
 				<?php endforeach; ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="assunto">Assunto</label>
	 			<input name="assunto" id="assunto" type="text" value="<?php echo (isset($registro) ? $registro->assunto : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="texto">Texto</label><br />
				<textarea name="texto" id="texto" class="required"><?php echo (isset($registro) ? $registro->texto : ''); ?></textarea>
			</div>

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

			<?php else: ?>
				<p>N&atilde;o foi encontrado nenhum inscrito para este curso.</p>
				<br />
			<?php endif; ?>

		</fieldset>

	<?php echo form_close();?>

</div>