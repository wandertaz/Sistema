<!--<meta http-equiv="refresh" content="30">-->
<?php 
	include("includes/topo.php"); 
?>
            
            
          <?php include("includes/banner-interna.php"); ?>
           
            <div class="content">
            
            <div class="menuAreaRestrita">
            <h1>Área Restrita</h1>
            <!--<ul>
            	<li class="selected"><a href="#">Cursos</a></li>
                <!--<li><a href="#">Banco de Talentos</a></li>
                <li><a href="#">Auto Diagnóstico</a></li>
                <li><a href="#">Central de Downloads</a></li>
                <li><a href="#">Gerenciamento de Usuários</a></li>
                <li><a href="#">Armazenamento na Nuvem</a></li>
            </ul>-->
                <?php 
                    include("includes/menu-area-restrita.php"); 
                ?>
            </div>
            
            <div class="breadcrumb" style="background-color:white;">
                       <ul style="padding:5px 0 5px 0;">
                        <li><a href="#">Home ></a></li>
                        <li><a href="#">Business Store ></a></li>
                        <li><a href="#">Meu carrinho</a></li>
                       </ul>
             </div>
             
              <div class="content-interna" style="width:780px; background:white;">
             
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
                           <span class="mensagem"><?php echo check_exercicios();?></span> <span><a href="<?php echo site_url();?>conteudo_curso/exercicios">Exercícios</a></span>
                       </li>
                       <li ><a href="<?php echo site_url();?>area_restrita_notas">Notas e Frequência</a></li>
                       <li><a href="<?php echo site_url();?>avaliacao_do_curso">Avaliação do Curso</a></li>
                       <li><a href="<?php echo site_url();?>area_restrita_meus_cursos">Meus Cursos</a></li>
                       <li><a href="<?php echo site_url();?>certificado">Certificado</a><span>Emissão do Certificado</span></li>
                       <li class="selected"><span class="mensagem"><?php echo check_mensagens();?></span> <a href="<?php echo site_url();?>area_restrita_mensagem">Mensagens</a></li>
					</ul>
                     
                  </div>	
                </div>
                <div class="centerCursos equalH-meus-cursos">
                 <h1 style="display:inline;">Mensagens</h1><h7>(<?php echo check_mensagens();?> não lidas)</h7>
                 <a href="<?php echo site_url();?>area_restrita_mensagem/nova_mensagem" class="various" data-fancybox-type="iframe"><img src="<?php echo base_url(); ?>assets/img/btn-nova-mensagem.png" style="float:right; margin-top:5px;"></a>
                 
                
              
                	 <!-- <div class="buscarEmail">Buscar email: <form name="formContato" id="formContato" method="post"><select name="emailContato" style="width:250px;"><option value="0">lucas@multiweb.com.br</option></select><input type="submit" name="btn-procurar" id="btn-procurar"></form>
                    <a href="#"><img src="<?php //echo base_url();?>assets/img/add-user.png" border="0"> Adicionar Contato</a>
                    </div>-->
                <hr>
                <!-- Inserir paginação -->
                <div id="paginationdemo" class="demo" style="height:420px;">
                <div id="p1" class="pagedemo _current" style="width:570px;">
               
               
                <table width="100%" border="0" class="tabelaAreaRestrita">
                   <tr>
                     <td style="border:none;"><h6>De</h6></td>
                     <td style="border:none;"><h6>Assunto</h6></td>
                     <td style="border:none;"><h6><center>Data</center></h6></td>
                     <td style="border:none;"><h6><center>Apagar</center></h6></td>
                   </tr>
                  
                  
                   <?php foreach ($mensagens as $item):?>
                  <!-- Máximo de 15 mensagens por paginação -->
                 <?php
                        $lido='';
                	if ($item->lido!='S'){
                            $lido='class="msgLida"';					
                        }
								 
		?>
                  
                  <tr <?php echo($lido); ?> >
                      <?php if ($item->tipo_remetente=='I'):?>
                        <td width="20%"><?php echo $item->usuario;?></td>
                    <?php else:?>
                        <td width="20%"><?php echo $item->inscritos;?></td>
                    <?php endif;?>
                    <td width="60%"><a href="<?php echo site_url();?>area_restrita_mensagem/mensagem_aberta?id=<?php echo $item->id ;?>"><?php echo $item->assunto;?></a></td>
                    <td width="10%"><center><?php echo br_date_time($item->created);?></center></td>
                    <td width="10%" class="deletar"><a href="<?php echo site_url();?>area_restrita_mensagem/deletar_mensagem?id_mensagem=<?php echo $item->id ;?>">&nbsp;&nbsp;&nbsp;</a></td>
                  </tr>
                  <?php endforeach;?>
                 
                  
                  
                                    
                </table>
                  
	                
                </div>
                    <div id="demo5wander" style="padding-left:22px; position:relative; right:-208px;"> 
                          <?php echo ($paginacao ? $paginacao : '') ?>
                    </div>
                </div>
                
                </div>
                
              </div>
              
              <?php
			  	include("includes/coluna-direita-area-restrita.php");
			  ?>
				
				
				
				
				
            </div>

<?php 
	include("includes/rodape.php"); 
?>