<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>
<div id="tabela">
        
        
        <script type="text/javascript">
	$(document).ready(function(){						
	
            $("#todos").click(function(){

                       if (!$("#todos").is(":checked")){                            
                            $('input[type="checkbox"]').attr("checked",false);
                      }
                      else{
                         $('input[type="checkbox"]').attr("checked",true);
                      }             
            });
            
            $('input[type="submit"]').click(function(){

                     if (!$('input[type="checkbox"]').is(":checked")){
                             //alert($('input[type="checkbox"]').is(':checked'));
                             return false;
                     }
                    
            });
        });
</script>

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($registros)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>
         <?php echo form_open($controller.'/salvar_email', array('id' => 'Form', 'method' => 'post'));?> 
                <input type="hidden" value="<?php echo $id_mailing;?>" name="id_mailing">
	<table cellpadding="0" cellspacing="0">
		<tr>
                    <th><input type="checkbox" value="1" checked="checked" id="todos"> </th>                        
                        <th>Nome</th>
                        <th>Empresa</th>
                        <th>Cargo</th>
                        <th>Área</th> 
			<th>E-mail</th>
			<th>Contato Principal</th>
			
		</tr>
                <?php
                $id=0;                
                ?>
		<?php foreach($registros as $row):?>
                        
                            <tr class="altrow">
                                    <th><input name="contato_empresa_idcontato_empresa[]" type="checkbox" value="<?php echo $row->idcontato_empresa;?>" checked="checked" class="required"> </th>
                                    <td><?php echo $row->forma_de_tratamento.' '.$row->nome;?></td>
                                    <td><?php echo $row->razao_social;?></td>
                                    <td><?php echo $row->cargo;?></td>
                                    <td><?php echo $row->area;?></td>
                                    <td><?php echo $row->email;?></td>
                                    <td><?php echo $row->contato_principal == 'S'?'Sim':'Não';?></td>
                                   
                            </tr>                           
                       
          
		<?php endforeach;?>
	
                    <div class="submit">                
                        <input type="submit" value="Salvar"  />
                    </div>
                            <tr>
                                <td colspan="5" style="border-color:white;background:white;" >
                                    <div class="submit">                
                                        <input type="submit" value="Salvar"/>
                                    </div>
                                </td>
                            </tr>
          </table>
         <?php echo form_close();?>
	<?php endif; ?>
        
        <br/>
        
	<div class="baixo">
		<?php echo anchor($controller.'/adicionar_emails/'.$_GET['id_mailing'], 'Fazer Nova Busca', NULL);?>
	</div><!--/baixo -->

</div><!--/tabela -->