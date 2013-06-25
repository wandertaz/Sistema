<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> Proposta</h3>

	<?php echo form_open_multipart($controller.'/salvar_proposta', array("id" => "form"));?>

	  	<fieldset>	  		
                    <!--empresa--><input name="inscritos_id" id="inscritos_id" type="hidden" value="<?php echo (isset($id_empresa) ? $id_empresa :''); ?>" />
                    <?php if (isset($registro)): ?><!--id projeto--><input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" /><?php endif; ?>
			
                    
	 		<div class="input text obrigatorio">
	 			<label for="n_proposta">Nº da Proposta</label>
	 			<input name="n_proposta" id="n_proposta" type="text" value="<?php echo (isset($registro) ? $registro->n_proposta : ''); ?>" class="required" />
			</div>   

			<div class="input text obrigatorio">
	 			<label for="nome">Nome</label>
	 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>
                    
                    	<div class="input text obrigatorio">
	 			<label for="tipo">Tipo</label>
	 			<?php  echo form_dropdown("tipo", array('GP' => 'Gestão de Pessoas', 'GC' => 'Governança Corporativa', 'PR' => 'Processos', 'ES' => 'Estratégia', 'EC' => 'Educação Corporativa'), set_value("tipo", (isset($registro) ? $registro->tipo : "")), "id=\"tipo\" class=\"required\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="classificacao">Classificação</label>
	 			<?php  echo form_dropdown("classificacao", array('D' => 'Diamante', 'O' => 'Ouro', 'P' => 'Prata', 'B' => 'Bronze'), set_value("classificacao", (isset($registro) ? $registro->classificacao : "")), "id=\"classificacao\" class=\"required\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_solicitacao">Data da Solicitação</label>
	 			<input name="data_solicitacao" id="data_solicitacao" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_solicitacao) : ''); ?>" class="required datepicker2" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_programada_apresentacao">Data Programada da Apresentação</label>
	 			<input name="data_programada_apresentacao" id="data_programada_apresentacao" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_programada_apresentacao) : ''); ?>" class="required datepicker2" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>

			<div class="input text">
	 			<label for="data_apresentacao">Data da Apresentação</label>
	 			<input name="data_apresentacao" id="data_apresentacao" type="text" value="<?php echo (isset($registro) ? ($registro->data_apresentacao != '0000-00-00' ? br_date($registro->data_apresentacao) : '' ): ''); ?>" class="datepicker2" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>
                    
			<div class="input text obrigatorio">
	 			<label for="id_usuario_responsavel_diagnostico">Responsável pelo Diagnóstico</label>
	 			<?php  echo form_dropdown("id_usuario_responsavel_diagnostico", $usuarios, set_value("id_usuario_responsavel_diagnostico", (isset($registro) ? $registro->id_usuario_responsavel_diagnostico : "")), "id=\"id_usuario_responsavel_diagnostico\" class=\"required\" "); ?>
			</div>
                    
			<div class="input text obrigatorio">
	 			<label for="id_usuario_responsavel_elaboracao">Responsável pela Elaboração</label>
	 			<?php  echo form_dropdown("id_usuario_responsavel_elaboracao", $usuarios, set_value("id_usuario_responsavel_elaboracao", (isset($registro) ? $registro->id_usuario_responsavel_elaboracao : "")), "id=\"id_usuario_responsavel_elaboracao\" class=\"required\" "); ?>
			</div>
                    
			<div class="input text obrigatorio">
	 			<label for="id_usuario_responsavel_apresentacao">Responsável pela Apresentação</label>
	 			<?php  echo form_dropdown("id_usuario_responsavel_apresentacao", $usuarios, set_value("id_usuario_responsavel_apresentacao", (isset($registro) ? $registro->id_usuario_responsavel_apresentacao : "")), "id=\"id_usuario_responsavel_apresentacao\" class=\"required\" "); ?>
			</div>
                    
                        <div class="input text obrigatorio">
	 			<label for="arquivo_proposta">Arquivo da proposta</label>
	 			<input id="arquivo_proposta" type="file" name="arquivo_proposta" size="47">
			</div>

			<?php if(isset($registro->arquivo_proposta) && $registro->arquivo_proposta): ?>
				<div class="input text obrigatorio">
					<label for="arquivo_proposta">Arquivo:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/proposta/<?php echo $registro->arquivo_proposta; ?>" target="_blank">Ver Arquivo</a>
				</div>
			<?php endif; ?>
                    
			<div class="input text obrigatorio">
                            <label for="valor_inicial">Valor Inicial</label>
	 			<input name="valor_inicial" id="valor_inicial" type="text" value="<?php echo (isset($registro) ? number_format($registro->valor_inicial, 2, ',', '.') : ''); ?>" class="required"  maxlength="30" onkeypress="return formataMoeda(this, '.', ',', event);" />
			</div>
                    
			<div class="input text">
	 			<label for="valor_fechado">Valor Fechado</label>
	 			<input name="valor_fechado" id="valor_fechado" type="text" value="<?php echo (isset($registro) ? number_format($registro->valor_fechado, 2, ',', '.') : ''); ?>" class=""  maxlength="30" onkeypress="return formataMoeda(this, '.', ',', event);" />
			</div>
                    
			<div class="input text obrigatorio">
	 			<label for="origem_contato">Origem do Contato</label>
	 			<input name="origem_contato" id="origem_contato" type="text" value="<?php echo (isset($registro) ? $registro->origem_contato : ''); ?>" class="" />
			</div>
                    
			<div class="input text">
	 			<label for="sexo">Status</label>
	 			<?php  echo form_dropdown("status", array('EM' => 'Em aberto', 'NA' => 'Não apresentada', 'NE' => 'Negativada', 'FE' => 'Fechada'), set_value("status", (isset($registro) ? $registro->status : "")), "id=\"status\" class=\"required\" "); ?>
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
	 			<?php echo (br_date($row->data_status)); ?> - <?php echo ($row->status == 'EM' ? 'Em aberto' : ($row->status == 'NA' ? 'Não apresentada':($row->status == 'NE' ? 'Negativada':'Fechada')));?><br/>
                                <?php endforeach;?>
			</div>
                        <?php endif; ?>
                    
                        <?php endif; ?>
                    
			<div class="input text obrigatorio">
	 			<label for="indicacao_mb">Foi indicado por quem?</label>
	 			<input name="indicacao_mb" id="indicacao_mb" type="text" value="<?php echo (isset($registro) ? $registro->indicacao_mb : ''); ?>" class="" />
			</div>
                    
                        <div class="input text">
	 			<label for="observacoes_gerais">Observações Gerais</label>
	 			<textarea name="observacoes_gerais" id="observacoes_gerais" class=""><?php echo (isset($registro) ? $registro->observacoes_gerais : ''); ?></textarea>
			</div>

		
			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>