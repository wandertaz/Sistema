<div id="tabela">

	<div id="cima">
            
            <style>
             input[type="text"],select.busca-input-2  {                 
                   width:50%; 
                   margin:10px 0px 0px 10px;                     
                  display: inline-block;
                   float: none !important;
                    
                }
                 .data_relatorio{ 
                     max-width:20%;
                }
                
                .busca2{
                    width:100%;
                    text-align: left;             
                    
                    
                }
                
            </style>
            

            <div class="busca2" >
                <span class="buscar-span" ><b>Relatório</b></span>	
		<?php echo form_open($controller.'/buscar_acao', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			
				
                               <div class="input text obrigatorio">
                                   <label for="data_de">Data: de</label><br>
                                    <?php echo form_input(array('name'=>'data_de','id'=>'data_de','value'=>( ! isset($_GET['data_de'])) ? '' : $_GET['data_de'],'class'=>'data_relatorio datepicker2','maxlength'=>'10')) ;?> 
                                    até 
                                    <?php echo form_input(array('name'=>'data_ate','id'=>'data_ate','value'=>( ! isset($_GET['data_ate'])) ? '' : $_GET['data_ate'],'class'=>'data_relatorio datepicker2')) ;?>                                
                               </div>
                                <div class="input text obrigatorio">
                                      <label for="responsavel">Responsável da MB:</label>
                                      <?php echo form_dropdown("responsavel", $colaborador,( ! isset($_GET['responsavel'])) ? '' : $_GET['responsavel'], "id='responsavel'  "); ?>
                                </div>
                                <div class="input text obrigatorio">
                                      <label for="status"> Status:</label>
                                       <?php echo form_dropdown("status", $status,( ! isset($_GET['status'])) ? '' : $_GET['status'], "id=\"status\"  "); ?>
                                </div>
                                <div class="input text obrigatorio">
                                      <label for="prioridade">Prioridade:</label>
                                        <?php echo form_dropdown("prioridade", $prioridade,( ! isset($_GET['prioridade'])) ? '' : $_GET['prioridade'], "id=\"prioridade\" "); ?>
                                </div>
                                <div class="input text obrigatorio">
                                      <label for="tipo">Tipo:</label>
                                      <?php echo form_dropdown("tipo", $tipo,( ! isset($_GET['tipo'])) ? '' : $_GET['tipo'], "id=\"tipo\"  "); ?>
                                </div>
                                <div class="submit"
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
			<th>Descrição</th>
                        <th>Data</th>
                        <th>Empresa</th>
			<th>Responsável MB</th>
			<th>Status</th>
			<th>Prioridade</th>
                        <th>Tipo</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->descricao_acao;?></td>
                                <td><?php echo br_date($row->data);?></td>
				<td><?php echo $row->razao_social;?></td>
                                <td><?php if ( isset($colaborador[$row->id_usuario_responsavel_mb])) echo $colaborador[$row->id_usuario_responsavel_mb];?></td>
				<td><?php echo isset($status[$row->status]) ? $status[$row->status] : '';?></td>
				<td><?php echo isset($prioridade[$row->prioridade]) ? $prioridade[$row->prioridade] : '';?></td>
                                <td><?php echo isset($tipo[$row->tipo]) ? $tipo[$row->tipo] : '';?></td>
			</tr>
		<?php endforeach;?>
	</table>
        
        <?php echo form_open($controller.'/buscar_acao', array('id' => 'gerarpdf', 'target'=>'blank', 'method' => 'get'));?>
			
				
                               
        <?php echo form_input(array('type'=>'hidden','name'=>'pdf','id'=>'pdf','value'=>'true'));?>
        <?php echo form_input(array('type'=>'hidden','name'=>'data_de','id'=>'data_de','value'=>( ! isset($_GET['data_de'])) ? '' : $_GET['data_de'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'data_ate','id'=>'data_ate','value'=>( ! isset($_GET['data_ate'])) ? '' : $_GET['data_ate'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'responsavel','id'=>'responsavel','value'=>( ! isset($_GET['responsavel'])) ? '' : $_GET['responsavel'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'status','id'=>'status','value'=>( ! isset($_GET['status'])) ? '' : $_GET['status'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'prioridade','id'=>'prioridade','value'=>( ! isset($_GET['prioridade'])) ? '' : $_GET['prioridade'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'tipo','id'=>'tipo','value'=>( ! isset($_GET['tipo'])) ? '' : $_GET['tipo'])) ;?>
       
        <input type="submit" value="Gerar PDF" class="btn-busca" />
	
	<?php echo form_close();?>

	<?php endif; ?>

</div><!--/tabela -->