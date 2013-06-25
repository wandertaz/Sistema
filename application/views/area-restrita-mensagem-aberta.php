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
                        <li><a href="#">Home ></a></li>
                        <li><a href="#">Business Store ></a></li>
                        <li><a href="#">Meu carrinho</a></li>
                       </ul>
                  </div>
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
                           <span class="mensagem">
                               <?php echo check_exercicios();?></span> <span><a href="<?php echo site_url();?>conteudo_curso/exercicios">Exercícios</a>
                           </span>
                       </li>
                       
                       <li><a href="<?php echo site_url();?>area_restrita_notas">Notas e Frequência</a></li>
                        <li><a href="<?php echo site_url();?>avaliacao_do_curso">Avaliação do Curso</a></li>
                       <li><a href="<?php echo site_url();?>area_restrita_meus_cursos">Meus Cursos</a></li>
                        <li><a href="<?php echo site_url();?>certificado">Certificado</a><span>Emissão do Certificado</span></li>
                       <li class="selected"><span class="mensagem"><?php echo check_mensagens();?></span> <a href="<?php echo site_url();?>area_restrita_mensagem">Mensagens</a></li>
			
</ul>
                     
                  </div>	
                </div>
                <div class="centerCursos equalH-meus-cursos">
                 <h1 style="display:inline;">Mensagens</h1><h7>(<?php echo check_mensagens();?> não lidas)</h7>
                 
                
           <!--     <hr>
                	<div class="buscarEmail">Buscar email: <form name="formContato" id="formContato" method="post"><select name="emailContato" style="width:250px;"><option value="0">lucas@multiweb.com.br</option></select><input type="submit" name="btn-procurar" id="btn-procurar"></form>
                    <a href="#"><img src="img/add-user.png" border="0"> Adicionar Contato</a>
                    </div>-->
                <hr>
                
                <table width="100%" border="0" class="tabelaAreaRestrita">
                 
                  <!-- Máximo de 15 mensagens por paginação -->
                  <tr class="msgLida">
                    <td width="60%" style="padding:20px;">
                        <?php $cadastrador=$mensagens[0]->tipo_remetente=='A'? $mensagens[0]->inscritos:$mensagens[0]->usuario?>
                    <div style="display:block; margin-bottom:10px;"><font style="color:#f7931e; font-style:italic;">De: </font><?php echo $cadastrador;?></div> 
                    <div style="display:block;"><font style="color:#f7931e; font-style:italic;">Assunto:</font> <?php echo $mensagens[0]->assunto;?></div></td>
                    <td width="40%">
                    <div style="display:block; margin-bottom:10px;">
                    <center><font style="color:#f7931e; font-style:italic;">Recebida em: 	</font></center></div>
                    <center><?php echo br_date_time($mensagens[0]->created);?></center></td>
                  </tr>           
                </table>
                
                <div class="mensagens-mensagem">
                <?php echo $mensagens[0]->texto;?>
                </div>
                
                <ul id="example1" class="accordion2" style="width:565px; margin-top:20px;">
                <!-- A cada nova mensagem, repete esse bloco -->
                
                <?php foreach ($mensagem_resposta as $item2):                   
                    ?>
                  <li class="active">
                    <?php if($item2->tipo_remetente=='A'):?>
                      <h3 style="top:0px; left:0px;"> De: Aluno <?php echo$item2->inscritos ;?> - <?php echo br_date_time($item2->created) ;?></h3>
                    <?php else:?>
                        <h3 style="top:0px; left:0px;"> De: Professor <?php echo$item2->usuario ;?> - <?php echo br_date_time($item2->created)?></h3>
                    <?php endif;?>
                    <div class="panel loading" style="font-size:11px;"><?php echo $item2->texto?></div>
                  </li>
                <!-- Fim do bloco a ser repetido para a mensagem -->
               
                <?php endforeach;?>
                </ul>
                
                <div class="opcoesMsg">
                    <div style="float:left;"><!--<a href="#">Encaminhar</a>--> <a class="various" data-fancybox-type="iframe" href="<?php echo site_url().'Cimprimir_mensagem?id_mensagem='.$mensagens[0]->id ;?>">Imprimir</a> <!-- <a href="#">Outras Opções</a>--></div>
                    <div style="float:right; margin-right:20px; margin-top:0px;"><a href="<?php echo site_url();?>area_restrita_mensagem/deletar_mensagem?id_mensagem=<?php echo $mensagens[0]->id ;?>"><img src="<?php echo base_url(); ?>assets/img/delete-icon.png"></a></div>
                </div>
                <hr>
                <font style="color:#f7931e; font-style:italic; font-size:12px; float:left;">Responder:</font>
                <form id="frmResposta" name="frmResposta" method="post" action="<?php echo site_url();?>area_restrita_mensagem/responder_mensagem">
                	<textarea name="resposta" id="resposta" style="width:465px; margin-bottom:25px;" rows="10"></textarea>
                    <input type="hidden" name="id_mensagem" value="<?php echo $mensagens[0]->id; ?>">
                    <input type="submit" value="Enviar" id="btn-enviar" name="btn-enviar">
                    <input name="btn-reset" value="Enviar" id="btn-reset" type="reset">
                </form>
                
                </div>
                
              </div>
              <?php
			  	include("includes/coluna-direita-area-restrita.php");
			  ?>
				
				
            </div>

<?php 
	include("includes/rodape.php"); 
?>