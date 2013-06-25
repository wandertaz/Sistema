<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor($controller.'/adicionar/'.$tipo, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo $title_sing;?></p>
		</div><!--/adicionar -->

		<?php echo form_open($controller.'/buscar', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			<div class="busca">
				<span class="buscar-span">Buscar</span>
				<input type="hidden" name="tipo" id="tipo" value="<?php echo $tipo;  ?>" />
				<input type="text" name="s" class="busca-input" id="s" value="<?php echo ( ! isset($_GET['s'])) ? '' : $_GET['s'];?>" />
				<input type="submit" value="" class="btn-busca" />
			</div><!--/busca -->
		<?php echo form_close();?>

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>
	<p style="color:#FF3600 !important;"><?php echo $this->session->flashdata('msg_erro');?></p></div>

	<?php if(!count($registros)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><a href="#">Aula</a></th>
			<th>Típo</th>
			<th>Título</th>
			<th>Valor</th>
			<th>Ativo?</th>
			<th>Perguntas</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->aula; ?></td>
				<td><?php echo $row->tipo == 'P' ? 'Prova' : 'Exercício'; ?></td>
				<td><?php echo $row->titulo; ?></td>
				<td><?php echo $row->valor; ?></td>
				<td><?php echo $row->ativo == 'S' ? 'Sim' : 'Não'; ?></td>
				<td><?php echo anchor(site_url().'multitools/exercicios_perguntas/index/'.$row->id, 'Gerenciar Perguntas', NULL);?></td>
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