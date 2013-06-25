<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor($controller.'/adicionar/'.$pesquisas_perguntas_id_pesquisas_perguntas, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo $title_sing;?></p>
		</div><!--/adicionar -->

		<?php echo form_open($controller.'/buscar', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			<div class="busca">
				<span class="buscar-span">Buscar</span>
				<input type="hidden" name="pergunta_id" id="pergunta_id" value="<?php echo $pesquisas_perguntas_id_pesquisas_perguntas;  ?>" />
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
			<th class="marcado-th"><a href="#">Ordem</a></th>
			<th>Opção</th>
			<th>Tipo</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->ordem;?></td>
				<td><?php echo $row->opcao;?></td>
				<td><?php echo $row->tipo == 'A' ? 'Aberta' : 'Fechada';?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar/'.$row->id_pesquisas_perguntas_opcoes, 'Editar', NULL);?>
		            <?php echo anchor($controller.'/excluir/'.$row->id_pesquisas_perguntas_opcoes, 'Desativar', array("onclick"=>"return confima_exclusao('$title_sing')"));?>
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
		<a href="<?php echo site_url('multitools/pesquisas_perguntas/index/'.$pergunta->pesquisas_id_pesquisas); ?>">Voltar para Perguntas</a>
	</div><!--/baixo -->

</div><!--/tabela -->