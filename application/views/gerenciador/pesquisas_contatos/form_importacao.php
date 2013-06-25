<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo">Importar Base de Dados</h3>

	<?php echo form_open_multipart($controller.'/salvar_importacao', array("id" => "form"));?>

	  	<fieldset>

	  		<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

			<div class="input text obrigatorio">
	 			<label for="arquivo">Arquivo de Dados </label>
	 			<input id="arquivo" type="file" name="arquivo" size="47">
			</div>

			<input name="pesquisas_id_pesquisas" id="pesquisas_id_pesquisas" type="hidden" value="<?php echo $pesquisas_id_pesquisas; ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>