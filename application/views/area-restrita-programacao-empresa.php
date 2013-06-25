
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
            </ul>-->
             <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
            ?>
            </div>
            <div class="breadcrumb" style="background-color:white;">
                       <ul style="padding:5px 0 5px 0;">
                        <li><a href="<? echo site_url();?>">Home ></a></li>
                        <li><a href="<? echo site_url();?>area_restrita_meus_cursos_empresa">Área Restrita ></a></li>
                        <li><a href="<? echo site_url();?>conteudo_curso_empresa/programacao">Programação Empresa</a></li>
                       </ul>
             </div>
           
              <div class="content-interna" style="width:780px; background:white;">
                       <?php
                
            //print_r(uri_string());
                
                ?>
             
                <div class="left-cursos equalH-meus-cursos">
                  <div class="miolo-interna">
                  
                  <ul class="lista-meus-cursos">
                      <li class="selected"><a href="#">Conteúdo</a>
                           <span>
                               <a href="<?php echo site_url();?>conteudo_curso_empresa/programacao">Programação</a>
                           </span>
          
                       </li>
                       <li ><a href="<?php echo site_url();?>gerenciarinscritos">Gerenciar Inscritos</a></li>
                        <?php if($this->session->userdata('SessionTipoPessoa')=='J'):?>
                            <li ><a href="<?php echo site_url();?>gerenciar_permissoes">Gerenciar Permissões</a></li>
                        <?php endif;?>
                       <li ><a href="<?php echo site_url();?>area_restrita_notas_empresa">Notas e Frequência</a></li> 
                       <li><a href="<?php echo site_url();?>area_restrita_meus_cursos_empresa">Nossos Cursos</a></li>
                    
                  </ul>
                     
                  </div>	
                </div>
                <div class="centerCursos equalH-meus-cursos">
                 <h1>Cursos</h1>
                 <div class="selecionar-curso">
                    <form id="formulario-curso" name="formulario-curso" action="<?php echo site_url(); ?>conteudo_curso_empresa/programacao" method="post">

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
                 <?php
                 
                 //print_r($cursos[0]);
                 ?>
                 
                 <div style="position:relative; top:30px; height:50px;">
                     
                    <div style="float:left;">
                    <p>Data de Aquisição: <?php echo br_date_time($cursos[0]['data_aquisicao']);?></p>
                    <p>Data de Conclusão: <?php echo br_date_time($cursos[0]['data_conclusao']);?></p>
                    </div>
                    <?php
                    //print_r($cursos[0])
                    
                    ?>
                 	<div style="float:right; top:-40px; position:relative;">
                       <?php if($cursos[0]["tipo_curso"]=='EL'): ?>
                    	<p style="float:left; top:-2px; left:220px; color:#f7931e;">CONCLUÍDO</p>
                        <div class="progress" style="float:right;">
                            <div class="progressBarFill" style="width:<?php echo(calculo_conclusao_elearning($cursos[0]["curso_id"])>0?calculo_conclusao_elearning($cursos[0]["curso_id"]):'0');?>px"></div>
                            <div class="progressBar"></div>
                            <p class="progressNumero" style="left:27%;"><?php echo(calculo_conclusao_elearning($cursos[0]["curso_id"])>0?calculo_conclusao_elearning($cursos[0]["curso_id"]):'0');?>%</p> <!-- O atributo left a ser passado precisa ser: valor da porcentagem - 5-->
                        </div>
                        <p class="progressUltimoAcesso" style="display:none;">Última atualização: 29 de abril, 2013 às 15:38h</p>
                         <?php endif; ?>
                        </div> 
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