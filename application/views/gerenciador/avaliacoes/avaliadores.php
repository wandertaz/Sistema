<div id="tabela">

	<div id="cima">

		<!--<div class="adicionar">
			<?php echo anchor($controller.'/adicionar/'.$tipo, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo $title_sing;?></p>
		</div>/adicionar -->

		<?php echo form_open($controller.'/buscar', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			<div class="busca">
				<span class="buscar-span">Buscar</span>
				<input type="hidden" name="tipo" id="tipo" value="<?php echo $tipo;  ?>" />
                                <input type="hidden" name="curso_id" id="tipo" value="<?php echo $curso_id;  ?>" />
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
			<th>Inscrito</th>
			<th>Observação</th>
			<th class="actions">Ações</th>
		</tr>
		<?php 
                    $codigo=0;
                   
                    foreach($registros as $row):     
                        
                 ?>
                        <?php if($row->inscrito_id !=$codigo):?>
			<tr class="altrow">
				
				<td><?php echo $row->inscrito; ?></td>
				<td>Clique em "ver Avaliação" e veja a avaliação por usuário</td>
				<td class="actions">
			<?php echo anchor($controller.'/ver_avaliacao/'.$row->tipo_curso.'/'.$row->curso_id.'/'.$row->inscrito_id, 'Ver Avaliação', NULL);?>
		            <?php //echo anchor($controller.'/excluir/'.$row->id, 'Excluir', array("onclick"=>"return confima_exclusao('$title_sing')"));?>
				</td>
			</tr>
                        <?php endif;?>
                        <?php $codigo= $row->inscrito_id;?>
		<?php endforeach;?>
	</table>

	<div class="baixo">
		<?php if( isset($paginacao)):?>
			<div class="paginacao"><?php echo $paginacao;?></div><!--/paginacao -->
		<?php endif;?>
	</div><!--/baixo -->

	<?php endif; ?>

</div><!--/tabela -->