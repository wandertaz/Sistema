<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor('multitools/crm/adicionar_folowups/'.$id_proposta, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo Folowups")'));?>
			<p>Adicionar <?php echo 'Folowups';?></p>
		</div>


	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($cadastrados)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Data</th>
                        <th>Responsável pelo folowup(MB)</th>
                        <th>Nome do contato do cliente</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($cadastrados as $row):?>
			<tr class="altrow">
				<td><?php echo br_date($row->data_acao);?></td>
                                <td><?php if ( isset($usuarios[$row->id_usuario_responsavel_folowups])) echo $usuarios[$row->id_usuario_responsavel_folowups];?></td>
                                <td><?php if ( isset($contatos[$row->contato_empresa_id])) echo $contatos[$row->contato_empresa_id];?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar_folowups/'.$row->id, 'Editar', NULL);?>
                                        <?php echo anchor($controller.'/excluir_folowups/'.$row->id, 'Excluir', array("onclick"=>"return confima_exclusao('Folowups')"));?>
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
		<?php echo anchor($controller.'/proposta/'.$id_empresa, 'Voltar para Proposta', NULL);?>
	</div><!--/baixo -->


</div><!--/tabela -->