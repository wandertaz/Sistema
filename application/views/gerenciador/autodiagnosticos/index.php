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
			<th class="marcado-th"><a href="#">Nome</a></th>
			<th><a href="#">Área</a></th>
			<th>Grupos de Perguntas</th>
			<th>Tipos de Resultados</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->nome;?></td>
				<td><?php echo $row->nome_tipo;?></td>
				<td><?php echo anchor(site_url().'multitools/autodiagnosticos_grupos/index/'.$row->id_autodiagnostico, 'Gerenciar Grupos', NULL);?></td>
				<td><?php echo anchor(site_url().'multitools/autodiagnosticos_resultados/index/'.$row->id_autodiagnostico, 'Gerenciar Resultados', NULL);?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar/'.$row->id_autodiagnostico, 'Editar', NULL);?>
		            <?php echo anchor($controller.'/excluir/'.$row->id_autodiagnostico, 'Excluir', array("onclick"=>"return confima_exclusao('$title_sing')"));?>
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