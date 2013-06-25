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
			<th class="marcado-th"><a href="#">Idioma</a></th>
			<th><a href="#">Título</a></th>
			<th><a href="#">Data</a></th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->idioma;?></td>
				<td><?php echo $row->titulo;?></td>
				<td><?php echo $row->data;?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar/'.$row->id, 'Editar', NULL);?>
		            <?php echo anchor($controller.'/excluir/'.$row->id, 'Excluir', array("onclick"=>"return confima_exclusao('$title_sing')"));?>
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