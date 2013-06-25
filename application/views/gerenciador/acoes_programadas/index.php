<div id="tabela">

	<div id="cima">

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($registros)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo anchor($controller.'/index/'.( $campo != 'data' ? 'ASC' : $ordem).'/data/'.$pagina, 'Data', NULL);?></th>
			<th><?php echo anchor($controller.'/index/'.( $campo != 'tipo' ? 'ASC' : $ordem).'/tipo/'.$pagina, 'Ação', NULL);?></th>
			<th><?php echo anchor($controller.'/index/'.( $campo != 'descricao' ? 'ASC' : $ordem).'/descricao/'.$pagina, 'Descrição', NULL);?></th>
			<th><?php echo anchor($controller.'/index/'.( $campo != 'MB' ? 'ASC' : $ordem).'/MB/'.$pagina, 'Responsável MB', NULL);?></th>
			<th><?php echo anchor($controller.'/index/'.( $campo != 'empresa' ? 'ASC' : $ordem).'/empresa/'.$pagina, 'Empresa', NULL);?></th>
			<th><?php echo anchor($controller.'/index/'.( $campo != 'contato' ? 'ASC' : $ordem).'/contato/'.$pagina, 'Contato', NULL);?></th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo br_date($row->data);?></td>
				<td><?php echo $row->tipo;?></td>
				<td><?php echo $row->descricao;?></td>
				<td><?php echo $row->MB;?></td>
				<td><?php echo $row->empresa;?></td>
				<td><?php echo $row->contato;?></td>
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