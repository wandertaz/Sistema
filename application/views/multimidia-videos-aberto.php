<?php
	include("includes/topo.php");
?>


          <?php include("includes/banner-interna.php"); ?>

            <div class="content">
              <div class="content-interna">

                <div class="left-internas">
                  <div class="breadcrumb">
                       <ul>
                        <li><a href="<?php echo site_url(); ?>">Home ></a></li>
                        <li><a>Multimídia ></a></li>
                        <li><a href="<?php echo site_url('multimidia/videos'); ?>">Videos ></a></li>
                        <li><a href="#"><?php echo $video ? $video->titulo : ''; ?></a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3 style="color:#ff3600;">Videos</h3>
                    <div class="txt-interna">
                     <?php if(isset($pagina) && $pagina): ?>
                     	<?php echo $pagina->texto; ?>
                     <?php endif; ?>


                     <div class="revista-buscar">
	                     <form action="<?php echo site_url('multimidia/videos'); ?>" method="GET">
								<input type="text" name="busca" id="busca" placeholder="Buscar" class="inputBuscarCurso" style="top:2px;"/>
						    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" style="position:relative; bottom:11px; right:95px;" />
						    </form>
                     </div>
                     </div>

					<?php if($video): ?>
	                     <div class="textoVideo" style="float:right; width:375px;">
							<h3 class="data-video" style="font-style:italic; border:none;"><?php echo personalizar_data('d.m.Y', $video->data); ?></h3>
							<h3 style="color:#ff3600; border:none; margin-top:0px;"><?php echo $video->titulo; ?></h3>

							<iframe width="375" height="270" src="http://www.youtube.com/embed/<?php echo $video->codigo; ?>" frameborder="0" allowfullscreen></iframe>
							  <?php echo $video->texto; ?>
							  </div>
						                      <div id="lateral-left-publicacoes-artigos" style="position:relative; top:350px; width:85px;">
	                      	<div class="ver-mais-artigos">
	                        	<img src="<?php echo base_url(); ?>assets/img/icon-msg.png">Enviar por email
	                        </div>

	                        <!--<div class="ver-mais-artigos" style="border-top:thin solid #9c9c9c;">
	                        	Compartilhar:<br> <img src="<?php echo base_url(); ?>assets/img/icon-facebook-black.png">  <img src="<?php echo base_url(); ?>assets/img/icon-twitter-black.png">
	                        </div>-->
                                <?php include("includes/midia_social.php"); ?> 
	                    <?php endif; ?>
                      </div>


                   <a class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>comentarios?ID=<?php echo$video->id?>&area=VID&tituloarea=<?php echo $video->titulo; ?>">

                       <img src="<?  echo base_url(); ?>assets/img/button-comentario.png" alt="Fazer um comentário" title="Fazer um comentário" />

                   </a>

                            <?php if($comentarios): ?>
	                      <div id="publicacoes-artigos-comentarios">
	                      <h3>comentários</h3>

	                      <ul>

	                      	<?php foreach($comentarios as $comentario): ?>
		                      	<li>
		                        <?php echo $comentario->comentario; ?>

								<p class="autor-comentario">- <?php echo $comentario->nome; ?></p>
								<p class="data-comentario"><?php echo br_date($comentario->created)?>, <?php echo personalizar_data('H:i', $comentario->created); ?></p>
		                        </li>
		                    <?php endforeach; ?>

	       	              </ul>

	                      </div>
                      <?php endif; ?>


                  </div>
                </div>
                <div class="center2">
                  <?php include('includes/center-ultimas-postagens.php'); ?>
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