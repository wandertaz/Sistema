<?php 
	include("includes/topo.php"); 
?>
            
            
          <?php include("includes/banner-interna.php"); ?>
           
            <div class="content">
            
            <div class="menuAreaRestrita">
            <h1>Área Restrita</h1>
            
            <!--<ul>
                <li class="selected"><a href="<?php echo site_url();?>area_restrita_meus_cursos">Cursos</a></li>
                <li><a href="<?php echo site_url();?>bancodetalentos">Banco de Talentos</a></li>
                <li><a href="<?php echo site_url();?>">Auto Diagnóstico</a></li>
                <!--<li><a href="<?php echo site_url();?>">Central de Downloads</a></li>
                <li><a href="<?php echo site_url();?>">Gerenciamento de Usuários</a></li>
                <li><a href="<?php echo site_url();?>">Armazenamento na Nuvem</a></li>
            </ul>-->
            
            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
            ?>
            </div>
            <div class="breadcrumb" style="background-color:white;">
                       <ul style="padding:5px 0 5px 0;">
                        <li><a href="<?php echo site_url();?>">Home ></a></li>
                        <li><a href="<?php echo site_url();?>area_restrita_meus_cursos">Área Restrita ></a></li>
                        <li><a href="<?php echo site_url();?>conteudo_curso/programacao">Programação</a></li>
                       </ul>
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
                               <a href="<?php echo site_url();?>conteudo_curso/apostilas_anexos/L">Leituras Complementares</a>
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
                       <li ><span class="mensagem"><?php echo check_mensagens();?></span> <a href="<?php echo site_url();?>area_restrita_mensagem">Mensagens</a></li>
                       <?php endif;?>
                  </ul>
                     
                  </div>	
                </div>
                <div class="centerCursos equalH-meus-cursos">
                 <h1>Cursos</h1>
                 <div class="selecionar-curso">
                    <form id="formulario-curso" name="formulario-curso" action="<?php echo site_url(); ?>conteudo_curso/programacao" method="post">

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
                 <h4><?php echo$cursos[0]['titulo'];?></h4> 
                 <h5>Prof. <?php echo$cursos[0]['instrutor'];?></h5> 

                 <div style="position:relative; top:30px; height:50px;">
                     
                    <div style="float:left;">
                    <p>Data de Aquisição: <?php echo br_date_time($cursos[0]['data_aquisicao']);?></p>
                    <p>Data de Conclusão: <?php echo br_date_time($cursos[0]['data_conclusao']);?></p>
                    </div>

                    <?php if($cursos[0]["tipo_curso"]=='EL'): ?>

                    <div style="float:right;left: -95px; position:relative;">

                    <p style="float:left; top:-2px; left:220px; color:#f7931e;">CONCLUÍDO</p>

                    <div class="progress" style="float:right;">

                    <div class="progressBarFill" style="width:<?php echo(calculo_conclusao_elearning($cursos[0]["curso_id"])>0?calculo_conclusao_elearning($cursos[0]["curso_id"]):'0');?>%"></div>
                    
                    <div class="progressBar"></div>

                    <p class="progressNumero" style="left:27%;"><?php echo(calculo_conclusao_elearning($cursos[0]["curso_id"])>0?calculo_conclusao_elearning($cursos[0]["curso_id"]):'0');?>%</p> <!-- O atributo left a ser passado precisa ser: valor da porcentagem - 5-->
                    
                    </div>
                    
                    <p class="progressUltimoAcesso" style="display:none;">Última atualização: 29 de abril, 2013 às 15:38h</p>

                    </div>
                    <?php endif; ?>

                </div>
                
                <hr>
                <?php endif;?>
                
                
                <?php if (isset($aulas)):?>
                 <h4>Programação</h4>
                <table width="100%" border="0" class="tabelaAreaRestrita">
                  <tr>
                    <td style="border:none;"><h6>Aula</h6></td>
                    <td style="border:none;"><h6>Tópico</h6></td>
                    
                  </tr>
                  
                  <?php foreach ($aulas as $item2):?>
                  <?php  //print_r($aulas);?>
                    <tr>
                      <td class="nomeCurso" width="11%"><?php echo $item2["numero"];?></td>
                      <td><?php echo $item2["titulo"];?>
                                                      
                              
                              <?php if ($item2["codigo_video"]!=''):?>
                                    <span class="topicos" style="display:block;">
                                         
                                        <a href="<?php echo site_url();?>video/index?codigovideo=<?php echo $item2["codigo_video"];?>&aula_id=<?php echo $item2["aula_id"];?>" class="various" data-fancybox-type="iframe" >
                                            <img src="<?php echo base_url();?>assets/img/video-aula-icon.png">&nbsp;Video
                                        </a>
                                    </span>
                              <?php endif;?>
                               
                               <?php if ($item2["arquivo_artigo"]!=''):?>
                                    <span class="topicos" style="display:block;">                                        
                                        <a href="http://multiwebphp.com.br/mb_consultoria/compartilhar_conteudo/download?arquivo=<?php echo $item2["arquivo_artigo"];?>&aula_id=<?php echo $item2["aula_id"];?>">
                                        <img src="<?php echo site_url();?>assets/img/artigos-aula-icon.png">&nbsp;Artigo sobre a aula</span>
                                    </a>
                              <?php endif;?>
                     </td>
                    </tr>
                  <?php endforeach;?>
                  
                </table>
               <?php else:?> 
                  Não temos programação até o momento!
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