<?php 
	include("includes/topo.php"); 
?>
            
            
          <?php include("includes/banner-interna.php"); ?>
           
            <div class="content">
            
            <div class="menuAreaRestrita">
            <h1>Área Restrita</h1>
          <!--  <ul>
            	<li class="selected"><a href="#">Cursos</a></li>
                <li><a href="#">Banco de Talentos</a></li>
                <li><a href="#">Auto Diagnóstico</a></li>
                <li><a href="#">Central de Downloads</a></li>
                <li><a href="#">Gerenciamento de Usuários</a></li>
                <li><a href="#">Armazenamento na Nuvem</a></li>
            </ul>
            -->
           <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
            ?>
            </div>
                  
                  <div class="breadcrumb" style="background-color:white;">
                           <ul style="padding:5px 0 5px 0;">
                            <li><a href="<?php echo base_url();?>">Home &gt;</a></li>
                            <li><a href="<?php echo base_url();?>area_restrita_meus_cursos">Área Restrita &gt;</a></li>
                            <li><a href="<?php echo base_url();?>certificado">Certificado</a></li>
                           </ul>
                  </div>

              <div class="content-interna" style="width:780px; background:#2C2B2B;">
              
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
                       <li><a href="<?php echo site_url();?>avaliacao_do_curso">Avaliação do Curso</a></li>
                       <li><a href="<?php echo site_url();?>area_restrita_meus_cursos">Meus Cursos</a></li>
                       <li class="selected"><a href="<?php echo site_url();?>certificado">Certificado</a><span>Emissão do Certificado</span></li>
                        <?php if (validarelerning($this->session->userdata('SessionCurso'))==true):?>
                       <li ><span class="mensagem"><?php echo check_mensagens();?></span> <a href="<?php echo site_url();?>area_restrita_mensagem">Mensagens</a></li>
                       <?php endif;?>
</ul>
                     
                  </div>	
                </div>
                <div class="centerCursos equalH-meus-cursos">
                 <!--<h1>Cursos</h1>-->
                 
                 <!--<div class="selecionar-curso">
                 <form id="formulario-curso" name="formulario-curso" action="" method="post">
                 	<select name="curso">
                    	<option value="0">Curso A</option>
                        <option value="1">Curso B</option>
                        <option value="2">Curso C</option>
                    </select>
                    <input type="submit" name="enviar" id="enviar" class="buttonBuscarCurso" style="margin-top:4px; cursor:pointer;">
                 </div>-->
                 
                 <!--<h4>Gerenciamento de Projetos para Arquitetos de Software</h4>
                 <h5>Prof. Nome do Professor</h5>-->
                 
<!--                  <div style="position:relative; top:30px; height:20px;">	
                    <div style="float:left;">
                    <p>Data de Aquisição: 29 de março, 2013</p>
                    <p>Data de Conclusão: 29 de abril, 2013</p>
                    </div>
                    
                 	<div style="float:right; top:-40px; position:relative;">
                    	<p style="float:left; top:-2px; left:220px; color:#f7931e;">CONCLUÍDO</p>
                        <div class="progress" style="float:right;">
                            <div class="progressBarFill"></div>
                            <div class="progressBar"></div>
                            <p class="progressNumero" style="left:27%;">32%</p>
                        </div>
                        <p class="progressUltimoAcesso">Última atualização: 29 de abril, 2013 às 15:38h</p>
                        </div> 
                </div> -->
                
                <!--<hr>-->
                
                <h1>Emissão do Certificado</h1>
                 <div class="selecionar-curso">
                    <form id="formulario-curso" name="formulario-curso" action="<?php echo site_url(); ?>certificado" method="post">

                    <select name="curso_selected">
                            <option value="" selected="selected">Selecione</option>
                             <?php foreach ($listaNova as $item):?>
                               
                            <option <?php if ($item["selected"]==1) echo'selected="selected"'; ?> value="<?php echo $item["id_inscricao"];?>"><?php echo $item["titulo"];?></option>
                                
                            <?php endforeach;?>
                    </select>
                    <input type="submit" name="enviar" id="enviar" class="buttonBuscarCurso" style="margin-top:4px; cursor:pointer;">
                    </form>
                 </div>

                <?php if (isset($cursos))   : ?>
                  <?php $i=0; ?>
                  <?php foreach ($cursos as $curso): ?>
                  <div class="area-restrita-aviso-dark lista_certificado">
                    <span class="span-aprovacao"></span> <a href="<?php echo $emitir[$i]; ?>">Clique aqui e acesse o seu certificado do curso <?php echo $curso[0]['titulo']; ?></a> 
                  </div>
                  <?php $i++; endforeach; ?>
                  
                <?php else: ?>

                  <div class="area-restrita-aviso">
                    <span class="span-alert"></span>Como pré-requisito para a emissão do certificado de conclusão do curso, o aluno deverá participar de todas as atividades (leitura do material, exercícios e provas) indicados com o ícone<span class="span-star"></span> na Programação do curso, obtendo indíce de aproveitamento igual ou superior a 70% em cada exercício, bem como realizar a avaliação do curso.
                  </div>

                <?php endif ?>

                <p>Prezado aluno, sua avaliação sobre o curso é um instrumento muito importante para a manutenção da qualidade dos nossos serviços prestados. <a href="<?php echo site_url()?>/avaliacao_do_curso">Clique aqui</a> e faça sua avaliação do curso.</p>
                

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