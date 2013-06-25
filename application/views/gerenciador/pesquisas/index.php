<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor($controller.'/adicionar', img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo $title_sing;?></p>
		</div><!--/adicionar -->

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
			<th class="marcado-th"><a>Título</a></th>
			<th><a>Cliente</a></th>
			<th><a>Ativo</a></th>
			<th><a>Status</a></th>
			<th>Perguntas</th>
			<th>Contatos</th>
			<th>Sugestões</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->titulo;?></td>
				<td><?php echo $row->nome;?></td>
				<td><?php echo $row->ativo == 'S' ? 'Sim' : 'Não';?></td>
				<td><?php echo ($row->status == 'AP' ? 'Aprovado' : ($row->status == 'AL'? 'Alteração' : ($row->status == 'NA'? 'Não Aprovado' : 'Status Inicial')));?></td>
				<td><?php echo anchor(site_url().'multitools/pesquisas_perguntas/index/'.$row->id_pesquisas, 'Gerenciar Perguntas', NULL);?></td>
				<td><?php echo anchor(site_url().'multitools/pesquisas_contatos/index/'.$row->id_pesquisas, 'Gerenciar Contatos', NULL);?></td>
				<td><?php echo anchor(site_url().'multitools/pesquisas/questionario/'.$row->id_pesquisas.'/ver_sugestoes', 'Ver Sugestões', NULL);?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar/'.$row->id_pesquisas, 'Editar', NULL);?><br />
		            <?php echo anchor($controller.'/desativar/'.$row->id_pesquisas, 'Desativar', array("onclick"=>"return confima_desativa('$title_sing')"));?><br />
		            <?php echo anchor($controller.'/excluir/'.$row->id_pesquisas, 'Excluir', array("onclick"=>"return confima_exclusao('$title_sing')"));?><br />
		            <?php echo anchor(site_url().'multitools/pesquisas/questionario/'.$row->id_pesquisas, 'Questionário', NULL);?><br />
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