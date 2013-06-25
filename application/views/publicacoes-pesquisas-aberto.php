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
                        <li><a>Publicações ></a></li>
                        <li><a href="<?php echo site_url('publicacoes/pesquisas'); ?>">Pesquisas e estudos ></a></li>
                        <li><a><?php echo ($pesquisa ? $pesquisa->titulo : ''); ?></a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3 style="color:#ff3600;">PESQUISAS E ESTUDOS</h3>
                    <div class="txt-interna">
                     <?php if(isset($pagina) && $pagina): ?>
                     	<?php echo $pagina->texto; ?>
                     <?php endif; ?>
                     </div>

                     <div class="box-search-noticias">
				    <h3 style=" width:206px; line-height:100%;">&nbsp;</h3>
				    	<form action="<?php echo site_url('publicacoes/pesquisas'); ?>" method="GET">
							<input type="text" name="busca" id="busca" placeholder="Buscar" class="inputBuscarCurso" />
					    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />
					    </form>
				    </div>

				    <div class="txt-interna">

						<?php if($pesquisa): ?>

	                     <h3 class="h3-pesquisas"><?php echo $pesquisa->titulo; ?></h3>
                         <h2 class="h2-data-pesquisa"><?php echo br_month(date('m', strtotime($pesquisa->data))); ?> de <?php echo date('Y', strtotime($pesquisa->data)); ?></h2>
						<p class="textoArtigo" style="width:380px;"><?php echo $pesquisa->texto; ?></p>

	                      <?php endif; ?>
                      </div>



                      <div id="lateral-left-publicacoes-artigos" style="position:relative; top:185px; display:inline-block; width:87px; border:none;">
                        <div class="ver-mais-artigos" style="border-top:none; padding-top:10px; margin-top:7px;">
                        	<a href="<?php echo site_url(); ?>gerenciamento_email/enviar_por_email/<?php echo $pesquisa->id; ?>/PE" data-fancybox-type="iframe" class="various"><img src="<?php echo base_url(); ?>assets/img/icon-msg.png">Enviar por email</a>
                        </div>

                        <!--<div class="ver-mais-artigos" style="border-top:thin solid #9c9c9c;">
                        	Compartilhar:<br/> <img src="<?php echo base_url(); ?>assets/img/icon-facebook-black.png">  <img src="<?php echo base_url(); ?>assets/img/icon-twitter-black.png">
                        </div>-->
                        <?php include("includes/midia_social.php"); ?> 
                      </div>

                        <a class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>comentarios?ID=<?php echo $pesquisa->id?>&area=PES&tituloarea=<?php echo $pesquisa->titulo; ?>"><img src="<?  echo base_url(); ?>assets/img/button-comentario.png" alt="Fazer um comentário" title="Fazer um comentário" /></a>

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
                 <div id="destaques" style="border:none;">
                  <?php include("includes/center-publicacoes.php");?>
                 </div>
                </div>
                <div class="vejaTambemPublicacoes" style="height:300px;">
					<?php include("includes/veja-tambem-publicacoes-pesquisas.php"); ?>
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