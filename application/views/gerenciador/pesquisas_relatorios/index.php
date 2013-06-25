<div id="tabela">

	<div id="cima">

		<?php echo form_open($controller.'/buscar', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			<div class="busca">
				<span class="buscar-span">Buscar</span>
				<input type="text" name="s" class="busca-input" id="s" value="<?php echo ( ! isset($_GET['s'])) ? '' : $_GET['s'];?>" />
				<input type="submit" value="Buscar" class="btn-busca" />
			</div><!--/busca -->
		<?php echo form_close();?>

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($registros)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th class="marcado-th"><a>Pesquisa</a></th>
			<th><a>Cliente</a></th>
			<th><a>Ativo</a></th>
			<th><a>Status</a></th>
			<th>Tabulação</th>
			<th>Gráficos</th>
			<th>Respostas Abertas</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->titulo;?></td>
				<td><?php echo $row->nome;?></td>
				<td><?php echo $row->ativo == 'S' ? 'Sim' : 'Não';?></td>
				<td><?php echo ($row->status == 'AP' ? 'Aprovado' : ($row->status == 'AL'? 'Alteração' : ($row->status == 'NA'? 'Não Aprovado' : 'Em Espera')));?></td>
				<td><?php echo anchor(site_url().'multitools/pesquisas_relatorios/tabulacao/'.$row->id_pesquisas, 'Baixar Tabulação', NULL);?></td>
				<td><?php echo anchor(site_url().'multitools/pesquisas_relatorios/graficos/'.$row->id_pesquisas, 'Baixar Gráficos', NULL);?></td>
				<td><?php echo anchor(site_url().'multitools/pesquisas_relatorios/questoes_abertas/'.$row->id_pesquisas, 'Baixar Respostas Abertas', NULL);?></td>
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