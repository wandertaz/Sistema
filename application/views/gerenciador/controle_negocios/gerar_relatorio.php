<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<!--<?php //echo anchor('multitools/inscritos/adicionar/J', img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>-->
                        <p><h5>Relatório <?php echo $titulo;?></h5></p>
		</div><br>

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($registros1)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
            <tr ><th colspan="3" style="text-align:center;" >Relatório Taxa de Conversão</th><tr>
		<tr>
			<th>Nº Propostas</th>
                        <th>Valor Propostas apresentadas</a></th>                       
                        <th>Valor Propostas fechadas</a></th>			
			
		</tr>
		<?php foreach($registros1 as $row):?>
			<tr class="altrow">
				<td><?php echo $row->qtd;?></td>
                                <td>R$ <?php echo number_format($row->valor_inicial,2);?></td>
                                
                                 <td>R$ <?php echo number_format($row->valor_fechado,2);?></td>
		
			</tr>
		<?php endforeach;?>
	</table><br><br>
	
	<?php endif; ?>
                
                
         
	<?php if(!count($registros2)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
            <tr ><th style="text-align:center;" >Relatório Pontualidade de Propostas</th><tr>
		<tr>
			<th>Nº Propostas Pontuais</th>                        			
			
		</tr>
		<?php foreach($registros2 as $row):?>
			<tr class="altrow">
				<td><?php echo $row->qtd;?></td>              
			</tr>
		<?php endforeach;?>
	</table><br><br>
	
	<?php endif; ?>  
        
        
        <?php if(!count($registros3)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
            <tr ><th style="text-align:center;" >Relatório Prazo médio de proposta</th><tr>
		<tr>
                    <th>Prazo médio de atendimento <i>(em dias)</i></th>
      			
			
		</tr>
		<?php foreach($registros3 as $row):?>
			<tr class="altrow">
				<td><?php echo $row->qtd_dias - $row->qtd ;?></td>                    
			</tr>
		<?php endforeach;?>
	</table><br><br>
	
	<?php endif; ?>   
        
        
        
        
        
        
        
        
        
        
        
        <?php if(!count($registros4)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
            <tr ><th style="text-align:center;" >Relatório de Indicações</th><tr>
		<tr>
			<th>Nº Propostas Indicadas</th>
      			
			
		</tr>
		<?php foreach($registros4 as $row):?>
			<tr class="altrow">
				<td><?php echo $row->qtd;?></td>                    
			</tr>
		<?php endforeach;?>
	</table><br><br>
	
	<?php endif; ?>   
        
                
                

</div><!--/tabela -->