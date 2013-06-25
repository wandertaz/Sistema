<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>
<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> Empresa</h3>

	<?php echo form_open_multipart($controller.'/gerar_relatorio', array("id" => "form"));?>

	  	<fieldset>

                    

                    <!--
                        <div class="input text">
	 			<label for="ativo">Tipo Relatório</label>
	 			<?php echo form_dropdown("tipo", array(''=>'Selecione','1' => 'Taxa de Conversão', '2' => 'Pontualidade de Propostas','3'=>'Prazo médio de proposta','4'=>'Indicações'),'', "id=\"tipo\" class=\"required\" "); ?>
			</div> 
                    -->
                        <div class="input text">
	 			<label for="status">Status</label>
	 			<?php echo form_dropdown("status", array(''=>'Selecione','A' => 'Aberto', 'N' => 'Negativado','F'=>'Fechado'),'', "id=\"status\" "); ?>
			</div> 
                    
                        <div class="input text">
	 			<label for="classificacao">Classificação</label>
	 			<?php echo form_dropdown("classificacao", array(''=>'Selecione','A' => 'A', 'B' => 'B','C'=>'C'), "id=\"classificacao\" "); ?>
			</div> 


			<div class="input text obrigatorio">
	 			<label for="data_inicio">Data Programada inicio</label>
	 			<input name="data_inicio" id="data_inicio" type="text"  onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>
                    
                        <div class="input text obrigatorio">
	 			<label for="data_fim">Data Programada Fim</label>
	 			<input name="data_fim" id="data_fim" type="text"  onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>
                    
                        <div class="input text obrigatorio">
	 			<label for="responsavel">Responsável</label>
	 			<?php echo form_dropdown("responsavel", array(''=>'Selecione','10' => 'jose', '0' => 'maria'), "id=\"responsavel\" class=\"required\" "); ?>
			</div>
                    
                    
                    



			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>