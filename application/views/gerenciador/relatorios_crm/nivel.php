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
            
            <fieldset>
            <div class="busca2" >
                <span class="buscar-span"><b>Relatório</b></span>	
		<?php echo form_open($controller.'/buscar_nivel', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			
				
                               <div class="input text obrigatorio">
                                    <label for="nivel">Nível:</label>
                                    <?php echo form_dropdown("nivel", $nivel,( ! isset($_GET['nivel'])) ? '' : $_GET['nivel'], "id=\"nivel\"  "); ?>
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
			<th>Nível</th>
                        <th>Empresa</th>
			<th>Data da Ação Tratada</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
                                <td><?php echo isset($nivel[$row->tipo]) ? $nivel[$row->tipo] : '';?></td>
                                <td><?php echo $row->razao_social;?></td>
				<td><?php echo br_date($row->data_acao);?></td>
			</tr>
		<?php endforeach;?>
	</table>
        
        <?php echo form_open($controller.'/buscar_nivel', array('id' => 'gerarpdf', 'target'=>'blank', 'method' => 'get'));?>
			
				
                               
        <?php echo form_input(array('type'=>'hidden','name'=>'pdf','id'=>'pdf','value'=>'true'));?>
        <?php echo form_input(array('type'=>'hidden','name'=>'nivel','id'=>'nivel','value'=>( ! isset($_GET['nivel'])) ? '' : $_GET['nivel'])) ;?>
       
        <input type="submit" value="Gerar PDF" class="btn-busca" />
	
	<?php echo form_close();?>

	<?php endif; ?>

</div><!--/tabela -->