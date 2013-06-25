 <?php print_r( retorno_permissoes(2));?>

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
                         
                          <?php if($this->session->userdata('SessionTipoPessoa')=='J'):?>  
                         <li><a href="<?php echo site_url();?>meucadastro/index/J">Meu Cadastro</a> <span>Atualizar</span> </li>
                       <?php endif;?>
                         <!--<li><a href="">Conteúdo</a>
                           <span>
                               <a href="<?php echo site_url();?>conteudo_curso_empresa/programacao">Programação</a>
                           </span>
          
                       </li>-->
                       <!--<li class="selected"><a href="<?php echo site_url();?>gerenciarinscritos">Gerenciar Inscritos</a></li>-->
                         <?php if($this->session->userdata('SessionTipoPessoa')=='J'):?>
                            <li class="selected" ><a href="<?php echo site_url();?>gerenciar_permissoes">Gerenciar Permissões</a></li>
                        <?php endif;?>
                       <!--<li><a href="<?php echo site_url();?>area_restrita_notas_empresa">Notas e Frequência</a></li> -->
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
                   
                     <a style="float: right;border:0; text-decoration:none;" href="<?php echo site_url();?>gerenciar_permissoes/buscarcadastrados">
                      <img style="border:0; text-decoration:none;" src="<?php echo base_url(); ?>assets/img/add_new_inscrito.png" alt="Adicionar Novo" />
                      
                    </a>
                     
                     
                 </div>
                
               <!-- <form style="margin-bottom: 20px;" action="<?php echo site_url();?>gerenciarinscritos/buscarcadastrados" name="busca" method="post">
                <div>
                    <label style="margin-right:5px;" for="nome_busca"><span style="color:#F7931E;margin-right:10px;">Nome:</span><input type="text" name="nome" id="nome_busca"></label>
                    <label for="email_busca"><span style="color:#F7931E;margin-right:10px;">E-mail:</span><input type="text" name="email" id="email_busca"></label>
                    <input style="border: 0;color: #333;background: #F7931E;padding: 2px 8px;margin-left: 9px;" type="submit" value="Buscar" name="Buscar"><br>
                </div>
                </form>  -->
                
                <?php echo isset($msg['msg'])? $msg['msg']:'';?>
                <?php if (isset($permissoes_aceitas)): ?>
                
                
                <table width="100%" border="0" class="tabelaAreaRestrita">
                  <tr>
                    <td style="border:none;"><h6>Nome</h6></td>                   
                    <td style="border:none;"><h6>Cpf</h6></td>
                    <td style="border:none;"><h6>Permissões</h6></td>                   
                    <td style="border:none;"><h6>Alterar/Excluir</h6></td>
                    <!--<td style="border:none;"><h6><center>Nota</center></h6></td>
                    <td style="border:none;"><h6><center>Faltas</center></h6></td>-->
                  </tr>
                    <?php $id_old =0;?>
                   <?php foreach ($permissoes_aceitas as $item):?> 
                    <?php if($item["inscrito_id"]!=$id_old): ?>
                  <tr>
                    <td class="nomeCurso" width="40%"><?php echo $item["nome"];?></td>                  
                    <td width="20%"><center><?php echo $item["cpfcnpj"]!=''?$item["cpfcnpj"]:'-';?></center></td>
                    <td><center>
                        <?php echo retorno_permissoes($item["inscrito_id"]);?>
                       <!-- <a style="color:#f8931f;text-decoration:none;" href="<?php echo site_url();?>gerenciarinscritos/salvaraluno/<?php echo $item["inscrito_id"];?>">
                            <img src="<?php echo base_url(); ?>assets/img/add_inscrito.png" alt="Adicionar Inscritos">
                        </a>-->
                    </center></td>
          
                     <td><center>
                        <a style="color:#f8931f;text-decoration:none;" href="<?php echo site_url();?>gerenciar_permissoes/exibiropcoes/<?php echo $item["inscrito_id"];?>">
                            <img src="<?php echo base_url(); ?>assets/img/add_inscrito.png" alt="Adicionar Inscritos">
                        </a>
                    </center></td>
                   
                  </tr>
                  <?php endif;?>
                 <?php $id_old =$item["inscrito_id"];?>
                  <?php endforeach;?>
                  
                </table>
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
