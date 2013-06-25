<div id="tabela">

	<h3 class="inserir-noticia-titulo">Chat</h3>

	<?php echo form_open_multipart('multitools/login/chat_entrar', array("id" => "form"));?>

	  	<fieldset>

			<div class="input text">
	 			<label for="curso_id">Curso</label>
	 			<?php echo form_dropdown("curso_id", $cursos, set_value("curso_id", ""), "id=\"curso_id\" class=\"required\" "); ?>
			</div>

			<input name="instrutor_id" id="instrutor_id" type="hidden" value="<?php echo $this->session->userdata('id'); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>