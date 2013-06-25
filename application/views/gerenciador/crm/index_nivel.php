<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor('multitools/crm/adicionar_nivel/'.$id_empresa, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo Nível de Satisfação")'));?>
			<p>Adicionar <?php echo 'Nivel de Satisfação';?></p>
		</div>

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>
        
	<?php if(!count($cadastrados)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Nível</th>
			<th>Data da ação tratada</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($cadastrados as $row):?>
			<tr class="altrow">
                                <td><?php echo ($row->tipo == 'SA' ? 'Satisfeito' : ($row->tipo == 'IS' ? 'Insatisfeito' : ($row->tipo == 'NE' ? 'Neutro':'Não Manifestou')));?></td>
				<td><?php echo br_date($row->data_acao);?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar_nivel/'.$row->id, 'Editar', NULL);?>
                                        <?php echo anchor($controller.'/excluir_nivel/'.$row->id, 'Excluir', array("onclick"=>"return confima_exclusao('Nível de Satisfação')"));?>
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
        
        <br/>
        
	<div class="baixo">
		<?php echo anchor($controller.'/empresas/', 'Voltar para Empresas', NULL);?>
	</div><!--/baixo -->

</div><!--/tabela -->