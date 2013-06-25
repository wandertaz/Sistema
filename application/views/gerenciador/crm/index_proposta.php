<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor('multitools/crm/adicionar_proposta/'.$id_empresa, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo 'Proposta';?></p>
		</div>


	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($cadastrados)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Numero Proposta</th>
                        <th>Nome Proposta</th>
                        <th>Data da Solicitação</th>
			<th>Classificação</th>
			<th>Status</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($cadastrados as $row):?>
			<tr class="altrow">
				<td><?php echo $row->id;?></td>
                                <td><?php echo $row->nome;?></td>
                                <td><?php echo br_date($row->data_solicitacao);?></td>
				<td><?php echo ($row->classificacao == 'D' ? 'Diamante' : ($row->classificacao == 'O' ? 'Ouro' : ($row->classificacao == 'P' ? 'Prata':'Bronze')));?></td>
				<td><?php echo ($row->status == 'FE' ? 'Fechada' : ($row->status == 'NE' ? 'Negativada' : ($row->status == 'EM' ? 'Em aberto':'Não apresentada')));?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar_proposta/'.$row->id, 'Editar', NULL);?>
                                        <?php echo anchor($controller.'/excluir_proposta/'.$row->id, 'Excluir', array("onclick"=>"return confima_exclusao('Proposta')"));?>
                                        <?php echo anchor($controller.'/folowups/'.$row->id, 'Folowups', NULL);?>
				</td>
			</tr>
                        
		<?php endforeach;?>
	</table>

	<div class="baixo">
		<?php if( isset($paginacao)):?>            
			<div class="paginacao"><?php echo $paginacao;?></div>--><!--/paginacao -->
		<?php endif;?>
	</div><!--/baixo -->

	<?php endif; ?>
        
        <br/>
        
	<div class="baixo">
		<?php echo anchor($controller.'/empresas/', 'Voltar para Empresas', NULL);?>
	</div><!--/baixo -->


</div><!--/tabela -->