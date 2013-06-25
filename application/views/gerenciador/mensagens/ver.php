<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>
<style>

.field {
padding: 10px 8px 8px;
margin-bottom: 5px;
}

</style>
<div id="tabela">

		<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3><br />

	  	<fieldset class="field">
 			<p><strong>Curso:</strong> <?php echo $curso->titulo; ?><br />
 			<strong>De:</strong> <?php echo ($registro->tipo_remetente == 'A' ? $registro->inscrito : $registro->instrutor); ?><br />
 			<strong>Assunto:</strong> <?php echo $registro->assunto; ?><br />
 			<strong>Data:</strong> <?php echo br_date($registro->created); ?><br />
 			<strong>Texto:</strong> <?php echo (isset($registro) ? $registro->texto : ''); ?></p>
		</fieldset>

		<?php if($respostas): ?>
			<?php foreach($respostas as $resposta): ?>
				<fieldset class="field">
		 			<p><strong>De:</strong> <?php echo ($resposta->inscrito ? $resposta->inscrito : $resposta->instrutor); ?><br />
		 			<strong>Data:</strong> <?php echo br_date($resposta->created); ?><br />
		 			<strong>Texto:</strong> <?php echo $resposta->texto; ?></p>
				</fieldset>
			<?php endforeach; ?>
		<?php endif; ?>

	<?php echo form_open_multipart($controller.'/responder', array("id" => "form"));?>

		<fieldset class="field">

			<input type="hidden" name="id_mensagem" id="id_mensagem" value="<?php echo $registro->id;  ?>" />
 			<input type="hidden" name="remetente_id" value="<?php echo $this->session->userdata('id'); ?>">
 			<input type="hidden" name="tipo_remetente" value="I">
 			<input type="hidden" name="tipo_curso" id="tipo_curso" value="<?php echo $tipo;  ?>" />

			<div class="input text obrigatorio">
	 			<label for="texto">Responder:</label><br />
				<textarea name="texto" id="texto" class="required"></textarea>
			</div>

			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>