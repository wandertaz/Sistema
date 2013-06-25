<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor('multitools/mailing/adicionar_mailing', img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo 'Mailing';?></p>
		</div>
            
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
            

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($registros)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			
                        <th>titulo</a></th>
                        <th>Data Envio</a></th>
                        <th>Data Criação</a></th>                       
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				
                                <td><?php echo $row->titulo;?></td>
                                <td><?php echo br_date($row->data_envio);?></td>
                                 <td><?php echo br_date($row->created);?></td>                                 
				<td class="actions">
					<?php echo anchor($controller.'/gerenciamento_mailing/'.$row->id, 'Visualizar E-mails', NULL);?>					
                                       
                                </td>
			</tr>
		<?php endforeach;?>
	</table>

	<div class="baixo">
		<?php if( isset($paginacao)):?>            
			<div class="paginacao"><?php echo $paginacao;?></div><!--/paginacao -->
		<?php endif;?>
	</div><!--/baixo -->

	<?php endif; ?>

</div><!--/tabela -->