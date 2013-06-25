<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor($controller.'/adicionar/'.$pesquisas_id_pesquisas, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo $title_sing;?></p>
		</div><!--/adicionar -->

		<div class="adicionar">
			<?php echo anchor($controller.'/importacao/'.$pesquisas_id_pesquisas, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Importar Base de Dados</p>
		</div><!--/adicionar -->
                
		<?php if($pesquisa->ativo == 'S' && $pesquisa->status == 'AP'): ?>
        <div class="adicionar">
			<?php echo anchor($controller.'/atualizar_mail_chimp/'.$pesquisas_id_pesquisas, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Enviar Pesquisa</p>
		</div><!--/adicionar -->
                
        <?php endif; ?>       

		<?php echo form_open($controller.'/buscar', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			<div class="busca">
				<span class="buscar-span">Buscar</span>
				<input type="hidden" name="pesquisa_id" id="pesquisa_id" value="<?php echo $pesquisas_id_pesquisas;  ?>" />
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
			<th><a href="#">Empresa</a></th>
			<th>E-mail</th>
			<th>Telefone</th>
			<th>Cargo/Área</th>
			<th>Enviado?</th>
			<th>Respondido?</th>
			<th>Ativo?</th>
			<th>Respostas</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->nome;?></td>
				<td><?php echo $row->empresa;?></td>
				<td><?php echo $row->email;?></td>
				<td><?php echo $row->telefone;?></td>
				<td><?php echo $row->cargo;?></td>
				<td><?php echo $row->enviado == 'S' ? 'Sim' : 'Não';?></td>
				<td><?php echo $row->respondido == 'S' ? 'Sim' : 'Não';?></td>
				<td><?php echo $row->ativo == 'S' ? 'Sim' : 'Não';?></td>
				<td><?php echo $row->respondido == 'S' ? anchor(site_url().'multitools/pesquisas/questionario/'.$row->pesquisas_id_pesquisas.'/ver_respostas/'.$row->id_pesquisas_contatos, 'Viasualizar Respostas', NULL) : anchor(site_url().'multitools/pesquisas/questionario/'.$row->pesquisas_id_pesquisas, 'Responder', NULL);?></td>
				<td class="actions">
					<?php echo anchor($controller.'/editar/'.$row->id_pesquisas_contatos, 'Editar', NULL);?>
		            <?php echo anchor($controller.'/excluir/'.$row->id_pesquisas_contatos, 'Desativar', array("onclick"=>"return confima_exclusao('$title_sing')"));?>
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

	<div class="baixo">
		<a href="<?php echo site_url('multitools/pesquisas'); ?>">Voltar para Pesquisas</a>
	</div><!--/baixo -->

</div><!--/tabela -->