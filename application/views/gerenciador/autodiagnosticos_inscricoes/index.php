<div id="tabela">

	<div id="cima">
<!--
		<div class="adicionar">
			<?php echo anchor($controller.'/adicionar', img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo $title_sing;?></p>
		</div>
 -->           
                <div class="adicionar">
			<?php echo anchor($controller.'/gerarrelatorio', img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Relatório Inscrições Pagas</p>
		</div>

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
			<th class="marcado-th"><a href="#">Nome</a></th>
			<th>Autodiagnóstico</th>
			<th>Data de Inscrição</th>
			<th>Status</th>
			<!--<th class="actions">Ações</th>-->
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->inscrito;?></td>
				<td><?php echo $row->autodiagnostico;?></td>
				<td><?php echo br_date($row->data_inscricao);?></td>
				<td><?php echo $status[$row->status];?>
				<?php echo $row->status == 'F' ? ' : '.$row->resultado.' pontos' : '';?>
				</td>
				<!--<td class="actions">
					<?php echo anchor($controller.'/editar/'.$row->id_inscricao, 'Editar', NULL);?>
		            <?php echo anchor($controller.'/excluir/'.$row->id_inscricao, 'Excluir', array("onclick"=>"return confima_exclusao('$title_sing')"));?>
				</td>
				-->
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