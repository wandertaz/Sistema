<div id="tabela">

	<div id="cima">

		<div class="adicionar">
                    <?php if(count($registros)>0): ?>
                        <p><b>Lista de E-mails Enviados</b></p><br>
                    <?php else: ?>
			<?php echo anchor('multitools/mailing/adicionar_emails/'.$id_mailing, img('assets/imagens/multitools/botao_adicionar.png', 'array("alt"=>"Novo ".$title_sing)'));?>
			<p>Adicionar <?php echo 'E-mails';?></p>
                    <?php endif; ?>
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
            

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($registros)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>			
                        <th>Nome</th>
                        <th>Empresa</th>
                        <th>Cargo</th>
                        <th>Área</th> 
			<th>E-mail</th>
			<th>Contato Principal</th>
                        <th>Data Inserção</th>   
	
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				
                                <td><?php echo $row->forma_de_tratamento.' '.$row->nome;?></td>
                                <td><?php echo $row->empresa;?></td>
                                <td><?php echo $row->cargo;?></td>
                                <td><?php echo $row->area;?></td>
                                <td><?php echo $row->email;?></td>
                                <td><?php echo $row->contato_principal == 'S'?'Sim':'Não';?></td>
                                <td><?php echo br_date($row->created);?></td>                                 
				
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
		<?php echo anchor($controller.'/mailing/', 'Voltar para Mailling', NULL);?>
	</div><!--/baixo -->

</div><!--/tabela -->