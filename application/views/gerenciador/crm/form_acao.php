<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> Ação de Prospecção</h3>

	<?php echo form_open_multipart($controller.'/salvar_acao', array("id" => "form"));?>

	  	<fieldset>	  		
                    <!--empresa--><input name="inscritos_id" id="inscritos_id" type="hidden" value="<?php echo (isset($registro) ? $registro->inscritos_id : $inscritos_id); ?>" />
                    <?php if (isset($registro)): ?><!--id projeto--><input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" /><?php endif; ?>
			
                    
	 		<div class="input text obrigatorio">
	 			<label for="descricao_acao">Descrição</label>
	 			<input name="descricao_acao" id="descricao_acao" type="text" value="<?php echo (isset($registro) ? $registro->descricao_acao : ''); ?>" class="required" />
			</div>
                    
			<div class="input text obrigatorio">
	 			<label for="data">Data</label>
	 			<input name="data" id="data" type="text" value="<?php echo (isset($registro) ? br_date($registro->data) : ''); ?>" class="required datepicker2" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>
                    
			<div class="input text obrigatorio">
	 			<label for="id_usuario_responsavel_mb">Responsável pelo Folowup (MB)</label>
	 			<?php  echo form_dropdown("id_usuario_responsavel_mb", $usuarios, set_value("id_usuario_responsavel_mb", (isset($registro) ? $registro->id_usuario_responsavel_mb : "")), "id=\"id_usuario_responsavel_mb\" class=\"required\" "); ?>
			</div>
                    

			<div class="input text">
	 			<label for="status">Status</label>
	 			<?php  echo form_dropdown("status", array('CO' => 'Concluído', 'AN' => 'Andamento', 'CA' => 'Cancelado', 'PA' => 'Paralisado', 'PR' => 'Programado'), set_value("status", (isset($registro) ? $registro->status : "")), "id=\"status\" class=\"required\" "); ?>
			</div>
 
                    

			<div class="input text">
	 			<label for="prioridade">Prioridade</label>
	 			<?php  echo form_dropdown("prioridade", array('1' => '1', '2' => '2', '3' => '3'), set_value("prioridade", (isset($registro) ? $registro->prioridade : "")), "id=\"prioridade\" class=\"required\" "); ?>
			</div>
 
                    

			<div class="input text">
	 			<label for="tipo">Tipo</label>
	 			<?php  echo form_dropdown("tipo", array('R' => 'Reativa', 'P' => 'Proativa'), set_value("tipo", (isset($registro) ? $registro->tipo : "")), "id=\"tipo\" class=\"required\" "); ?>
			</div>

		
			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>