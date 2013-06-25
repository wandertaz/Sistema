<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> Projeto</h3>

	<?php echo form_open_multipart($controller.'/salvar_projeto', array("id" => "form"));?>

	  	<fieldset>	  		
                    <!--empresa--><input name="inscritos_id" id="inscritos_id" type="hidden" value="<?php echo (isset($registro) ? $registro->inscritos_id : $inscritos_id); ?>" />
                    <?php if (isset($registro)): ?><!--id projeto--><input name="idprojeto_empresa" id="idprojeto_empresa" type="hidden" value="<?php echo (isset($registro) ? $registro->idprojeto_empresa : ''); ?>" /><?php endif; ?>
			
                    
	 		<div class="input text obrigatorio">
	 			<label for="nome">Nome</label>
	 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>
                    
                    	<div class="input text obrigatorio">
	 			<label for="n_proposta">Nº da Proposta</label>
	 			<input name="n_proposta" id="n_proposta" type="text" value="<?php echo (isset($registro) ? $registro->n_proposta : ''); ?>" class="required" />
			</div>   

			<div class="input text obrigatorio">
	 			<label for="tipo">Tipo</label>
	 			<?php  echo form_dropdown("tipo", array('GP' => 'Gestão de Pessoas', 'GC' => 'Governança Corporativa', 'PR' => 'Processos', 'ES' => 'Estratégia', 'EC' => 'Educação Corporativa'), set_value("tipo", (isset($registro) ? $registro->tipo : "")), "id=\"tipo\" class=\"required\" "); ?>
			</div>    

			<div class="input text obrigatorio">
	 			<label for="data_inicio">Data de Início</label>
	 			<input name="data_inicio" id="data_inicio" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_inicio) : ''); ?>" class="required datepicker2" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_termino">Data de Término</label>
	 			<input name="data_termino" id="data_termino" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_termino) : ''); ?>" class="required datepicker2" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>
                    

			<div class="input text obrigatorio">
	 			<label for="id_usuario_consultor_responsavel">Consultor Responsável</label>
	 			<?php  echo form_dropdown("id_usuario_consultor_responsavel", $usuarios, set_value("id_usuario_consultor_responsavel", (isset($registro) ? $registro->id_usuario_consultor_responsavel : "")), "id=\"id_usuario_consultor_responsavel\" class=\"required\" "); ?>
			</div>
                    

			<div class="input text">
	 			<label for="status">Status</label>
	 			<?php  echo form_dropdown("status", array('A' => 'Em andamento', 'P' => 'Paralisado', 'F' => 'Finalizado'), set_value("status", (isset($registro) ? $registro->status : "")), "id=\"status\" class=\"required\" "); ?>
			</div>
                    
                        <?php  if (isset($registro) ) : ?>

			<div class="input text">
	 			<label for="data_status">Data de Status</label>:&nbsp;
	 			<?php echo (isset($registro) ? br_date($registro->data_status) : ''); ?>
			</div>
                    
                        <?php if(count($logs)): ?>
                        <div class="input text">
	 			<label for="data_status">Log de Status</label><br/>
                                <?php foreach($logs as $row):?>
	 			<?php echo (br_date($row->data_status)); ?> - <?php echo ($row->status == 'A' ? 'Em andamento' : ($row->status == 'F' ? 'Finalizado':'Paralisado'));?><br/>
                                <?php endforeach;?>
			</div>
                        <?php endif; ?>
                    
                        <?php endif; ?>
                    
                        <div class="input text obrigatorio">
	 			<label for="observacoes_gerais">Observações Gerais</label>
	 			<textarea name="observacoes_gerais" id="observacoes_gerais" class=""><?php echo (isset($registro) ? $registro->observacoes_gerais : ''); ?></textarea>
			</div>

		
			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>