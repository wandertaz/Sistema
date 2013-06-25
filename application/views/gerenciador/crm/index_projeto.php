<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor('multitools/crm/adicionar_projeto/'.$id_empresa, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo Projeto")'));?>
			<p>Adicionar <?php echo 'Projeto';?></p>
		</div>

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>
        
	<?php if(!count($cadastrados)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Nome do projeto</a></th>
                        <th>Nº da proposta</a></th>
                        <th>Tipo</a></th>
			<th>Consultor responsável</a></th>
			<th>Status</th>
			<th class="actions">Ações</th>
		</tr>
                
		<?php foreach($cadastrados as $row):?>
                    
			<tr class="altrow">
				<td><?php echo $row->nome;?></td>
                                <td><?php echo $row->n_proposta;?></td>
                                <td><?php echo ($row->tipo == 'GP' ? 'Gestão de Pessoas' : ($row->tipo == 'GC' ? 'Governança Corporativa' : ($row->tipo == 'PR' ? 'Processos': ($row->tipo == 'ES' ? 'Estratégia':'Educação Corporativa'))));?></td>
				<td><?php if ( isset($usuarios[$row->id_usuario_consultor_responsavel])) echo $usuarios[$row->id_usuario_consultor_responsavel];?></td>
				<td><?php echo ($row->status == 'A' ? 'Em andamento' : ($row->status == 'P' ? 'Paralisado' : 'Finalizado'));?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar_projeto/'.$row->idprojeto_empresa, 'Editar', NULL);?>
                                        <?php echo anchor($controller.'/excluir_projeto/'.$row->idprojeto_empresa, 'Excluir', array("onclick"=>"return confima_exclusao('Projeto')"));?>
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