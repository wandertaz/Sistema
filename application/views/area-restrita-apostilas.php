<?php 
	include("includes/topo.php"); 
?>
            
            
          <?php include("includes/banner-interna.php"); ?>
           
            <div class="content">
            
            <div class="menuAreaRestrita">
            <h1>Área Restrita</h1>
           <!-- <ul>
            	<li class="selected"><a href="#">Cursos</a></li>
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
                       <li class="selected"><a href="#">Conteúdo</a>
                           <span>
                               <a href="<?php echo site_url();?>conteudo_curso/programacao">Programação</a>
                           </span>
                           <span>
                               <a href="<?php echo site_url();?>conteudo_curso/apostilas_anexos/A">Apostila e anexos</a></span>
                           <span>
                               <a href="<?php echo site_url();?>conteudo_curso/apostilas_anexos/L">Leituras Complementares
                           </span>
                           <?php if (validarelerning($this->session->userdata('SessionCurso'))==true):?>
                           <span class="mensagem"><?php echo check_exercicios();?></span> <span><a href="<?php echo site_url();?>conteudo_curso/exercicios">Exercícios</a></span>
                           <?php endif;?>
                       </li>
                       <li ><a href="<?php echo site_url();?>area_restrita_notas">Notas e Frequência</a></li>
                       <li><a href="<?php echo site_url();?>avaliacao_do_curso">Avaliação do Curso</a></li>
                       <li><a href="<?php echo site_url();?>area_restrita_meus_cursos">Meus Cursos</a></li>
                       <li><a href="<?php echo site_url();?>certificado">Certificado</a><span>Emissão do Certificado</span></li>
                       <?php if (validarelerning($this->session->userdata('SessionCurso'))==true):?>
                       <li>
                           <span class="mensagem"><?php echo check_mensagens();?></span>
                           <a href="<?php echo site_url();?>area_restrita_mensagem">Mensagens</a>
                       </li>
                       <?php endif;?>
                </ul>
                     
                  </div>	
                </div>
                <div class="centerCursos equalH-meus-cursos">
                 <h1>Cursos</h1>
                 <div class="selecionar-curso">
                     <form id="formulario-curso" name="formulario-curso" action="<?php echo base_url();?>conteudo_curso/apostilas_anexos/<?php echo$cursos_lista[0]['tipo_arquivo'];?>" method="post">
                    <select name="curso_selected">
                            <option value="" selected="selected">Selecione</option>
                             <?php foreach ($listaNova as $item):?>
                               
                            <option <?php if ($item["selected"]==1) echo'selected="selected"'; ?> value="<?php echo $item["id_inscricao"];?>"><?php echo $item["titulo"];?></option>
                                
                            <?php endforeach;?>
                    </select>
                    <input type="submit" name="enviar" id="enviar" class="buttonBuscarCurso" style="margin-top:4px; cursor:pointer;">
                  </form>
                 </div>
                  <?php if (isset($cursos)):?>
                 <h4><?php echo $cursos[0]['titulo'];?></h4>
                 <h5>Prof. <?php echo $cursos[0]['instrutor'];?></h5>
                 
                 <div style="position:relative; top:30px; height:50px;">	
                    <div style="float:left;">
                        <p>Data de Aquisição: <?php echo br_date_time($cursos[0]['data_aquisicao']);?></p>
                    <p>Data de Conclusão: <?php echo br_date_time($cursos[0]['data_conclusao']);?></p>
                    </div>
                    
                 	<div style="float:right; top:-40px; position:relative;">
                    	<?php if (validarelerning($this->session->userdata('SessionCurso'))==true):?>
                        <p style="float:left; top:-2px; left:220px; color:#f7931e;">CONCLUÍDO</p>                        
                                            
                        
                        <div class="progress" style="float:right;">
                            <div class="progressBarFill" style="width:<?php echo(calculo_conclusao_elearning($cursos[0]["curso_id"])>0?calculo_conclusao_elearning($cursos[0]["curso_id"]):'0');?>%"></div>
                            <div class="progressBar"></div>
                            <p class="progressNumero" style="left:27%;"><?php echo(calculo_conclusao_elearning($cursos[0]["curso_id"])>0?calculo_conclusao_elearning($cursos[0]["curso_id"]):'0');?>%</p> <!-- O atributo left a ser passado precisa ser: valor da porcentagem - 5-->
                        </div>
                        <p class="progressUltimoAcesso" style="display:none;">Última atualização: 29 de abril, 2013 às 15:38h</p>
                        <?php endif; ?>
                    </div> 
                </div>
                  <?php endif;?>
                 
                <?php if (isset($apostilas)):?>
                 
                <hr>
                               
                <?php if($apostilas[0]['tipo_arquivo']=='L'): ?>
                    <h4>Leituras Complementares</h4>
                 <?php elseif($apostilas[0]['tipo_arquivo']=='A'): ?>
                    <h4>Apostilas e Anexos</h4>
                <?php endif;?>
                
                <table width="100%" border="0" class="tabelaAreaRestrita">
                  <tr>
                    <td style="border:none;"><h6>Aula</h6></td>
                    <td style="border:none;"><h6><center>Nome Aula</center></h6></td>
                    <td style="border:none;"><h6><center>Nome Arquivo</center></h6></td>
                    <td style="border:none;"><h6><center>Download</center></h6></td>
                   <!-- <td style="border:none;"><h6><center>Imprimir</center></h6></td>-->
                  </tr>
                  
                  <?php foreach ($apostilas as $item):?>
                  
                  
                  <tr>
                    <td class="nomeCurso" width="10%"><?php echo $item['numero'];?></td>
                    <td><center><?php echo $item['titulo_aula'];?></center></td>
                    <td><center><?php echo $item['titulo'];?></center></td>
                    <td>
                        <center>
                            <?php if($item['arquivo']):?>
                                <a href="<?php  echo base_url().'compartilhar_conteudo/download?arquivo='.$item['arquivo'].'&aula_id='.$item['id'];?>">
                             <?php else:?>
                                    <a href="#">
                             <?php endif;?>   
                                <img src="<?php echo base_url();?>assets/img/icon-download-apostila.gif">
                            </a>
                        </center>
                    </td>
                    <td>
                    <center>
                       <!-- <a  href="<?php  //echo base_url().'compartilhar_conteudo/imprimir?arquivo='.$item['arquivo'].'&aula_id='.$item['id'];?>">
                        <img src="<?php //echo base_url();?>assets/img/icon-print-apostila.gif"></a>-->
                       
                       </center></td>
                  </tr>
                  <?php endforeach;?>
                </table>

                <?php endif;?>
                
                <?php if (isset($apostilas)==false):?>
                              <br><br>
                            <div class="sem-conteudo">
                                
                                    Não foi encontrado conteúdo até o momento!                                
                                 
                            </div>
                        
                    <?php endif;?>
                
                
                
                </div>
                
              </div>
              
                        <div class="rightMeusCursos">&nbsp;
                	<?php 
                        if (validarelerning($this->session->userdata('SessionCurso'))==true):
                            include("includes/coluna-direita-area-restrita.php");
                        endif;
                        ?>
                        </div>
              
            </div>

<?php 
	include("includes/rodape.php"); 
?>