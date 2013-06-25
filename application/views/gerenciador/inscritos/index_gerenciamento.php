<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor($controller.'/adicionar_permissoes/'.$id_empresa, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar Permissões</p>
		</div><!--/adicionar -->
                <!--
		<?php //echo form_open($controller.'/buscar', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			<div class="busca">
				<span class="buscar-span">Buscar</span>
				<input type="hidden" name="tipo" id="tipo" value="F" />
				<input type="text" name="s" class="busca-input" id="s" value="<?php //echo ( ! isset($_GET['s'])) ? '' : $_GET['s'];?>" />
				<input type="submit" value="" class="btn-busca" />
			</div>
		<?php //echo form_close();?>-->
                
                <div class="busca">
                    
                    
                </div><br>

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($cadastrados)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><a href="#">Nome</a></th>
			<th><a href="#">E-mail</a></th>
			<th>Ativo</th>
			<th class="actions">Ações</th>
		</tr>
                <?php
                $id=0;                
                ?>
		<?php foreach($cadastrados as $row):?>
                        <?php if($row->id != $id):?>
                            <tr class="altrow">
                                    <td><?php echo $row->nome;?></td>
                                    <td><?php echo $row->email;?></td>
                                    <td><?php echo $row->ativo == 'S' ? 'Sim' : 'Não';?></td>
                                    <td class="actions">
                                            <?php echo anchor($controller.'/editar_permissoes/'.$row->area_permissoes_concedidas_id_empresa.'/'.$row->id, 'Editar Permissões', NULL);?>
                                <?php //echo anchor($controller.'/excluir/'.$row->id, 'Desativar', array("onclick"=>"return confima_exclusao('$title_sing')"));?>
                                    </td>
                            </tr>                           
                        <?php endif;?>
                             <?php 
                            $id=$row->id;
                            ?>
		<?php endforeach;?>
	</table>
<!--/baixo
	<div class="baixo">
		<?php //if( isset($paginacao)):?>            
			<div class="paginacao"><?php //echo $paginacao;?></div>
		<?php //endif;?>
	</div> -->

	<?php endif; ?>

</div><!--/tabela -->