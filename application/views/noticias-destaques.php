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

				    	<input type="text" name="buscarNoticia" id="buscarCurso" placeholder="Buscar news" class="inputBuscarCurso" style="top:13px;"/>

				    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />

                                        </form>

				    </div>



                  <div class="txt-interna">

                    <div id="paginationdemo" class="demo">

                    <div id="p1" class="pagedemo _current" style="">





                    <div id="artigo-in-lista">



                      <?php foreach ($todasnews as $item):?>

                                <div class="texto-interna-news">

                                    <span class="data"><?php echo(br_date($item->data));?></span>

                                    <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $item->imagem; ?>" style="width:155px; height:100px">

                                        <h6><?php echo($item->titulo);?></h6>

                                        <p><?php echo(character_limiter($item->descricao,200,'...'));?>

                                          <a href="noticias_abertas?id_noticia=<?php echo($item->id);?>"><img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-vermelho.png"></a></p>



                                </div>

                     <?php endforeach;?>



                      </div>

                        <?php echo (isset($paginacao) && $paginacao ? $paginacao : ''); ?>

                    </div>
            </div>







                    </div>



                  </div>

                </div>

                <div class="center2">

                 <div id="destaques" style="border:none;">

                  <div class="depoimentos">

                     <h4>Últimas notícias</h4>

                     <h3>NEWS</h3>

                     <?php foreach ($noticia_news as $item):?>

                        <h6><?php echo($item->titulo);?></h6>

                        <div class="ultimosArtigos">

                            <?php echo(character_limiter($item->descricao,200,'...'));?>

                             <a style="margin-top: 12px;display: block;" href="noticias_abertas?id_noticia=<?php echo($item->id);?>">

                                <img src="<?  echo base_url(); ?>assets/img/btn-leia-mais-vermelho-preto.png">

                            </a>

                        </div> 

                     <?php endforeach;?>


                      <h3>&nbsp;</h3><br>
                     <h3>MB na mídia</h3>

                     <?php foreach ($noticia_mbmidia as $item):?>

                            <h6><?php echo($item->titulo);?></h6>

                            <p class="ultimosArtigos"><?php echo(character_limiter($item->descricao,200,'...'));?>

                           <a href="noticias_abertas?id_noticia=<?php echo($item->id);?>">

                            <img src="<?  echo base_url(); ?>assets/img/btn-leia-mais-vermelho-preto.png">

                            <a>

                            </p>

                      <?php endforeach;?>



                  </div>

                 </div>

                </div>

                <div class="vejaTambem" style="height:300px;">

					<?php include("includes/veja-tambem-news.php"); ?>

				</div>

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