<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<!--<?php// echo anchor($controller.'/adicionar', img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php //echo $title_sing;?></p>-->
		</div><!--/adicionar -->

		<?php echo form_open($controller.'/buscar', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			<div class="buscaW">
				<span class="buscar-span">Buscar</span>
				<input type="text" name="s" class="busca-input" id="s" value="<?php echo ( ! isset($_GET['s'])) ? '' : $_GET['s'];?>" />
                                <select name="tipo_orcamento"  class="busca-input">
                                    <option value="" selected="selected">Filtrar por Orçamento</option>
                                    <option value="AI">Auditoria Interna</option>
                                    <option value="PB">Orcamento On Line_PBQP-h </option>
                                    <option value="GA">Sistema Gestão Ambiental (ISO14001)</option>
                                    <option value="SQ">Sistema Gestão da Qualidade (ISO9001)</option>
                                    <option value="GS">Sistema Gestão Responsabilidade Social</option>
                                    <option value="SS">Sistema Saúde e Segurança</option>
                                    <option value="TR">Treinamento</option>                                  
                                    
                                </select>
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
			<th class="marcado-th"><a href="#">Nome empresa</a></th>
			<th><a href="#">Lido</a></th>
			<th><a href="#">Email</a></th>
                        <th class="actions">Valor</th>
                        <th class="actions">Tipo</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->nome_empresa;?></td>
				<td><?php echo $row->lido == 'S' ? 'Sim' : 'Não';?></td>
				<td><?php echo $row->email_resposta;?></td>
                                <td><?php echo $row->valor_orcamento>0?'R$ '.$row->valor_orcamento:'-';?></td>
                                <td>
                                    <?php if($row->tipo_orcamento=='AI'):
                                            echo'Auditoria Interna';
                                        elseif($row->tipo_orcamento=='PB'):
                                            echo'Orcamento On Line PBQP-h';
                                        elseif($row->tipo_orcamento=='GA'):
                                            echo 'Sistema Gestão Ambiental ISO 14001';
                                        elseif($row->tipo_orcamento=='SQ'):
                                            echo 'Sistema Gestão da Qualidade ISO 9001';                 
                                       elseif($row->tipo_orcamento=='GS'): 
                                           echo'Sistema Gestão Responsabilidade Social';
                                       elseif($row->tipo_orcamento=='SS'):
                                           echo 'Sistema Saúde e Segurança';
                                       elseif($row->tipo_orcamento=='TR'):                                           
                                           echo'Treinamento';
                                        elseif($row->tipo_orcamento=='OP'):
                                           echo'Orçamento Personalizado';
                                        
                                       endif;
                                     ?>
                                </td>
				<td class="actions">
					<?php echo anchor($controller.'/editar/'.$row->id_orcamento_online, '+ Detalhes', NULL);?>		            
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