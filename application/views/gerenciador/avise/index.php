<div id="tabela">

	<div id="cima">

		<?php echo form_open($controller."/buscar", array('id' => 'UserIndexForm', 'method' => 'get'));?>
			<div class="busca">
				<span class="buscar-span">Buscar</span>
                                <input type="hidden" name="tipo_curso" value="<?php echo $tipo_curso;?>">
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
			<th class="marcado-th"><a href="#">Curso</a></th>
			<th><a href="#">Nome</a></th>
			<th><a href="#">E-mail</a></th>
			<th><a href="#">Disponibilidade</a></th>
			<th><a href="#">Data</a></th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->titulo_aberto ? $row->titulo_aberto : $row->titulo_programa;?></td>
				<td><?php echo $row->nome_interessado;?></td>
				<td><?php echo $row->email_interessado;?></td>
				<td><?php echo $row->horario;?></td>
				<td><?php echo br_date($row->created);?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar/'.$row->avise_me_id, 'Editar', NULL);?>
		            <?php echo anchor($controller.'/excluir/'.$row->avise_me_id, 'Excluir', array("onclick"=>"return confima_exclusao('$title_sing')"));?>
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