<div id="tabela">

	<div id="cima">
            
            <style>
             input[type="text"],select.busca-input-2  {                 
                   width:50%; 
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
                <span class="buscar-span" ><b>Relatório</b></span>	
		<?php echo form_open($controller.'/buscar_empresa', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			
				
                               
                                <div class="input text obrigatorio">
                                    <label for="segmento_empresa">Segmento:</label>
                                    <?php echo form_dropdown("segmento_empresa", $segmento,( ! isset($_GET['segmento_empresa'])) ? '' : $_GET['segmento_empresa'], "id=\"segmento_empresa\"  "); ?>
                                </div>
                                <div class="input text obrigatorio">
                                     <label for="atuacao_empresa"> Ramo de Atividade: </label>
                                     <?php echo form_dropdown("atuacao_empresa", $ramo_atividade,( ! isset($_GET['atuacao_empresa'])) ? '' : $_GET['atuacao_empresa'], "id=\"atuacao_empresa\"  "); ?>
                                </div>
                                <div class="input text obrigatorio">
                                    <label for="classificacao">Classificação:</label>
                                    <?php echo form_dropdown("classificacao", $classificacao,( ! isset($_GET['classificacao'])) ? '' : $_GET['classificacao'], "id=\"classificacao\"  "); ?>
                                </div>
                                <div class="input text obrigatorio">
                                     <label for="prospect">Prospect:</label>
                                     <?php echo form_dropdown("prospect", array('' => 'Nenhum item selecionado','S' => 'Sim', 'N' => 'Não'),( ! isset($_GET['prospect'])) ? '' : $_GET['prospect'], "id=\"prospect\"  "); ?>
                                </div>
                                <div class="input text obrigatorio">
                                    <label for="cliente">Cliente:</label>
                                        <?php echo form_dropdown("cliente", array('' => 'Nenhum item selecionado','S' => 'Sim', 'N' => 'Não'),( ! isset($_GET['cliente'])) ? '' : $_GET['cliente'], "id=\"cliente\" "); ?>
                                </div>
                                <div class="input text obrigatorio">
                                    <label for="origem">Origem DB:</label><br>
                                    <?php echo form_input(array('name'=>'origem','id'=>'origem','value'=>( ! isset($_GET['origem'])) ? '' : $_GET['origem'])) ;?>
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
			
                        <th>Razão Social</th>
                        <th>Nome Fantasia</th>
                        <th>Segmento</th>
                        <th>Ramo de Atividade</th>
                        <th>Classificação</th>
                        <th>Origem DB</th>
			<th>Prospect</th>
			<th>Cliente</th>
		</tr>
                <?php 
                
                $ramo_atividade[''] =  '';
                $segmento[''] =  '';
                $classificacao[''] =  '';
                
                ?>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				
                                <td><?php echo $row->razao_social;?></td>
                                <td><?php echo $row->nome;?></td>
                                 <td><?php echo isset($segmento[$row->segmento_empresa]) ? $segmento[$row->segmento_empresa] : '';?></td>
                                 <td><?php echo isset($ramo_atividade[$row->atuacao_empresa]) ? $ramo_atividade[$row->atuacao_empresa] : '';?></td>
                                 <td><?php echo isset($classificacao[$row->classificacao]) ? $classificacao[$row->classificacao] : '';?></td>
                                 <td><?php echo $row->origem_cadastro;?></td>
                                 <td><?php echo $row->prospect == 'S' ? 'Sim' : 'Não';?></td>
				 <td><?php echo $row->cliente == 'S' ? 'Sim' : 'Não';?></td>
			</tr>
		<?php endforeach;?>
	</table>
        
        <?php echo form_open($controller.'/buscar_empresa', array('id' => 'gerarpdf', 'target'=>'blank', 'method' => 'get'));?>
			
				
                               
        <?php echo form_input(array('type'=>'hidden','name'=>'pdf','id'=>'pdf','value'=>'true'));?>
        <?php echo form_input(array('type'=>'hidden','name'=>'segmento_empresa','id'=>'segmento_empresa','value'=>( ! isset($_GET['segmento_empresa'])) ? '' : $_GET['segmento_empresa'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'atuacao_empresa','id'=>'atuacao_empresa','value'=>( ! isset($_GET['atuacao_empresa'])) ? '' : $_GET['atuacao_empresa'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'classificacao','id'=>'classificacao','value'=>( ! isset($_GET['classificacao'])) ? '' : $_GET['classificacao'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'origem','id'=>'origem','value'=>( ! isset($_GET['origem'])) ? '' : $_GET['origem'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'prospect','id'=>'prospect','value'=>( ! isset($_GET['prospect'])) ? '' : $_GET['prospect'])) ;?>
        <?php echo form_input(array('type'=>'hidden','name'=>'cliente','id'=>'cliente','value'=>( ! isset($_GET['cliente'])) ? '' : $_GET['cliente'])) ;?>
  
        <input type="submit" value="Gerar PDF" class="btn-busca" />
	
	<?php echo form_close();?>

	<?php endif; ?>

</div><!--/tabela -->