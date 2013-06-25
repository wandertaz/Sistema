<div id="tabela">

	<div id="cima">
            
            <style>
             input[type="text"],select.busca-input-2  {                 
                   width:14%; 
                   margin:10px 0px 0px 10px;                     
                   display: inline-block;
                   float: none !important;
                    
                }
                
                .busca2{
                    width:100%;
                    text-align: left;             
              
                    
                }
                
            </style>
            

            <div class="busca2" >
                <span class="buscar-span" >Relatório</span>	
		<?php echo form_open($controller.'/buscar_proposta', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			
				
                               <div class="input text obrigatorio">
                                    <label for="tipo">Tipo:</label>
                                    <?php echo form_dropdown("tipo", $tipo,( ! isset($_GET['tipo'])) ? '' : $_GET['tipo'], "id=\"tipo\"  "); ?>
                               </div>
                                <div class="input text obrigatorio">
                                    <label for="classificacao">Classificação:</label>
                                    <?php echo form_dropdown("classificacao", $classificacao,( ! isset($_GET['classificacao'])) ? '' : $_GET['classificacao'], "id=\"classificacao\" "); ?>
                                </div>
                
                                <div class="input text obrigatorio">
                                    <label for="data_solicitacao_de" style="width:100%;">Data de solicitação: de</label>
                                    <?php echo form_input(array('name'=>'data_solicitacao_de','id'=>'data_solicitacao_de','value'=>( ! isset($_GET['data_solicitacao_de'])) ? '' : $_GET['data_solicitacao_de'],'class'=>'busca-input-2 datepicker2','maxlength'=>'10')) ;?> 
                                    até 
                                    <?php echo form_input(array('name'=>'data_solicitacao_ate','id'=>'data_solicitacao_ate','value'=>( ! isset($_GET['data_solicitacao_ate'])) ? '' : $_GET['data_solicitacao_ate'],'class'=>'busca-input-2 datepicker2','maxlength'=>'10')) ;?>
                                </div>
                
                                <div class="input text obrigatorio">
                                    <label for="data_apresentacao_de" style="width:100%;">Data da apresentação: de</label>
                                    <?php echo form_input(array('name'=>'data_apresentacao_de','id'=>'data_apresentacao_de','value'=>( ! isset($_GET['data_apresentacao_de'])) ? '' : $_GET['data_apresentacao_de'],'class'=>'busca-input-2 datepicker2','maxlength'=>'10')) ;?> 
                                    até 
                                    <?php echo form_input(array('name'=>'data_apresentacao_ate','id'=>'data_apresentacao_ate','value'=>( ! isset($_GET['data_apresentacao_ate'])) ? '' : $_GET['data_apresentacao_ate'],'class'=>'busca-input-2 datepicker2','maxlength'=>'10')) ;?>
                                </div>
                
                                <div class="input text obrigatorio">
                                    <label for="diaginostico">Responsável pelo diagnóstico: </label>
                                    <?php echo form_dropdown("diaginostico", $colaborador,( ! isset($_GET['diaginostico'])) ? '' : $_GET['diaginostico'], "id=\"diaginostico\" "); ?>
                                </div>
                                
                                <div class="input text obrigatorio">
                                    <label for="apresentacao">Responsável pela apresentação: </label>
                                    <?php echo form_dropdown("apresentacao", $colaborador,( ! isset($_GET['apresentacao'])) ? '' : $_GET['apresentacao'], "id=\"apresentacao\" "); ?>
                                </div>
                
                                <div class="input text obrigatorio">
                                    <label for="valor_inicial_de" style="width:100%">Valor Inicial: de</label>
                                    <?php echo form_input(array('name'=>'valor_inicial_de','id'=>'valor_inicial_de','value'=>( ! isset($_GET['valor_inicial_de'])) ? '' : $_GET['valor_inicial_de'],'maxlength'=>'25','onkeypress'=>"return formataMoeda(this, '.', ',', event);")) ;?> 
                                    até 
                                    <?php echo form_input(array('name'=>'valor_inicial_ate','id'=>'valor_inicial_ate','value'=>( ! isset($_GET['valor_inicial_ate'])) ? '' : $_GET['valor_inicial_ate'],'maxlength'=>'25','onkeypress'=>"return formataMoeda(this, '.', ',', event);")) ;?>
                                </div>
                                
                                <div class="input text obrigatorio">
                                    <label for="valor_fechado_de" style="width:100%;">Valor Fechado: de</label>
                                    <?php echo form_input(array('name'=>'valor_fechado_de','id'=>'valor_fechado_de','value'=>( ! isset($_GET['valor_fechado_de'])) ? '' : $_GET['valor_fechado_de'],'maxlength'=>'25','onkeypress'=>"return formataMoeda(this, '.', ',', event);")) ;?> 
                                    até 
                                    <?php echo form_input(array('name'=>'valor_fechado_ate','id'=>'valor_fechado_ate','value'=>( ! isset($_GET['valor_fechado_ate'])) ? '' : $_GET['valor_fechado_ate'],'maxlength'=>'25','onkeypress'=>"return formataMoeda(this, '.', ',', event);")) ;?>
                                </div>
                
                                <div class="input text obrigatorio">
                                    <label for="status">Status:</label>
                                    <?php echo form_dropdown("status", $status,( ! isset($_GET['status'])) ? '' : $_GET['status'], "id=\"status\" "); ?>
                                </div>
                
                                <div class="submit">
                                    <input type="submit" value="Gerar" class="btn-busca" />
                                </div>
                                <?php if(count($registros)): ?>
                                    <input type="button" value="Gerar PDF" class="btn-busca" onclick="javascript: $('#gerarpdf').submit()" />
                                <?php endif; ?>
			
		<?php echo form_close();?>

	</div>

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>
        
	<?php if(count($registros)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Numero Proposta</th>
                        <th>Empresa</th>
                        <th>Nome Proposta</th>
			<th>Tipo</th>
			<th>Classificação</th>
                        <th>Data da Solicitação</th>
                        <th>Data da Apresentação</th>
                        <th>Responsável pelo Diagnóstico</th>
                        <th>Responsável pela Apresentação</th>
			<th>Status</th>
			<th>Valor Inicial</th>
			<th>Valor Fechado</th>
		</tr>
                <?php 
                
                $classificacao[''] =  '';
                $status[''] =  '';
                $tipo[''] =  '';
                $colaborador_mb[''] =  '';
                
                ?>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->id;?></td>
                                <td><?php echo $row->razao_social;?></td>
                                <td><?php echo $row->nome;?></td>
                                <td><?php echo isset($tipo[$row->tipo]) ? $tipo[$row->tipo] : '';?></td>
				<td><?php echo isset($classificacao[$row->classificacao]) ? $classificacao[$row->classificacao] : '';?></td>
				<td><?php echo br_date($row->data_solicitacao);?></td>
                                <td><?php echo (($row->data_apresentacao!= '0000-00-00') ? br_date($row->data_apresentacao) : '') ;?></td>
                                <td><?php echo isset($colaborador[$row->id_usuario_responsavel_diagnostico]) ? $colaborador[$row->id_usuario_responsavel_diagnostico] : '';?></td>
                                <td><?php echo isset($colaborador[$row->id_usuario_responsavel_apresentacao]) ? $colaborador[$row->id_usuario_responsavel_apresentacao] : '';?></td>
				<td><?php echo isset($status[$row->status]) ? $status[$row->status] : '';?></td>
                                <td><?php echo (isset($row->valor_inicial) ? (($row->valor_inicial>0) ? 'R$ '.number_format($row->valor_inicial, 2, ',', '.') : '') : '');?></td>
                                <td><?php echo (isset($row->valor_fechado) ? (($row->valor_fechado>0) ? 'R$ '.number_format($row->valor_fechado, 2, ',', '.') : '') : '');?></td>
			</tr>
                        
		<?php endforeach;?>
	</table>
        
        <?php echo form_open($controller.'/buscar_proposta', array('id' => 'gerarpdf', 'target'=>'blank', 'method' => 'get'));?>
			
				
                               
        <?php echo form_input(array('type'=>'hidden','name'=>'pdf','id'=>'pdf','value'=>'true'));?>
        <?php echo form_input(array('type'=>'hidden','name'=>'tipo','id'=>'tipo','value'=>( ! isset($_GET['tipo'])) ? '' : $_GET['tipo'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'classificacao','id'=>'classificacao','value'=>( ! isset($_GET['classificacao'])) ? '' : $_GET['classificacao'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'data_solicitacao_de','id'=>'data_solicitacao_de','value'=>( ! isset($_GET['data_solicitacao_de'])) ? '' : $_GET['data_solicitacao_de'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'data_solicitacao_ate','id'=>'data_solicitacao_ate','value'=>( ! isset($_GET['data_solicitacao_ate'])) ? '' : $_GET['data_solicitacao_ate'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'data_apresentacao_de','id'=>'data_apresentacao_de','value'=>( ! isset($_GET['data_apresentacao_de'])) ? '' : $_GET['data_apresentacao_de'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'data_apresentacao_ate','id'=>'data_apresentacao_ate','value'=>( ! isset($_GET['data_apresentacao_ate'])) ? '' : $_GET['data_apresentacao_ate'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'diaginostico','id'=>'diaginostico','value'=>( ! isset($_GET['diaginostico'])) ? '' : $_GET['diaginostico'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'apresentacao','id'=>'apresentacao','value'=>( ! isset($_GET['apresentacao'])) ? '' : $_GET['apresentacao'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'valor_inicial_de','id'=>'valor_inicial_de','value'=>( ! isset($_GET['valor_inicial_de'])) ? '' : $_GET['valor_inicial_de'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'valor_inicial_ate','id'=>'valor_inicial_ate','value'=>( ! isset($_GET['valor_inicial_ate'])) ? '' : $_GET['valor_inicial_ate'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'valor_fechado_de','id'=>'valor_fechado_de','value'=>( ! isset($_GET['valor_fechado_de'])) ? '' : $_GET['valor_fechado_de'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'valor_fechado_ate','id'=>'valor_fechado_ate','value'=>( ! isset($_GET['valor_fechado_ate'])) ? '' : $_GET['valor_fechado_ate'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'status','id'=>'status','value'=>( ! isset($_GET['status'])) ? '' : $_GET['status'])) ;?>
  
        <input type="submit" value="Gerar PDF" class="btn-busca" />
	
	<?php echo form_close();?>

	<?php endif; ?>

</div><!--/tabela -->