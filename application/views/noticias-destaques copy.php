<?php 

	include("includes/topo.php"); 

?>

            

            

          <?php include("includes/banner-interna.php"); ?>

           

            <div class="content noticias">

              <div class="content-interna">

             

                <div class="left-internas">

                  <div class="breadcrumb">

                       <ul>

                        <li><a href="home">Home ></a></li>

                        <li><a>Notícias ></a></li>

                        <li><a href="destaques">Destaques</a></li>

                       </ul>

                  </div>

                  <div class="miolo-interna">

                  

                    <h3 style="color:#ff3600;">Destaques</h3>

                    <div class="txt-interna">

                         <p> <?php echo($pagina->texto);?>  

                   </div>

				    <div class="box-search-noticias">

				    	<h3 style=" width:206px; line-height:100%;">Todos</br>Destaques</h3>

                         <form action="destaques" method="get">

				    	 <input type="text" name="buscarNoticia" id="buscarCurso" placeholder="Buscar news" class="inputBuscarCurso" style="top:13px;" />

				    	 <input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />

                         </form>

				    </div>                      



                  <div class="txt-interna">

                    <div id="paginationdemo" class="demo">

                    <div id="p1" class="pagedemo _current" style="">
					 <div id="artigo-in-lista">
                     
                      <?php echo "Todas as News: ".count($todasnews); foreach ($todasnews as $item):?>  
                      
                                <div class="texto-interna-news">

                                    <span class="data"><?php echo(br_date($item->data));?></span>

                                        <h6><?php echo($item->titulo);?></h6>

                                        <p><?php echo(character_limiter($item->texto,200,'...'));?>

                                          <a href="noticias_abertas?id_noticia=<?php echo($item->id);?>"><img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-vermelho.png"></a></p>

                                       

                                </div>

                     <?php endforeach;?> 
                     
                     

                          

                      </div>

                        <?php echo (isset($paginacao) && $paginacao ? $paginacao : ''); ?>

                    </div>

                    <div id="p2" class="pagedemo" style="display:none;">

                    <div id="artigo-in-lista">

                     <div class="box-foto" style="float:left;"><img src="img/img-artigos.png" alt="quem somos" width="85" align="left">

                     <span class="borda" style="position:relative; left:0px; top:0px;"></span>

                     </div>

                     

                     <div class="texto-interna-artigos">

                     <h4>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos. </h4>

Uma vasta gama de cursos abertos ao público, são programados e realizados anualmente no Auditório da MB Consultoria, nas áreas da Qualidade, Comportamental, Desenvolvimento Gerencial, Logística e Produtividade.

<img src="img/btn-leia-mais-artigos.png" style="padding-bottom: 1.5em">

					</div>

                     <p>&nbsp;</p>

                     

                     <div class="veja-fotos-quem-somos" style="color:#ff3600;">

                     <a href="#" style="color:#ff3600;"> <img src="img/eye-red.png" alt="Ver a Revista MB">Ver a Revista MB</a>

                      </div>

                      </div>

                      

                      
                      

                    </div>

                    <div id="p3" class="pagedemo" style="display:none;">

                    <div id="artigo-in-lista">

                     <div class="box-foto" style="float:left;"><img src="img/img-artigos.png" alt="quem somos" width="85" align="left">

                     <span class="borda" style="position:relative; left:0px; top:0px;"></span>

                     </div>

                     

                     <div class="texto-interna-artigos">

                     <h4>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos. </h4>

Uma vasta gama de cursos abertos ao público, são programados e realizados anualmente no Auditório da MB Consultoria, nas áreas da Qualidade, Comportamental, Desenvolvimento Gerencial, Logística e Produtividade.

<img src="img/btn-leia-mais-artigos.png" style="padding-bottom: 1.5em">

					</div>

                     <p>&nbsp;</p>

                     

                     <div class="veja-fotos-quem-somos" style="color:#ff3600;">

                     <a href="#" style="color:#ff3600;"> <img src="img/eye-red.png" alt="Ver a Revista MB">Ver a Revista MB</a>

                      </div>

                      </div>

                      

                      <div id="artigo-in-lista">

                     <div class="box-foto" style="float:left;"><img src="img/img-artigos.png" alt="quem somos" width="85" align="left">

                     <span class="borda" style="position:relative; left:0px; top:0px;"></span>

                     </div>

                     

                     <div class="texto-interna-artigos">

                     <h4>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos. </h4>

Uma vasta gama de cursos abertos ao público, são programados e realizados anualmente no Auditório da MB Consultoria, nas áreas da Qualidade, Comportamental, Desenvolvimento Gerencial, Logística e Produtividade.

<img src="img/btn-leia-mais-artigos.png" style="padding-bottom: 1.5em">

					</div>

                     <p>&nbsp;</p>

                     

                     <div class="veja-fotos-quem-somos" style="color:#ff3600;">

                     <a href="#" style="color:#ff3600;"> <img src="img/eye-red.png" alt="Ver a Revista MB">Ver a Revista MB</a>

                      </div>

                      </div>

                      

                      <div id="artigo-in-lista">

                     <div class="box-foto" style="float:left;"><img src="img/img-artigos.png" alt="quem somos" width="85" align="left">

                     <span class="borda" style="position:relative; left:0px; top:0px;"></span>

                     </div>

                     

                     <div class="texto-interna-artigos">

                     <h4>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos. </h4>

Uma vasta gama de cursos abertos ao público, são programados e realizados anualmente no Auditório da MB Consultoria, nas áreas da Qualidade, Comportamental, Desenvolvimento Gerencial, Logística e Produtividade.

<img src="img/btn-leia-mais-artigos.png" style="padding-bottom: 1.5em">

					</div>

                     <p>&nbsp;</p>

                     

                     <div class="veja-fotos-quem-somos" style="color:#ff3600;">

                     <a href="#" style="color:#ff3600;"> <img src="img/eye-red.png" alt="Ver a Revista MB">Ver a Revista MB</a>

                      </div>

                      </div>

                      

                      <div id="artigo-in-lista">

                     <div class="box-foto" style="float:left;"><img src="img/img-artigos.png" alt="quem somos" width="85" align="left">

                     <span class="borda" style="position:relative; left:0px; top:0px;"></span>

                     </div>

                     

                     <div class="texto-interna-artigos">

                     <h4>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos. </h4>

Uma vasta gama de cursos abertos ao público, são programados e realizados anualmente no Auditório da MB Consultoria, nas áreas da Qualidade, Comportamental, Desenvolvimento Gerencial, Logística e Produtividade.

<img src="img/btn-leia-mais-artigos.png" style="padding-bottom: 1.5em">

					</div>

                     <p>&nbsp;</p>

                     

                     <div class="veja-fotos-quem-somos" style="color:#ff3600;">

                     <a href="#" style="color:#ff3600;"> <img src="img/eye-red.png" alt="Ver a Revista MB">Ver a Revista MB</a>

                      </div>

                      </div>

                    </div>

                    <div id="demo5" style="padding-top:773px !important;">                   

                </div>

            </div>

                     

                     

                      

                    </div>

                    

                  </div>	

                </div>

                <div class="center2">

                 <div id="destaques" style="border:none;">

                  <div class="depoimentos">

                     <h4>Últimas notícias</h4>

                     <h5>Destaques</h5>

                     <?php foreach ($noticia_destaque as $item):?>

                        <h6><?php echo($item->titulo);?></h6>

                        <p class="ultimosArtigos">

                            <?php echo(character_limiter($item->texto,200,'...'));?>

                             <a href="noticias_abertas?id_noticia=<?php echo($item->id);?>">

                                <img src="<?  echo base_url(); ?>assets/img/btn-leia-mais-vermelho-preto.png">

                            <a

                        </p>

                     <?php endforeach;?> 

                     

                     <h5>MB na mídia</h5>                     

                     <?php foreach ($noticia_mbmidia as $item):?>

                            <h6><?php echo($item->titulo);?></h6>

                            <p class="ultimosArtigos"><?php echo(character_limiter($item->texto,200,'...'));?>

                           <a href="noticias_abertas?id_noticia=<?php echo($item->id);?>">

                            <img src="<?  echo base_url(); ?>assets/img/btn-leia-mais-vermelho-preto.png">

                            <a>

                            </p>

                      <?php endforeach;?> 

                     

                  </div>

                 </div>

                </div>

                <div class="vejaTambemPublicacoes" style="height:300px;">

					<?php include("includes/veja-tambem-publicacoes-artigos.php"); ?>

				</div>

					<?php include("includes/box-destaques.php");?>

              </div>

              <div class="right">

                	<?php 

						include("includes/servicos-home.php");

					?>

              </div>

				

				

				

				

				

            </div>



<?php 

	include("includes/rodape.php"); 

?>