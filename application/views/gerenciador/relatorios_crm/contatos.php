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
		<?php echo form_open($controller.'/buscar_contatos', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			
				
                                <div class="input text obrigatorio">
                                    <label for="data">Aniversário:</label><br>
                                    <?php echo form_input(array('name'=>'data','id'=>'data','value'=>( ! isset($_GET['data'])) ? '' : $_GET['data'],'class'=>'datepickersemano')) ;?>
                                </div>
                                <div class="input text obrigatorio">
                                    <label for="brinde">Brinde:</label><br>
                                    <?php echo form_dropdown("brinde", array('' => 'Nenhum item selecionado','1' => 'Sim', '0' => 'Não'),( ! isset($_GET['brinde'])) ? '' : $_GET['brinde'], "id=\"brinde\"  "); ?>
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
			<th>Nome</th>
                        <th>Empresa</th>
			<th>E-mail</th>
			<th>Aniversário</th>
		</tr>
		<?php foreach($registros as $row):?>
                        
                            <tr class="altrow">
                                    <td><?php echo $row->forma_de_tratamento.' '.$row->nome;?></td>
                                    <td><?php echo $row->razao_social;?></td>
                                    <td><?php echo $row->email;?></td>
                                    <td><?php echo br_date($row->data_nascimento);?></td>
                                   
                            </tr>                           
                       
          
		<?php endforeach;?>
	</table>
        
        <?php echo form_open($controller.'/buscar_contatos', array('id' => 'gerarpdf', 'target'=>'blank', 'method' => 'get'));?>
			
				
                               
        <?php echo form_input(array('type'=>'hidden','name'=>'pdf','id'=>'pdf','value'=>'true'));?>
        <?php echo form_input(array('type'=>'hidden','name'=>'data','id'=>'data','value'=>( ! isset($_GET['data'])) ? '' : $_GET['data'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'brinde','id'=>'brinde','value'=>( ! isset($_GET['brinde'])) ? '' : $_GET['brinde'])) ;?>
        
        <input type="submit" value="Gerar PDF" class="btn-busca" />
	
	<?php echo form_close();?>
	<?php endif; ?>

</div><!--/tabela -->