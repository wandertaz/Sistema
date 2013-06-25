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
                  
                  <div class="breadcrumb" style="background-color:white;">
                           <ul style="padding:5px 0 5px 0;">
                             <li><a href="<?php echo base_url();?>">Home &gt;</a></li>
                            <li><a href="<?php echo base_url();?>area_restrita_meus_cursos">Área Restrita &gt;</a></li>
                            <li><a href="<?php echo base_url();?>avaliacao_do_curso">Avaliação do Curso</a></li>
                           </ul>
                  </div>

              <div class="content-interna" style="width:990px; background:#2C2B2B;">
              
                <div class="left-cursos equalH-meus-cursos">
                
                  <div class="miolo-interna">
                  
                     <ul class="lista-meus-cursos">
                       <li><a href="#">Conteúdo</a>
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
                       <li class="selected">><a href="<?php echo site_url();?>avaliacao_do_curso">Avaliação do Curso</a></li>
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
                 <?php if (isset($cursos)):?>
                    <h1>Cursos</h1>
                 <?php endif;?>
                    
                 <div class="selecionar-curso">
                     <form id="formulario-curso" name="formulario-curso" action="<?php echo site_url(); ?>avaliacao_do_curso/" method="post">
                         
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
                 <?php 
                     //print_r($cursos[0]);
                     //exit();
                 
                 ?>
                
                 <h5>Prof. <?php echo $cursos[0]['instrutor'];?></h5>                 
                 <div style="position:relative;">	
                    <div style="float:left;">
                        <p>Data de Aquisição: <?php echo br_date_time($cursos[0]['data_aquisicao']);?></p>
                    <p>Data de Conclusão: <?php echo br_date_time($cursos[0]['data_conclusao']);?></p>
                    </div>
                    
                 	<div style="float:right; top:-40px; position:relative;">
                        <?php if($cursos[0]["tipo_curso"]=='EL'): ?>    
                    	<p style="float:left; top:-2px; left:220px; color:#f7931e;">CONCLUÍDO</p>
                        <div class="progress" style="float:right;">
                            <div class="progressBarFill" style="width:<?php echo(calculo_conclusao_elearning($cursos[0]["curso_id"])>0?calculo_conclusao_elearning($cursos[0]["curso_id"]):'0');?>px"></div>
                            <div class="progressBar" ></div>
                            <p class="progressNumero" style="left:27%;"><?php echo(calculo_conclusao_elearning($cursos[0]["curso_id"])>0?calculo_conclusao_elearning($cursos[0]["curso_id"]):'0');?>%</p> <!-- O atributo left a ser passado precisa ser: valor da porcentagem - 5-->
                        </div>
                        <p class="progressUltimoAcesso" style="display:none;">Última atualização: 29 de abril, 2013 às 15:38h</p>
                        </div> 
                        <?php endif; ?>
                </div>
                
                <hr>
                <?php endif;?>
                <br>
                <h4>Avaliação do Curso</h4>             
               
                <div class="area-restrita-aviso">
                <span class="span-alert"></span>Para realizar a avaliação do curso é necessário o aluno deverá participar de todas as atividades (leitura do material, exercícios e provas) indicados com o ícone <span class="span-star"></span> na Programação do curso, obtendo indíce de aproveitamento igual ou superior a 70% em cada exercício.
                </div>
                
                <p>Prezado aluno, sua avaliação sobre o curso é um instrumento muito importante para a manutenção da qualidade dos nossos serviços prestados.</p>
                
                <hr>
                <?php if (isset($cursos)):?>
                <?php 
                    $x=1;
                    //quando for inserrir novo item a ser avaliado tera de inserir nova variavel
                    $a=1;
                    $b=1;
                    $c=1;
                    $d=1;
                    
                    $aux=0;
                ?>
<?php if($cursos_lista[0]['id_avaliacao']<=0): ?>
                <form class="equalH-avaliacoes" style="overflow:hidden" id="formAvaliacao" name="formAvaliacao" action="<?php echo site_url(); ?>avaliacao_do_curso/salvar_pesquisa" method="post">
                    <table width="100%" border="0" class="tabelaAreaRestrita b">
                    <?php foreach ($perguntas as $item): ?>
                        <?php if (isset($titulo) && $titulo!=$item['titulo']):?> 
                          </table><table width="100%" border="0" class="tabelaAreaRestrita a">
                        <?php  endif; ?> 
                        
                        <?php 
                        //print_r($item['area']);
                       // exit;
                        //area (I)nstrutor, (C)onteúdo, (P)rograma ou (G)eral
                        //tipo (A)berto ou (F)echado
                        $titulo=$item['titulo'];                        
                        ?>
                         <?php if ($item['area']=='I'):?> 
                            <?php if ($a==1):
                                $aux+=1;
                                $a+=1;
                             ?>
                                <h2 style="margin:12px 0 0 8px">Avaliação do Professor</h2>
                            <?php endif;?>
                                
                            <?php if ($item['tipo']=='A'):?>
                                
                                
                            <tr>
                                <td width="65%" style="border:none;padding-bottom: 31px;">
                                    <?echo $item['titulo'];?>?
                                     <input type="hidden" name="tipopergunta_<?php echo $x?>" value="A">
                                    <input type="hidden" name="pergunta_<?php echo $x?>" value="<?php echo $item['id_pergunta'];?>">
                                    <textarea id="resposta_<?php echo $x;?>" name="resposta_<?php echo $x;?>" style="width:555px;"></textarea>
                                </td>
                            </tr> 
                            <?php elseif ($item['tipo']=='F'): ?>
                            <tr>
                                <td width="80%" style="border:none;"><?echo $x.') '.$item['titulo'];?></td>
                                <td style="border:none;">
                                    <span class="span-avaliacao">
                                         <input type="hidden" name="tipopergunta_<?php echo $x?>" value="F">
                                        <input type="hidden" name="pergunta_<?php echo $x?>" value="<?php echo $item['id_pergunta'];?>">
                                        <input type="hidden" name="resposta_<?php echo $x?>" id="resposta_<?php echo $x?>" value="0">
                                        <a id="estrela_resposta_<?php echo $x;?>_1" class="span-star">1</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_2" class="span-star">2</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_3" class="span-star">3</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_4" class="span-star">4</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_5" class="span-star">5</a>
                                    </span>
                                </td>
                            </tr>                                
                            <?php endif;?>
                        
                        <?php elseif ($item['area']=='C'):?>
                            <?php if ($b==1):
                                $aux+=1;
                                $b+=1;
                             ?>
                                <h2 style="margin:12px 0 0 8px">Avaliação do Conteúdo</h2>
                            <?php endif;?>
                                
                            <?php if ($item['tipo']=='A'):?>
                                
                            <tr>
                                <td width="80%" style="border:none;padding-bottom: 31px;">
                                    <?echo $item['titulo'];?>?
                                    <input type="hidden" name="tipopergunta_<?php echo $x?>" value="A">
                                    <input type="hidden" name="pergunta_<?php echo $x?>" value="<?php echo $item['id_pergunta'];?>">
                                    <textarea id="resposta_<?php echo $x;?>" name="resposta_<?php echo $x;?>" style="width:555px;"></textarea>
                                </td>
                            </tr> 
                                
                            <?php elseif ($item['tipo']=='F'): ?>
                            <tr>
                                <td width="80%" style="border:none;"><?echo $x.') '.$item['titulo'];?></td>
                                <td style="border:none;">
                                    <span class="span-avaliacao">
                                        <input type="hidden" name="tipopergunta_<?php echo $x?>" value="F">
                                        <input type="hidden" name="pergunta_<?php echo $x?>" value="<?php echo $item['id_pergunta'];?>">
                                        <input type="hidden" name="resposta_<?php echo $x?>" id="resposta_<?php echo $x?>" value="0">
                                        <a id="estrela_resposta_<?php echo $x;?>_1" class="span-star">1</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_2" class="span-star">2</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_3" class="span-star">3</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_4" class="span-star">4</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_5" class="span-star">5</a>
                                    </span>
                                </td>
                            </tr>
                                
                           <?php endif;?>
                            
                        <?php elseif ($item['area']=='P'):?>
                              <?php if ($c==1):
                                $aux+=1;
                                $c+=1;
                             ?>
                                <h2 style="margin:12px 0 0 8px">Avaliação do Programa</h2>
                            <?php endif;?>
                                
                            <?php if ($item['tipo']=='A'):?>
                                
                               <tr>
                                    <td width="65%" style="border:none;padding-bottom: 31px;">
                                        <?echo $item['titulo'];?>?
                                        <input type="hidden" name="tipopergunta_<?php echo $x?>" value="A">
                                        <input type="hidden" name="pergunta_<?php echo $x?>" value="<?php echo $item['id_pergunta'];?>">
                                        <textarea id="resposta_<?php echo $x;?>" name="resposta_<?php echo $x;?>" style="width:555px;"></textarea>
                                    </td>
                                </tr> 
                                
                            <?php elseif ($item['tipo']=='F'): ?>
                            <tr>
                                <td width="80%" style="border:none;"><?echo $x.') '.$item['titulo'];?></td>
                                <td style="border:none;">
                                    <span class="span-avaliacao">
                                        <input type="hidden" name="tipopergunta_<?php echo $x?>" value="F">                                        
                                        <input type="hidden" name="pergunta_<?php echo $x?>" value="<?php echo $item['id_pergunta'];?>">                                        
                                        <input type="hidden" name="resposta_<?php echo $x?>" id="resposta_<?php echo $x?>" value="0">
                                        <a id="estrela_resposta_<?php echo $x;?>_1" class="span-star">1</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_2" class="span-star">2</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_3" class="span-star">3</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_4" class="span-star">4</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_5" class="span-star">5</a>
                                    </span>
                                </td>
                            </tr>
                                
                            <?php endif; ?>
                        <?php elseif ($item['area']=='G'):?>
                            <?php if ($d==1):
                                $aux+=1;
                                $d+=1;
                             ?>

                                <h2 style="margin:12px 0 0 8px">Avaliação Geral</h2>
                            <?php endif;?>
                                
                            <?php if ($item['tipo']=='A'):?>
                                
                              <tr>
                                <td width="65%" style="border:none;padding-bottom: 31px;">
                                    <?echo $item['titulo'];?>?
                                    <input type="hidden" name="tipopergunta_<?php echo $x?>" value="A">
                                    <input type="hidden" name="pergunta_<?php echo $x?>" value="<?php echo $item['id_pergunta'];?>">
                                    <textarea id="resposta_<?php echo $x;?>" name="resposta_<?php echo $x;?>" style="width:555px;"></textarea>
                                </td>
                            </tr> 
                                
                            <?php elseif ($item['tipo']=='F'): ?>
                            <tr>
                                <td width="80%" style="border:none;"><?echo $x.') '.$item['titulo'];?></td>
                                <td style="border:none;">
                                    <span class="span-avaliacao">
                                        <input type="hidden" name="pergunta_<?php echo $x?>" value="<?php echo $item['id_pergunta'];?>">
                                        <input type="hidden" name="resposta_<?php echo $x?>" id="resposta_<?php echo $x?>" value="0">
                                        <a id="estrela_resposta_<?php echo $x;?>_1" class="span-star">1</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_2" class="span-star">2</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_3" class="span-star">3</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_4" class="span-star">4</a>
                                        <a id="estrela_resposta_<?php echo $x;?>_5" class="span-star">5</a>
                                    </span>
                                </td>
                            </tr>
                                
                            <?php endif; ?>
                        <?php endif; ?>
                        
                     <?php if ($titulo!=$item['titulo']&&$titulo!=''):?> 
                         </table>
                
                        <hr>
                     <?php  endif; ?>   
                        
                    <?php 
                    $x+=1;
                    
                    endforeach; 
                    ?>                   


                </table>



              
                        <input type="hidden" name="contador" value="<?php echo $x-1 ;?>">
                      <input type="hidden" name="curso_id" value="<?php echo $cursos[0]['curso_id']  ;?>">
                      <input type="hidden" name="tipo_curso" value="<?php echo $cursos_lista[0]['tipo_curso']  ;?>">
                      <input style="margin-left: 8px;display: block;overflow: hidden;" type="submit" name="btn-enviar" id="btn-enviar" >
              


                 </form>
  <?php else: ?>
<div class="sem-conteudo">
                A MB consultoria agradece pela participação, na avaliação do curso!
</div>
  <?php endif; ?>
                 <?php endif;?> 
                
                                 
                    <?php if (isset($cursos_lista)):?>
                        <?php if (isset($perguntas)==false):?>
                            <br><br>
                            <div class="sem-conteudo">
                                 Selecione um curso!
                            </div>
                        <?php endif; ?>
                    <?php else:?>
                         <?php if (isset($perguntas)==false):?>
                            <br><br>
                            <div class="sem-conteudo">
                                 Não foi encontrado conteúdo!
                            </div>
                        <?php endif; ?>
                    <?php endif;?>
                </div>
               
              </div>
              <div class="rightMeusCursos">
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