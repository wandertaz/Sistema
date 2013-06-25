<div id="tabela">

	<div id="cima">

		<div class="adicionar" wid>
			<a href="<?php echo site_url($controller.'/consulta') ?>">Nova Consulta</a>
		</div><!--/adicionar -->

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($registros)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<h1 style="margin: 25px 0 15px; font-size: 16px;">Resultados da Consulta</h1>
	<p>Foram encontrados <?php echo $qtd_registros; ?> registro(s).</p>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><a href="#">Nome</a></th>
			<th>Cadastrado por</th>
			<th>Última Atualização</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->nome;?></td>
				<td><?php echo $row->tipo_cadastro == 'M' ? 'MB Consultoria' : 'Profissional';?></td>
				<td><?php echo date('d/m/Y - H:i:s', strtotime($row->ultima_atualizacao));?></td>
				<td class="actions">
					<?php echo anchor($controller.'/visualizar/'.$row->id, 'Visualizar', NULL);?>
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