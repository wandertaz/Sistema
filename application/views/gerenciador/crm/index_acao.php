<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor('multitools/crm/adicionar_acao/'.$id_empresa, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Nova Ação de Prospecção")'));?>
			<p>Adicionar <?php echo 'Ação de Prospecção';?></p>
		</div>

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>
        
	<?php if(!count($cadastrados)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Descrição</th>
                        <th>Data</th>
			<th>Responsável MB</th>
                        <th>Tipo</th>
			<th>Status</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($cadastrados as $row):?>
			<tr class="altrow">
				<td><?php echo $row->descricao_acao;?></td>
                                <td><?php echo br_date($row->data);?></td>
                                <td><?php if ( isset($usuarios[$row->id_usuario_responsavel_mb])) echo $usuarios[$row->id_usuario_responsavel_mb];?></td>
				<td><?php echo $row->tipo == 'R' ? 'Reativa' : 'Proativa';?></td>
				<td><?php echo ($row->status == 'CO' ? 'Concluído' : ($row->status == 'AN' ? 'Andamento': ($row->status == 'CA' ? 'Cancelado': ($row->status == 'PA' ? 'Paralisado':'Programado'))));?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar_acao/'.$row->id, 'Editar', NULL);?>
                                        <?php echo anchor($controller.'/excluir_acao/'.$row->id, 'Excluir', array("onclick"=>"return confima_exclusao('Ação de Prospecção')"));?>
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
        
        <br/>
        
	<div class="baixo">
		<?php echo anchor($controller.'/empresas/', 'Voltar para Empresas', NULL);?>
	</div><!--/baixo -->

</div><!--/tabela -->