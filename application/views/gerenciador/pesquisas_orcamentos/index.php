<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<!--<?php// echo anchor($controller.'/adicionar', img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php //echo $title_sing;?></p>-->
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
			<th class="marcado-th"><a href="#">Empresa</a></th>
			<th><a href="#">Responsável</a></th>
            <th class="actions">E-mail</th>
            <th class="actions">Telefone</th>
            <th class="actions">Celular</th>
            <th class="actions">Concluiu Proposta</th>
            <th class="actions">Valor</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->nome_empresa;?></td>
				<td><?php echo $row->nome_responsavel;?></td>
				<td><?php echo $row->email_resposta;?></td>
				<td><?php echo $row->telefone;?></td>
				<td><?php echo $row->celular;?></td>
                                <td><?php echo $row->aceito=='S'?'Sim':'Não';?></td>
                                <td><?php echo $row->valor_orcamento>0?'R$ '.$row->valor_orcamento:'Não Concluído';?></td>

				<td class="actions">
					<?php echo anchor($controller.'/editar/'.$row->id_pesquisas_orcamentos, 'Detalhes', NULL);?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>

	<div class="baixo">
		<?php if( isset($paginacao)):?>
			<div class="paginacao"><?php echo $paginacao;?></div><!--/paginacao -->
		<?php endif;?>
	</div><!--/baixo -->

	<?php endif; ?>

</div><!--/tabela -->