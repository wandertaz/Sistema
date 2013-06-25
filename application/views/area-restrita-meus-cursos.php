<?php 
	include("includes/topo.php"); 
?>
            
            
          <?php include("includes/banner-interna.php"); ?>
           
            <div class="content">
            
            <div class="vejaTambemMeusCursos">
            <h1>Cursos em Destaques</h1>
                <div id="item-1">
                	<img src="img/video-thumb-sample.png" width="102" height="62" align="left">
                    <div class="mascaraPlayer"></div>
                    <div class="boxTexto">
                	<h2>Gerenciamento de Projetos para arquitetos de software</h2>
                    <p>Uma vasta gama de cursos abertos ao público, são programados e realizados anualmente no Auditório da MB Consultoria, nas áreas da Qualidade, Comportamental, Desenvolvimento</p>
                    </div>
                    <div class="boxPreco">Compre por: <h1>R$ 59,80</h1></div>
                   <div class="boxBotaoComprar"><a href="#"><img src="img/btn-comprar.png" /></a></div>
                </div>
                
                <div id="item-1">
                	<img src="img/video-thumb-sample.png" width="102" height="62" align="left">
                    <div class="mascaraPlayer"></div>
                    <div class="boxTexto">
                	<h2>Gerenciamento de Projetos para arquitetos de software</h2>
                    <p>Uma vasta gama de cursos abertos ao público, são programados e realizados anualmente no Auditório da MB Consultoria, nas áreas da Qualidade, Comportamental, Desenvolvimento</p>
                    </div>
                    <div class="boxPreco">Compre por: <h1>R$ 59,80</h1></div>
                   <div class="boxBotaoComprar"><a href="#"><img src="img/btn-comprar.png" /></a></div>
                </div>
                <div class="veja-fotos-quem-somos">
                     <a href="#"> <img src="img/ico-veja-fotos.jpg" alt="veja mais fotos">Ver todos os cursos</a>
                      </div>
            </div>
            
              <div class="content-interna" style="width:780px; background:white;">
             
                <div class="left-cursos equalH-meus-cursos">
                  <div class="miolo-interna">
                  
                     <ul class="lista-meus-cursos">
                       <li class="selected"><a href="<?php echo site_url();?>meucadastro">Meu Cadastro</a> <span>Atualizar</span> </li>
                       <li><a href="<?php echo site_url();?>area_restrita_meus_cursos">Meus Cursos</a></li>
                       <li><a href="<?php echo site_url();?>area_restrita_meus_cursos">Notas e Frequência</a></li>
                       <li><a href="#">Certificado</a></li>
                       <li><span class="mensagem">10</span> <a href="#">Mensagens</a></li>
                     </ul>
                     
                  </div>	
                </div>
                <div class="centerCursos equalH-meus-cursos">
                 <h1>Meus Cursos</h1>
                 <div class="curso">
                 	<img src="img/video-thumb-sample.png" width="92" height="56" align="left" style="margin-right:5px;">
                    <div class="mascaraPlayer"></div>
                    <h2 style="position:relative; top:-23px; left:2px;">Gerenciamento de Projetos para Arquitetos de Software</h2>
                    <h3>Prof. Nome do professor</h3>
                    <div style="float:left;">
                    <p>Data de Aquisição: 29 de março, 2013</p>
                    <p>Data de Conclusão: 29 de abril, 2013</p>
                    </div>
                    
                    <div style="float:right; top:-40px; position:relative;">
                    	<p style="float:left; top:-2px; left:220px; color:#f7931e;">CONCLUÍDO</p>
                        <div class="progress" style="float:right;">
                            <div class="progressBarFill"></div>
                            <div class="progressBar"></div>
                            <p class="progressNumero" style="left:27%;">32%</p> <!-- O atributo left a ser passado precisa ser: valor da porcentagem - 5-->
                        </div>
                        <p class="progressUltimoAcesso">Última atualização: 29 de abril, 2013 às 15:38h</p>
                    </div> 
                 </div>
                 
                 <div class="curso">
                 	<img src="img/video-thumb-sample.png" width="92" height="56" align="left" style="margin-right:5px;">
                    <div class="mascaraPlayer"></div>
                    <h2 style="position:relative; top:-23px; left:2px;">Gerenciamento de Projetos para Arquitetos de Software</h2>
                    <h3>Prof. Nome do professor</h3>
                    <div style="float:left;">
                    <p>Data de Aquisição: 29 de março, 2013</p>
                    <p>Data de Conclusão: 29 de abril, 2013</p>
                    </div>
                    
                    <div style="float:right; top:-40px; position:relative;">
                    	<p style="float:left; top:-2px; left:220px; color:#f7931e;">CONCLUÍDO</p>
                        <div class="progress" style="float:right;">
                            <div class="progressBarFill"></div>
                            <div class="progressBar"></div>
                            <p class="progressNumero" style="left:27%;">32%</p> <!-- O atributo left a ser passado precisa ser: valor da porcentagem - 5-->
                        </div>
                        <p class="progressUltimoAcesso">Última atualização: 29 de abril, 2013 às 15:38h</p>
                    </div> 
                 </div>
                </div>
                <div class="vejaTambem">
					<?php include("includes/veja-tambem-quem-somos.php"); ?>
				</div>
					<?php include("includes/box-destaques.php");?>
              </div>
              <div class="rightMeusCursos">
                	<?php 
                	include("includes/coluna-direita-area-restrita.php"); 
                        ?>
              </div>
				
				
				
				
				
            </div>

<?php 
	include("includes/rodape.php"); 
?>