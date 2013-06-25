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
	 			<label for="curriculos_id_curriculo">Currículo</label>
	 			<?php echo form_dropdown("curriculos_id_curriculo", $curriculos, set_value("curriculos_id_curriculo", (isset($registro) ? $registro->curriculos_id_curriculo : "")), "class=\"required\""); ?>
			</div>

			<div class="input text">
	 			<label for="processo_selecao_id_processo">Processo</label>
	 			<?php echo form_dropdown("processo_selecao_id_processo", $processos, set_value("processo_selecao_id_processo", (isset($registro) ? $registro->processo_selecao_id_processo : "")), "class=\"required\""); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="arquivo_resultado">Arquivo do Resultado (PDF) </label>
	 			<input id="arquivo_resultado" type="file" name="arquivo_resultado" size="47">
			</div>

			<?php if(isset($registro->arquivo_resultado) && $registro->arquivo_resultado): ?>
				<div class="input text obrigatorio">
					<label for="arquivo_resultado">Arquivo Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $registro->arquivo_resultado; ?>" target="_blank">Ver Arquivo</a>
				</div>
			<?php endif; ?>

			<input name="processos_curriculos_id" id="processos_curriculos_id" type="hidden" value="<?php echo (isset($registro) ? $registro->processos_curriculos_id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>