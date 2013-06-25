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
                        <li><a href="<?php echo site_url('multimidia/galerias'); ?>">Galerias de Fotos ></a></li>
                        <li><a href="#"><?php echo $galeria ? $galeria->titulo : ''; ?></a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3 style="color:#ff3600;">galeria de fotos</h3>
                    <div class="txt-interna" style="width:450px;">
                     <?php if(isset($pagina) && $pagina): ?>
                     	<?php echo $pagina->texto; ?>
                     <?php endif; ?>

                     <div class="revista-buscar">
	                     <form action="<?php echo site_url('multimidia/galerias'); ?>" method="GET">
								<input type="text" name="busca" id="busca" placeholder="Buscar" class="inputBuscarCurso" style="top:3px;" />
						    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" style="position:relative; top:-11px; right:175px;"/>
						    </form>
                     </div>

                 <?php if($galeria): ?>
                     <!-- inicio -->
                     <?php if($galeria->fotos): ?>
						 <div class="mygallery">
							<div class="tn3 album">
							    <h4></h4>
							    <div class="tn3 description"></div>
							    <div class="tn3 thumb"></div>
							    <ol>
							    	<?php foreach($galeria->fotos as $foto): ?>
										<li>
										    <h4></h4>
										    <div class="tn3 description"></div>
										    <a href="<?php echo base_url(); ?>assets/uploads/<?php echo $foto->foto; ?>">
											<img src="<?php echo base_url(); ?>assets/uploads/thumb_<?php echo $foto->foto; ?>" />
										    </a>
										</li>
									<?php endforeach; ?>
							    </ol>
							</div>
						</div>
					<?php endif; ?>
                     <!-- fim -->

                    </div>

                    <div style="width:100%;">
                    <h3><?php echo $galeria->titulo; ?></h3>
                    
                     <p style="font-size:10px; float:right; width:380px;">
                         <?php echo $galeria->texto; ?>
                     
                     </p>
                      <div id="lateral-left-publicacoes-artigos" style="position:relative; top:6px; width:110px; float:left;">

                        <div class="ver-mais-artigos" style="border-top:thin solid #9c9c9c;">
                        	<img src="<?php echo base_url(); ?>assets/img/icon-msg.png">Enviar por email
                        </div>

                        <!--<div class="ver-mais-artigos" style="border-top:thin solid #9c9c9c;">
                        	Compartilhar:<br/> <img src="<?php echo base_url(); ?>assets/img/icon-facebook-black.png">  <img src="<?php echo base_url(); ?>assets/img/icon-twitter-black.png">
                        </div>-->
                        <?php include("includes/midia_social.php"); ?> 
                      </div>
                      </div>
				<?php endif; ?>

                  <a class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>comentarios?ID=<?php echo$galeria->id?>&area=GAL&tituloarea=<?php echo $galeria->titulo; ?>">

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