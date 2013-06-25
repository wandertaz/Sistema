<?php 
	include("includes/topo.php"); 
?>
            
            
          <?php include("includes/banner-interna.php"); ?>
           
            <div class="content">
            
            <div class="menuAreaRestrita">
            <h1>Área Restrita</h1>
            <!--<ul>
            	<li class="selected"><a href="">Cursos</a></li>
                <li><a href="#">Banco de Talentos</a></li>
                <li><a href="#">Auto Diagnóstico</a></li>
                <li><a href="#">Central de Downloads</a></li>
                <li><a href="#">Gerenciamento de Usuários</a></li>
                <li><a href="#">Armazenamento na Nuvem</a></li>
            </ul>-->
            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
            ?>
            </div>
            
              <div class="content-interna" style="width:780px; background:white;">
             
                <div class="left-cursos equalH-meus-cursos">
                  <div class="miolo-interna">
                 
                  	
                     <ul class="lista-meus-cursos">
                         <li><a href="">Conteúdo</a>
                           <span>
                               <a href="<?php echo site_url();?>conteudo_curso_empresa/programacao">Programação</a>
                           </span>
          
                       </li>
                       <li class="selected"><a href="<?php echo site_url();?>gerenciarinscritos">Gerenciar Inscritos</a></li>
                         <?php if($this->session->userdata('SessionTipoPessoa')=='J'):?>
                            <li ><a href="<?php echo site_url();?>gerenciar_permissoes">Gerenciar Permissões</a></li>
                        <?php endif;?>
                       <li><a href="<?php echo site_url();?>area_restrita_notas_empresa">Notas e Frequência</a></li> 
                       <li ><a href="<?php echo site_url();?>area_restrita_meus_cursos_empresa">Nossos Cursos</a></li>
                     </ul>
                     
                  </div>	
                </div>
                <div class="centerCursos equalH-meus-cursos">
               
                 <h1>Cadastro Permissões</h1>
              <!-- <div class="selecionar-curso">
    
                 </div>-->


                 
           
                 
                <h4>Nivéis de Acesso</h4>
                
       
                 <div style="position: absolute;width: 565px;margin-top: -38px;">
                   
                 </div>
               <form style="margin-bottom: 20px;" action="<?php echo site_url();?>gerenciar_permissoes/buscarcadastrados" name="busca" method="post">
                <div>
                    <label style="margin-right:5px;" for="nome_busca"><span style="color:#F7931E;margin-right:10px;">Nome:</span><input type="text" name="nome" id="nome_busca"></label>
                    <label for="email_busca"><span style="color:#F7931E;margin-right:10px;">E-mail:</span><input type="text" name="email" id="email_busca"></label>
                    <input style="border: 0;color: #333;background: #F7931E;padding: 2px 8px;margin-left: 9px;" type="submit" value="Buscar" name="Buscar"><br>
                </div>
                </form>
                <?php if (isset($permissoes_nao_cadastradas)): ?>
                
                
                <table width="100%" border="0" class="tabelaAreaRestrita">
                  <tr>
                    <td style="border:none;"><h6>Nome</h6></td>                      
                    <td style="border:none;"><h6>Email</h6></td>  
                    <td style="border:none;"><h6>Cpf</h6></td>
                    <td style="border:none;"><h6>Alterar/Excluir</h6></td>
                   
                  </tr>
                   <?php foreach ($permissoes_nao_cadastradas as $item):?> 
                  <tr>
                    <td class="nomeCurso" width="40%"><?php echo $item["nome"];?></td>                  
                    <td width="40%"><center><?php echo $item["email"]!=''?$item["email"]:'-';?></center></td>
                    <td ><center><?php echo $item["cpfcnpj"]!=''?$item["cpfcnpj"]:'-';?></center></td>
          
                     <td><center>
                        <a style="color:#f8931f;text-decoration:none;" href="<?php echo site_url();?>gerenciar_permissoes/exibiropcoes/<?php echo $item["inscrito_id"];?>">
                            <img src="<?php echo base_url(); ?>assets/img/add_inscrito.png" alt="Adicionar Inscritos">
                        </a>
                    </center></td>
                   
                  </tr>
                  <?php endforeach;?>
                  
                </table>
               <form style="margin-bottom: 20px;" action="<?php echo site_url();?>gerenciar_permissoes/salvaraluno" name="busca" method="post">
                   <input type="hidden" name="id_usuario" value="<?php echo $item['inscrito_id']?>">
                 <?php 
                    $x=1;
                    foreach ($areas_cadastradas as $item):
                 ?>          
                    
                
                
                        <?php if($x==1 ||$x==($item['media']+1)):?>   
                          <div class="col">
                       <?php endif;?> 
                              <label for="nivelatuacao" class="inpt_checkbox">
                                  <input type="checkbox" name="nivel_acesso_<?php echo $item['area_permissoes_id'] ;?>" <?php echo $item['area_permissoes_concedidas_id']>0?'checked':'' ;?> value="<?php echo $item['area_permissoes_id'] ;?>">
                                  <span><?php echo $item['nome_area_permissoes'] ;?></span></label>               
                       <?php if($x==$item['media'] || $x==($item['media']*2)):?>  
                       </div>
                       <?php endif;?> 
                
                
                
                
                
                
                
                 <?php endforeach;?>
                   <input type="submit" name="Enviar" value="Atualizar">
                   </form>
                <?php else:?>
                <p style="color: #F7931E;margin-top: 44px;display: block;clear: both;overflow: hidden;font-size: 13px;text-align: center;"> Se o usuário não estiver cadastrado.<br /> <a style="color:#F7931E;font-weight:bold;" class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>gerenciarinscritos/novocadastro_inscrito">CLIQUE AQUI</a> se deseja adicionar um novo usuário.</p>
                <?php endif;?>
                </div>                  
              
              </div>
              <div class="rightMeusCursos">
		<?php 
                       /* if (validarelerning($this->session->userdata('SessionCurso'))==true):
                            include("includes/coluna-direita-area-restrita.php");
                        endif;*/
                 ?>
                	
              </div>
				
				
				
				
				
            </div>

<?php 
	include("includes/rodape.php"); 
?>
