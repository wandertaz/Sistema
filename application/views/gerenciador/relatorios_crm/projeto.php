<div id="tabela">

	<div id="cima">
            
            <style>
             input[type="text"],select{                 
                   width:55% !important; 
                   margin:10px 0px 0px 0px;                     
                  display: inline-block;
                   float: none !important;
                    
                }
                
                .data_relatorio{ 
                     max-width:20%;
                }
                
                .busca2{
                    width:20%;
                    text-align: left;  
                  
                    
                    
                }
                
            </style>
            
            <fieldset>
                <div class="busca2" >
                    <span class="buscar-span" ><b>Relatório</b></span>	
                    <?php echo form_open($controller.'/buscar_projeto', array('id' => 'UserIndexForm', 'method' => 'get'));?>

                                    <div class="input text obrigatorio">
                                        <label for="nome">Nome do Projeto:</label><br>
                                        <?php echo form_input(array('name'=>'nome','id'=>'nome','value'=>( ! isset($_GET['nome'])) ? '' : $_GET['nome'])) ;?>
                                    </div>
                    
                                    <div class="input text obrigatorio">
                                        <label for="tipo">Tipo:</label><br/>
                                        <?php echo form_dropdown("tipo", $tipo,( ! isset($_GET['tipo'])) ? '' : $_GET['tipo'], "id=\"tipo\" "); ?>
                                    </div>
                    
                                    <div class="input text obrigatorio">
                                        <label for="data_inicio_de"> Data de Início: de</label><br>
                                       
                                        <?php echo form_input(array('name'=>'data_inicio_de','id'=>'data_inicio_de','value'=>( ! isset($_GET['data_inicio_de'])) ? '' : $_GET['data_inicio_de'],'class'=>'data_relatorio datepicker2','maxlength'=>'10')) ;?> 
                                        até 
                                        <?php echo form_input(array('name'=>'data_inicio_ate','id'=>'data_inicio_ate','value'=>( ! isset($_GET['data_inicio_ate'])) ? '' : $_GET['data_inicio_ate'],'class'=>'data_relatorio datepicker2','maxlength'=>'4')) ;?>
                                        
                                    </div>
                                    <div class="input text obrigatorio">
                                        <label for="data_termino_de">Data de Término: de</label><br>
                                        <?php echo form_input(array('name'=>'data_termino_de','id'=>'data_termino_de','value'=>( ! isset($_GET['data_termino_de'])) ? '' : $_GET['data_termino_de'],'class'=>'data_relatorio datepicker2','maxlength'=>'10')) ;?> 
                                        até 
                                        <?php echo form_input(array('name'=>'data_termino_ate','id'=>'data_termino_ate','value'=>( ! isset($_GET['data_termino_ate'])) ? '' : $_GET['data_termino_ate'],'class'=>'data_relatorio datepicker2','maxlength'=>'10')) ;?>
                                    </div>
                                    <div class="input text obrigatorio">
                                        <label for="responsavel">Consultor Responsável:</label><br/>
                                        <?php echo form_dropdown("responsavel", $colaborador,( ! isset($_GET['responsavel'])) ? '' : $_GET['responsavel'], "id='responsavel'"); ?>
                                    </div>
                                    <div class="input text obrigatorio">
                                        <label for="status">Status:</label><br/>
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
            </fieldset>

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(count($registros)): ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Nome do projeto</th>
                        <th>Empresa</th>
                        <th>Nº da proposta</th>
                        <th>Tipo</th>
                        <th>Data de Início</th>
                        <th>Data de Término</th>
			<th>Consultor Responsável</th>
			<th>Status</th>
		</tr>
                
		<?php foreach($registros as $row):?>
                    
			<tr class="altrow">
				<td><?php echo $row->nome;?></td>
                                <td><?php echo $row->razao_social;?></td>
                                <td><?php echo $row->n_proposta;?></td>
                                <td><?php echo isset($tipo[$row->tipo]) ? $tipo[$row->tipo] : '';?></td>
                                <td><?php echo br_date($row->data_inicio);?></td>
                                <td><?php echo (($row->data_termino!= '0000-00-00') ? br_date($row->data_termino) : '') ;?></td>
				<td><?php echo isset($colaborador[$row->id_usuario_consultor_responsavel]) ? $colaborador[$row->id_usuario_consultor_responsavel] : '';?></td>
				<td><?php echo isset($status[$row->status]) ? $status[$row->status] : '';?></td>
			</tr>
		<?php endforeach;?>
	</table>
        
        <?php echo form_open($controller.'/buscar_projeto', array('id' => 'gerarpdf', 'target'=>'blank', 'method' => 'get'));?>
			
				
                               
        <?php echo form_input(array('type'=>'hidden','name'=>'pdf','id'=>'pdf','value'=>'true'));?>
        <?php echo form_input(array('type'=>'hidden','name'=>'nome','id'=>'nome','value'=>( ! isset($_GET['nome'])) ? '' : $_GET['nome'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'tipo','id'=>'tipo','value'=>( ! isset($_GET['tipo'])) ? '' : $_GET['tipo'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'classificacao','id'=>'classificacao','value'=>( ! isset($_GET['classificacao'])) ? '' : $_GET['classificacao'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'data_inicio_de','id'=>'data_inicio_de','value'=>( ! isset($_GET['data_inicio_de'])) ? '' : $_GET['data_inicio_de'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'data_inicio_ate','id'=>'data_inicio_ate','value'=>( ! isset($_GET['data_inicio_ate'])) ? '' : $_GET['data_inicio_ate'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'data_termino_de','id'=>'data_termino_de','value'=>( ! isset($_GET['data_termino_de'])) ? '' : $_GET['data_termino_de'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'data_termino_ate','id'=>'data_termino_ate','value'=>( ! isset($_GET['data_termino_ate'])) ? '' : $_GET['data_termino_ate'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'responsavel','id'=>'responsavel','value'=>( ! isset($_GET['responsavel'])) ? '' : $_GET['responsavel'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'status','id'=>'status','value'=>( ! isset($_GET['status'])) ? '' : $_GET['status'])) ;?>
  
        <input type="submit" value="Gerar PDF" class="btn-busca" />
	
	<?php echo form_close();?>

	<?php endif; ?>

</div><!--/tabela -->