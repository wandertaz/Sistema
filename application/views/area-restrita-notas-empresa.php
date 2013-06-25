<?php 
	include("includes/topo.php"); 
?>
            
            
          <?php include("includes/banner-interna.php"); ?>
           
            <div class="content">
            
            <div class="menuAreaRestrita">
            <h1>Área Restrita</h1>
           <!-- <ul>
            	<li class="selected"><a href="">Cursos</a></li>
                <!--<li><a href="#">Banco de Talentos</a></li>
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
                       <li ><a href="<?php echo site_url();?>gerenciarinscritos">Gerenciar Inscritos</a></li>
                        <?php if($this->session->userdata('SessionTipoPessoa')=='J'):?>
                            <li ><a href="<?php echo site_url();?>gerenciar_permissoes">Gerenciar Permissões</a></li>
                        <?php endif;?>
                       <li class="selected" ><a href="<?php echo site_url();?>area_restrita_notas_empresa">Notas e Frequência</a></li> 
                       <li><a href="<?php echo site_url();?>area_restrita_meus_cursos_empresa">Nossos Cursos</a></li>
                     </ul>
                     
                  </div>	
                </div>
                <div class="centerCursos equalH-meus-cursos">
               
                 <h1>Nossos Cursos</h1>
                 <div class="selecionar-curso">
                    <form id="formulario-curso" name="formulario-curso" action="<?php echo site_url(); ?>area_restrita_notas_empresa" method="post">

                    <select name="curso_selected">
                            <option value="" selected="selected">Selecione</option>
                             <?php foreach ($listaNova as $item):?>
                               
                            <option <?php if ($item["selected"]==1) echo'selected="selected"'; ?> value="<?php echo $item["id_inscricao"];?>"><?php echo $item["titulo"];?></option>
                                
                            <?php endforeach;?>
                    </select>
                    <input type="submit" name="enviar" id="enviar" class="buttonBuscarCurso" style="margin-top:4px; cursor:pointer;">
                    </form>
                 </div>


                 
               <?php if (isset($cursos)): ?>
              <?php //foreach ($cursos as $item):
    // print_r($cursos);
    // exit();
                  
                  ?> 
                 <h4><?php echo $cursos["titulo"];?></h4>
                 <h5>Prof. <?php echo $cursos["instrutor"];?></h5>
                 
                 <div style="position:relative; top:30px; height:50px;">	
                    <div style="float:left;">
                    <p>Data de Aquisição:  <?php echo br_date_time($cursos["data_aquisicao"]);?></p>
                    <p>Data de Conclusão: <?php echo br_date_time($cursos["data_conclusao"]);?></p>
                    </div>
                   
                 	<div style="float:right; top:-40px; position:relative;">
      
                    </div> 
                </div>
                
                <hr>
                 <?php //endforeach;?> 
                 <?php if (isset($inscritos_notas)): ?>
                <h4>Notas e Frequências</h4>
                
                <table width="100%" border="0" class="tabelaAreaRestrita">
                  <tr>
                    <td style="border:none;"><h6>Nome</h6></td>
                    <td style="border:none;"><h6>email</h6></td>
                    <td style="border:none;"><h6><center>Nota</center></h6></td>
                    <td style="border:none;"><h6><center>Faltas</center></h6></td>
                  </tr>
                   <?php foreach ($inscritos_notas as $item):?> 
                  <tr>
                    <td class="nomeCurso" width="40%"><?php echo $item["nome"];?></td>
                    <td class="nomeCurso" width="40%"><?php echo $item["email"];?></td>
                    <td><center><b><?php echo $item["nota"];?></b> em <?php echo $item["valor"];?></center></td>
                    
                    <td><center><?php echo $item["faltas"];?></center></td>
                    
                   
                  </tr>
                  <?php endforeach;?>
                  
                </table>
                <?php else:?>
                    Cadastre um aluno
                <?php endif;?>
                </div>                  
               <?php endif; ?> 
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