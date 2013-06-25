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
                        <li><a href="<?php echo site_url('multimidia/podcasts'); ?>">&Aacute;udios ></a></li>
                        <li><a href="#"><?php echo $podcast ? $podcast->titulo : ''; ?></a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3 style="color:#ff3600;">PODCASTS</h3>
                    <div class="txt-interna">
                     <?php if(isset($pagina) && $pagina): ?>
                     	<?php echo $pagina->texto; ?>
                     <?php endif; ?>


                     <div class="revista-buscar">
	                     <form action="<?php echo site_url('multimidia/podcasts'); ?>" method="GET">
								<input type="text" name="busca" id="busca" placeholder="Buscar" class="inputBuscarCurso" style="top:3px;" />
						    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" style="right:97px; position:relative; top:-12px;" />
						    </form>
                     </div>
                     </div>

					<?php if($podcast): ?>
	                     <div id="podcast-in-lista" style="margin-right:15px; float:right; width:360px;">
	                     <div class="box-foto" style="float:left;"><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $podcast->imagem; ?>" alt="quem somos" width="73" align="left">
	                     </div>
	                     <div class="texto-interna-artigos">
	                     <h3 style="border:none; color:#FF3600; font-size:12px; margin-top:0px; font-style:italic;"><?php echo personalizar_data('d.m.Y' ,$podcast->data); ?></h3>
	                     <h4><?php echo $podcast->titulo; ?></h4><br/>

						 <iframe width="100%" style="width:360px; float:right;" height="166" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player/?url=<?php echo $podcast->link; ?>;auto_play=false&amp;show_artwork=false&amp;color=ff0c00"></iframe>

						<p style="float:right; width:360px;"><?php echo $podcast->texto; ?></p>

						</div>
                     	<p></p>
                      	</div>

	                      <div id="lateral-left-publicacoes-artigos" style="position:relative; top:350px; width:90px;">

	                        <div class="ver-mais-artigos">
	                        	<img src="<?php echo base_url(); ?>assets/img/icon-msg.png">Enviar por email
	                        </div>

	                       <!-- <div class="ver-mais-artigos" style="border-top:thin solid #9c9c9c;">
	                        	Compartilhar:<br> <img src="<?php echo base_url(); ?>assets/img/icon-facebook-black.png">  <img src="<?php echo base_url(); ?>assets/img/icon-twitter-black.png">
	                        </div>-->
                               <?php include("includes/midia_social.php"); ?> 
	                      </div>
					<?php endif; ?>


                        <a class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>comentarios?ID=<?php echo$podcast->id?>&area=POD&tituloarea=<?php echo $podcast->titulo; ?>">

                       <img src="<?  echo base_url(); ?>assets/img/button-comentario.png" alt="Fazer um comentário" title="Fazer um comentário" />

                   </a>

					<?php if($comentarios): ?>
	                      <div id="publicacoes-artigos-comentarios-podcast">
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