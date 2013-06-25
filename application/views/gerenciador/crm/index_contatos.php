<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor($controller.'/adicionar_contatos/'.$id_empresa, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar Contato</p>
		</div><!--/adicionar -->

                
                <div class="busca">
                    
                    
                </div><br>

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($cadastrados)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Nome</a></th>
                        <th>Cpf</a></th>
			<th>E-mail</a></th>
			<th>Contato Principal</th>
			<th class="actions">Ações</th>
		</tr>
                <?php
                $id=0;                
                ?>
		<?php foreach($cadastrados as $row):?>
                        
                            <tr class="altrow">
                                    <td><?php echo $row->forma_de_tratamento.' '.$row->nome;?></td>
                                    <td><?php echo $row->cpf;?></td>
                                    <td><?php echo $row->email;?></td>
                                    <td><?php echo $row->contato_principal == 'S' ? 'Sim' :'Não';?></td>
                                    <td class="actions">
                                        <?php echo anchor($controller.'/editar_contato/'.$row->idcontato_empresa, 'Editar', NULL);?>
                                        <?php echo anchor($controller.'/excluir_contato/'.$row->idcontato_empresa, 'Excluir', array("onclick"=>"return confima_exclusao('$title_sing')"));?>
                                        <?php echo anchor($controller.'/brindes/'.$row->idcontato_empresa, 'Brindes', NULL);?>
                                    </td>
                            </tr>                           
                       
          
		<?php endforeach;?>
	</table>
<!--/baixo
	<div class="baixo">
		<?php //if( isset($paginacao)):?>            
			<div class="paginacao"><?php //echo $paginacao;?></div>
		<?php //endif;?>
	</div> -->

	<?php endif; ?>
        
        <br/>
        
	<div class="baixo">
		<?php echo anchor($controller.'/empresas/', 'Voltar para Empresas', NULL);?>
	</div><!--/baixo -->

</div><!--/tabela -->