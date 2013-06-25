<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<?php echo anchor('multitools/inscritos/adicionar/J', img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo 'Empresa';?></p>
		</div>
            
            <style>
             input[type="text"],select.busca-input-2  {                 
                   width:14%; 
                   margin:10px 0px 0px 10px;                     
                   display: inline-block;
                   float: none !important;
                    
                }
                
                .busca2{
                    width:100%;
                    text-align: left;             
              
                    
                }
                
            </style>
            

            <div class="busca2" >
                <span class="buscar-span" >Buscar</span>	
		<?php echo form_open($controller.'/buscar', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			
				
                               
                                <?php echo form_input(array('name'=>'s','id'=>'s','value'=>( ! isset($_GET['s'])) ? '' : $_GET['s'],'class'=>'busca-input-2')) ;?>                          
                                
                              
                                <?php echo form_dropdown("segmento_empresa", array('' => 'Segmento Empresa','Indústria' => 'Indústria', 'Comércio' => 'Comércio','Serviços'=>'Serviços','Construção Civil'=>'Construção Civil','Gestão Pública'=>'Gestão Pública'),( ! isset($_GET['segmento_empresa'])) ? '' : $_GET['segmento_empresa'], "id=\"segmento_empresa\" class=\"busca-input-2\" "); ?>
                               
                                
                                <?php echo form_dropdown("atuacao_empresa",$ramo_atividade,( ! isset($_GET['atuacao_empresa'])) ? '' : $_GET['atuacao_empresa'], "id=\"atuacao_empresa\" class=\"busca-input-2\" "); ?>
                             
                                <?php echo form_dropdown("cidade",$cidades ,( ! isset($_GET['cidade'])) ? '' : $_GET['cidade'], "id=\"cidade\" class=\"busca-input-2\" "); ?>
                                <?php echo form_dropdown("categoria", array('' => 'Categoria','C'=>'Cliente','P'=>'Prospect'),( ! isset($_GET['categoria'])) ? '' : $_GET['categoria'], "id=\"categoria\" class=\"busca-input-2\" "); ?>
                                <?php echo form_dropdown("id_usuario_consultor_responsavel",$usuario,( ! isset($_GET['id_usuario_consultor_responsavel'])) ? '' : $_GET['id_usuario_consultor_responsavel'], "id=\"id_usuario_consultor_responsavel\" class=\"busca-input-2\" "); ?>
                                <?php echo form_dropdown("tipo", array('' => 'Tipo do projeto','GP'=>'Gestão Pessoas','GC'=>'Gov Corporativa','Pr'=>'Processos','ES'=>'Estrategia','EC'=>'Educ Corporativa'),( ! isset($_GET['tipo'])) ? '' : $_GET['tipo'], "id=\"tipo\" class=\"busca-input-2\" "); ?>
                                <?php echo form_dropdown("classificao", array('' => 'Classificação','A'=>'A','B'=>'B','C'=>'C'),( ! isset($_GET['classificao'])) ? '' : $_GET['classificao'], "id=\"classificao\" class=\"busca-input-2\" "); ?>
				<input type="submit" value="Buscar" class="btn-busca" />
			
		<?php echo form_close();?>

	</div>

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($registros)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			
                        <th>Nome Fantasia</a></th>
                        <th>Cidade</a></th>
                        <th>Telefone</a></th>
                        <th>Contato Principal</a></th>
                        <th>Cargo do Contato Principal</a></th>
			<th>E-mail do Contato Principal</a></th>
			<th>Status</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				
                                <td><?php echo $row->nome;?></td>
                                <td><?php echo $row->cidade;?></td>
                                 <td><?php echo $row->telefone_geral;?></td>
                                 <td><?php echo $row->nome_gestor;?></td>
                                 <td><?php echo $row->profissao;?></td>
				<td><?php echo $row->email;?></td>
				<td><?php echo $row->ativo == 'S' ? 'Ativo' : 'Inativo';?></td>
				<td class="actions">
                                        <?php echo anchor($controller.'/gerenciamento_contatos/'.$row->id, 'Contatos', NULL);?>
					<?php echo anchor($controller.'/proposta/'.$row->id, 'Propostas', NULL);?>
					<?php echo anchor($controller.'/projeto/'.$row->id, 'Projetos', NULL);?>
					<?php echo anchor($controller.'/nivel/'.$row->id, 'Nivel de Satisfação', NULL);?>
					<?php echo anchor($controller.'/acao/'.$row->id, 'Ação de Prospecção', NULL);?>
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

</div><!--/tabela -->