<div id="tabela">
<?php //print_r($registros);?>
	<div id="cima">
            <?php if(calcula_inscricoes_restantes($id_inscricoes_empresa)>0):?>
		<div class="adicionar">
			<?php echo anchor($controller.'/adicionar_aluno/'.$id_inscricoes_empresa, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar - Inscrição Aluno <?php //echo $title_sing;?></p>
		</div><!--/adicionar -->
             <?php else:?>
                Todas as vagas foram cadastradas
             <?php endif;?>
                
		<?php //echo form_open($controller.'/buscar', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			<!--<div class="busca">
				<span class="buscar-span">Buscar</span>
				<input type="hidden" name="tipo" id="tipo" value="<?php //echo $tipo;  ?>" />
				<input type="text" name="s" class="busca-input" id="s" value="<?php //echo ( ! isset($_GET['s'])) ? '' : $_GET['s'];?>" />
				<input type="submit" value="Buscar" class="btn-busca" />
			</div>--><!--/busca -->
		<?php //echo form_close();?>

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($registros)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Curso</a></th>
			<th>Nome cliente</th>
                        <th>Cpf cliente</th>
			<th>Status</th>                       
			<th class="actions">Ações</th>
		</tr>
                <?php if(isset($registros)):?>
                    <?php foreach($registros as $row):?>
                            <tr class="altrow">
                                    <td><?php echo ($row->tipo_curso == 'IN' ? $row->titulo_curso : ($row->tipo_curso == 'DE' ? $row->titulo_programa : $row->titulo_programas_alta_performance));?></td>
                                    <td><?php echo $row->inscrito; ?></td>
                                    <td><?php echo $row->cpf_cnpj; ?></td>
                                    <td><?php echo $status[$row->status]; ?></td>                                
                                    <td class="actions">

                                        <?php echo anchor($controller.'/excluir_aluno/'.$row->id.'/'.$id_inscricoes_empresa, 'Excluir', array("onclick"=>"return confima_exclusao(' - Inscrição do Aluno')"));?>

                                    </td>
                            </tr>
                    <?php endforeach;?>
               <?php endif;?>
	</table>

	<div class="baixo">
		<?php if( isset($paginacao)):?>
			<div class="paginacao"><?php echo $paginacao;?></div><!--/paginacao -->
		<?php endif;?>
	</div><!--/baixo -->

	<?php endif; ?>

</div><!--/tabela -->