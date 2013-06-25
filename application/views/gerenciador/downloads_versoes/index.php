<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor($controller.'/adicionar/'.$downloads_id_downloads, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo $title_sing;?></p>
		</div><!--/adicionar -->

		<?php echo form_open($controller.'/buscar', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			<div class="busca">
				<span class="buscar-span">Buscar</span>
				<input type="hidden" name="download_id" id="download_id" value="<?php echo $downloads_id_downloads;  ?>" />
				<input type="text" name="s" class="busca-input" id="s" value="<?php echo ( ! isset($_GET['s'])) ? '' : $_GET['s'];?>" />
				<input type="submit" value="" class="btn-busca" />
			</div><!--/busca -->
		<?php echo form_close();?>

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($registros)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th class="marcado-th"><a href="#">Download</a></th>
			<th>Versão</th>
			<th>Descrição</th>
			<th>Ativo?</th>
			<th>Cobrar Atualização?</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->titulo;?></td>
				<td><?php echo $row->numero_versao;?></td>
				<td><?php echo $row->descricao_versao;?></td>
				<td><?php echo $row->ativo == 'S' ? 'Sim' : 'Não';?></td>
				<td><?php echo $row->cobrada == 'S' ? 'Sim' : 'Não';?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar/'.$row->id_download_versoes, 'Editar', NULL);?>
		            <?php echo anchor($controller.'/excluir/'.$row->id_download_versoes, 'Desativar', array("onclick"=>"return confima_exclusao('$title_sing')"));?>
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

	<div class="baixo">
		<a href="<?php echo site_url('multitools/downloads'); ?>">Voltar para Downloads</a>
	</div><!--/baixo -->

</div><!--/tabela -->