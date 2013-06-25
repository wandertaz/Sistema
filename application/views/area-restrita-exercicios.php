<?php 
	include("includes/topo.php"); 
?>
            
            
          <?php include("includes/banner-interna.php"); ?>
           
            <div class="content">
            
            <div class="menuAreaRestrita">
            <h1>Área Restrita</h1>
            <!--<ul>
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
             <div class="breadcrumb">
                       <ul style="padding:5px 0 5px 0;">
                            <li><a href="<?php echo base_url();?>">Home &gt;</a></li>
                            <li><a href="<?php echo base_url();?>area_restrita_meus_cursos">Área Restrita &gt;</a></li>
                            <li><a href="<?php echo base_url();?>conteudo_curso/exercicios">Exercícios</a></li>
                       </ul>
                  </div>
                <div class="left-cursos equalH-meus-cursos">
                
                  <div class="miolo-interna">
                  
                     <ul class="lista-meus-cursos">
                       <li class="selected"><a href="#">Conteúdo</a>
                           < <span>
                               <a href="<?php echo site_url();?>conteudo_curso/programacao">Programação</a>
                           </span>
                           <span>
                               <a href="<?php echo site_url();?>conteudo_curso/apostilas_anexos/A">Apostila e anexos</a></span>
                           <span>
                               <a href="<?php echo site_url();?>conteudo_curso/apostilas_anexos/L">Leituras Complementares
                           </span>
                           <span class="mensagem"><?php echo check_exercicios();?></span> <span><a href="<?php echo site_url();?>conteudo_curso/exercicios">Exercícios</a></span>
                       </li>
                       <li ><a href="<?php echo site_url();?>area_restrita_notas">Notas e Frequência</a></li>
                       <li><a href="<?php echo site_url();?>avaliacao_do_curso">Avaliação do Curso</a></li>
                       <li><a href="<?php echo site_url();?>area_restrita_meus_cursos">Meus Cursos</a></li>
                       <li><a href="<?php echo site_url();?>certificado">Certificado</a><span>Emissão do Certificado</span></li>
                       <li ><span class="mensagem"><?php echo check_mensagens();?></span> <a href="<?php echo site_url();?>area_restrita_mensagem">Mensagens</a></li>
</ul>
                     
                  </div>	
                </div>
                
                <div class="centerCursos equalH-meus-cursos">
                
                 <h1>Cursos</h1>
                 <div class="selecionar-curso">
                   <form id="formulario-curso" name="formulario-curso" action="<?php echo base_url();?>conteudo_curso/exercicios" method="post">
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
                       <?php
                                                        //print_r($cursos[0]['tipo_curso']);
                                                        //exit();
                            
                            ?>
                 <div style="position:relative; top:30px; height:50px;">	
                    <div style="float:left;">
                    <p>Data de Aquisição: <?php echo br_date_time($cursos[0]['data_aquisicao']);?></p>
                    <p>Data de Conclusão: <?php echo br_date_time($cursos[0]['data_conclusao']);?></p>
                    </div>
                    
                 	<div style="float:right; top:-14px; position:relative;">
                    	<p style="top:-2px; left:220px; color:#f7931e;top: 13px;left: -80px;">CONCLUÍDO</p>
                        <div class="progress" style="float:right;">
                            <div class="progressBarFill" style="width:<?php echo(calculo_conclusao_elearning($cursos[0]["curso_id"])>0?calculo_conclusao_elearning($cursos[0]["curso_id"]):'0');?>%"></div>
                            <div class="progressBar"></div>
                            <p class="progressNumero"style="left:27%;"><?php echo(calculo_conclusao_elearning($cursos[0]["curso_id"])>0?calculo_conclusao_elearning($cursos[0]["curso_id"]):'0');?>%</p> <!-- O atributo left a ser passado precisa ser: valor da porcentagem - 5-->
                        </div>
                        <p class="progressUltimoAcesso" style="display:none;">Última atualização: 29 de abril, 2013 às 15:38h</p>
                    </div> 
                </div>
                <?php endif;?> 
                
                <?php if (isset($exercicios)):?>
                <hr>
                <h4>Exercícios</h4>
                
                <table width="100%" border="0" class="tabelaAreaRestrita">
                  <tr>
                    <td style="border:none;"><h6>Aula</h6></td>
                    <td style="border:none;"><h6><center>Descrição</center></h6></td>
                    <td style="border:none;"><h6><center>Desempenho</center></h6></td>
                    <td style="border:none;"><h6><center>Realizar</center></h6></td>
                  </tr>
                                         
                  <?php 
                  $x_media=0;
                  $valor=0;
                  $notaobtida=0;
                    foreach ($exercicios as $item):
                        
                    ?>
                    <tr>
                      <td class="nomeCurso" width="10%"><?php echo $item['numero'];?></td>
                      <td><center><?php echo $item['titulo'];?></center></td>
                      
                          <?php if ($item['id_nota']>0):?>
                                <?php 
                                    
                                    $nota=(((100/$item['valor'])*$item['nota']));
                                    $valor+=$item['valor'];
                                    $notaobtida+=$item['nota'];
                                ?>
                          <?php else:?>
                                <?php 
                                    $nota=0;
                                ?>
                          <?php endif;?>
                          
                        <?php if ($item['id_nota']>0):?>
                            <?php if ($nota<=60):?>
                                <?php $x_media+=1;?>
                                <td class="tabela-desempenho-negativo">
                                <img src="<?php echo base_url();?>assets/img/arrow-negative.gif">&nbsp;
                                <?php echo $nota;?>%
                          <?php else:?>
                                 <?php $x_media+=1;?>
                                <td class="tabela-desempenho-positivo">
                                <img src="<?php echo base_url();?>assets/img/arrow-positive.gif">&nbsp;
                                <?php echo $nota;?>%                           
                          <?php endif;?>
                                
                           <?php else:?>
                             <td class="tabela-desempenho-positivo">
                                 -
                        <?php endif;?>
                      </td>
                      <td>
                        <center>
                            
                            <?php if ($item['id_nota']>0):?>
                            
                                <a href="<?php echo site_url();?>saladeaula/fazerexercicio/<?php echo $item['id'];?>/<?php echo $item['curso_id'];?>/<?php echo $cursos[0]['tipo_curso'];?>" data-fancybox-type="iframe" class="various">
                                    <!--ainda não foi feito-->
                                    <img src="<?php echo base_url();?>assets/img/lapis-fazer.gif">
                                </a>
                            <?php else :?>
                                <a href="<?php echo site_url();?>saladeaula/fazerexercicio/<?php echo $item['id'];?>/<?php echo $item['curso_id'];?>/<?php echo $cursos[0]['tipo_curso'];?>" data-fancybox-type="iframe" class="various">
                                    <img src="<?php echo base_url();?>assets/img/lapis-fazer.gif">
                                </a>
                            <?php endif;?>
                        </center>
                      </td>
                    </tr>
                  <?php endforeach;?>                  
                  
                  <!-- SALDO FINAL -->
                  <tr class="tr-sem-borda">
                    <td></td>
                    <td></td>
                    
                    <?php
                     $notaobtidaporcentagem=0;
                     if($valor>0 &&$notaobtida>=0):
                        $notaobtidaporcentagem=(((100/$valor)*$notaobtida));
                     endif;
                     ?> 
                     <?php if ($notaobtidaporcentagem>=60):?>
                    <td class="tabela-desempenho-positivo">     
                            Media atual: <?php echo $notaobtidaporcentagem;?>% &nbsp;
                           <img src="<?php echo base_url();?>assets/img/arrow-positive.gif">&nbsp; 
                     </td>
                    <?php else:?>
                      <?php if ($x_media>0):?>
                        <td class="tabela-desempenho-negativo">
                              Media atual: <?php echo $notaobtidaporcentagem;?>% &nbsp;
                              <img src="<?php echo base_url();?>assets/img/arrow-negative.gif">&nbsp;
                        </td>
                     <?php endif;?>
                    <?php endif;?>
                     </td>
                    
                    <td></td>
                  </tr>
                  
                </table>
                <?php endif;?>
                
                
                <?php if (isset($prova)):?>
                <hr>
                <h4>Provas</h4>
                
                <table width="100%" border="0" class="tabelaAreaRestrita">                    
                  <tr>
                    <td style="border:none;"><h6>Aula</h6></td>
                    <td style="border:none;"><h6><center>Descrição</center></h6></td>
                    <td style="border:none;"><h6><center>Desempenho</center></h6></td>
                    <td style="border:none;"><h6><center>Realizar</center></h6></td>
                  </tr>
                 <?php foreach ($prova as $item):?>
                  <?php
                                                        //print_r($item);
                                                        //exit();
                            
                            ?>
                    <tr>
                      <td class="nomeCurso" width="10%"><?php echo $item['numero'];?></td>
                      <td><center><?php echo $item['titulo'];?></center></td>
                      <td class="tabela-desempenho-positivo">
                          &nbsp;-
                      </td>
                      <td><center><a href="<?php echo site_url();?>saladeaula/fazerprova/<?php echo $item['id'];?>/<?php echo $item['curso_id'];?>/<?php echo $cursos[0]['tipo_curso'];?>" data-fancybox-type="iframe" class="various" tipoLink="fazerProva">
                              <img src="<?php echo base_url();?>assets/img/lapis-fazer.gif"></a></center></td>
                    </tr>
                    
                  <?php endforeach;?>
         
                </table>
                 
                    
                <?php endif;?>
                 <?php if (isset($cursos_lista)):?>
                        <?php if (isset($cursos)==false):?>              
                            <br><br>
                            <div class="sem-conteudo">
                                 Selecione um curso!
                            </div>
                        <?php endif; ?>
                    <?php else:?>
                         <?php if (isset($cursos)==false):?>
                            <br><br>
                            <div class="sem-conteudo">
                                 Não foi encontrado conteúdo!
                            </div>
                        <?php endif; ?>
                    <?php endif;?>
                
                
                
                
                </div>
                
              </div>
              <?php
			  	include("includes/coluna-direita-area-restrita.php");
			  ?>
				
				
				
				
				
            </div>

<?php 
	include("includes/rodape.php"); 
?>