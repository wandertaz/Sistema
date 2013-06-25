<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor('multitools/crm/adicionar_brinde/'.$id_brinde, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo 'Brinde';?></p>
		</div>


	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($cadastrados)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Ocasião</th>                       
                        <th>Data da envio</th>			
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($cadastrados as $row):?>
			<tr class="altrow">                              
                                <td><?php echo ($row->ocasiao == 'AN' ? 'Aniversário' : ($row->ocasiao == 'PM' ? 'Promotor' : ($row->ocasiao == 'PP' ? 'Proposta':($row->ocasiao == 'HO' ? 'Homenagem':'Outro'))));?></td>
				<td><?php echo br_date($row->data_envio);?></td>
				
				<td class="actions">
					<?php echo anchor($controller.'/editar_brinde/'.$row->id, 'Editar', NULL);?>
                                        <?php echo anchor($controller.'/excluir_brinde/'.$row->id, 'Excluir', array("onclick"=>"return confima_exclusao('Proposta')"));?>
                                       
				</td>
			</tr>
		<?php endforeach;?>
	</table>

	<div class="baixo">
		<?php if( isset($paginacao)):?>            
			<div class="paginacao"><?php echo $paginacao;?></div>--><!--/paginacao -->
		<?php endif;?>
	</div><!--/baixo -->

	<?php endif; ?>
        
        <br/>
        
	<div class="baixo">
		<?php echo anchor($controller.'/gerenciamento_contatos/'.$id_empresa, 'Voltar para Contatos', NULL);?>
	</div><!--/baixo -->


</div><!--/tabela -->