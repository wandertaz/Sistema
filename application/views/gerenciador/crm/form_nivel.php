<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> Nível de Satisfação</h3>

	<?php echo form_open_multipart($controller.'/salvar_nivel', array("id" => "form"));?>

	  	<fieldset>	  		
                    <!--empresa--><input name="inscritos_id" id="inscritos_id" type="hidden" value="<?php echo (isset($registro) ? $registro->inscritos_id : $inscritos_id); ?>" />
                    <?php if (isset($registro)): ?><!--id projeto--><input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" /><?php endif; ?>
			 

			<div class="input text">
	 			<label for="tipo">Nível</label>
	 			<?php  echo form_dropdown("tipo", array('SA' => 'Satisfeito', 'IS' => 'Insatisfeito', 'NE' => 'Neutro', 'MA' => 'Não Manifestou'), set_value("tipo", (isset($registro) ? $registro->tipo : "")), "id=\"tipo\" class=\"required\" "); ?>
			</div>
                    
                        <div class="input text obrigatorio">
	 			<label for="pontos_atencao">Pontos de Atenção (Registro da Ocorrência)</label>
	 			<textarea name="pontos_atencao" id="pontos_atencao" class=""><?php echo (isset($registro) ? $registro->pontos_atencao : ''); ?></textarea>
			</div>
                    
                        <div class="input text obrigatorio">
	 			<label for="acao_tratada">Ação Tratada (o que foi feito para sanar/agradecer)</label>
	 			<textarea name="acao_tratada" id="acao_tratada" class=""><?php echo (isset($registro) ? $registro->acao_tratada : ''); ?></textarea>
			</div> 

			<div class="input text obrigatorio">
	 			<label for="data_acao">Data da Ação Tratada</label>
	 			<input name="data_acao" id="data_acao" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_acao) : ''); ?>" class="required datepicker2" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>

		
			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>