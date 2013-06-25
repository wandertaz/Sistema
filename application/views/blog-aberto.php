<?php
	include("includes/topo.php");
?>


          <?php include("includes/banner-blog.php"); ?>

            <div class="content blog">
              <div class="content-interna">

                <div class="left-internas" style="width:709px;">
                  <div class="breadcrumb">
                       <ul>
                        <li><a href="<?php echo site_url(); ?>">Home ></a></li>
                        <li><a href="<?php echo site_url('blog'); ?>">Blog ></a></li>
                        <li><a href="#"><?php echo ($post ? $post->titulo : ''); ?></a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

					<?php if($post): ?>
                    	<h3 style="color:#ff3600;">Colunista</h3>
	                    <div class="txt-interna" style="float:left; width:400px;">
	                     <p>
	                     <h4 style="margin-bottom:0px;"><?php echo $post->colunista; ?></h4>
                         <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $post->aa; ?>" width="80">
	                     </p>
						</div>
					    <div class="box-search-blog" style="width:270px; float:right; display:inline-block; margin-top:0px;">
					    	<h3 style=" width:270px; line-height:100%;"></h3>

					    	<form action="<?php echo site_url('blog/index'); ?>" method="GET">
								<input type="text" name="busca" id="buscarCurso" placeholder="Buscar Post" class="inputBuscarCurso" style="top:0px;" />
						    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" style="top:-13px; position:relative;"/>
					    	</form>
					    </div>
					<?php endif; ?>

                  <div class="txt-interna" style="float:left; width:600px;">


                    <div id="artigo-in-lista" style="height:100%;">
					<div class="miolo-interna">

					<?php if($post): ?>

                     	<h3 class="h3-pesquisas" style="width:500px !important; float:left !important;"><?php echo $post->titulo; ?></h3>
                        <div style="display:block; font-size:12px; float:left;"><?php echo $post->descricao; ?></div>
						 <h2 class="h2-data-pesquisa" style="float:left;"><?php echo date('d.m.Y', strtotime($post->data)); ?></h2>
	                     <div style="margin-bottom: 20px; margin-right: 10px; width:375px;" id="postBlog"><?php echo $post->texto; ?></div>

	                      <div style=" height: 0; left: -100px; position:relative; top: -222px; width:87px; border:none;" id="lateral-left-publicacoes-artigos">


	                        <div style="border-top:none; padding-top:10px; margin-top:7px;" class="ver-mais-artigos">
	                        	<img src="<?php echo base_url(); ?>assets/img/ver.png"><br />
	                        	<a href="<?php echo site_url('blog/index?colunista='.$post->colunista_id); ?>">Ver mais artigos deste autor</a>
	                        </div>

	                        <div style="border-top:thin solid #9c9c9c; padding-top:10px; margin-top:7px;" class="ver-mais-artigos">
	                        	<img src="<?php echo base_url(); ?>assets/img/icon-msg.png"><br />
	                        	<a href="#">Enviar por email</a>
	                        </div>

	                        <div style="border-top:thin solid #9c9c9c;" class="ver-mais-artigos">
	                        	Compartilhar:<br/> <a href="#"><img src="<?php echo base_url(); ?>assets/img/icon-facebook-black.png"></a>
	                        	<a href="#"><img src="<?php echo base_url(); ?>assets/img/icon-twitter-black.png"></a>
	                        </div>
	                      </div>


                      <a class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>comentarios?ID=<?php echo$post->id?>&area=POS&tituloarea=Blog">

                       <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_pinterest_pinit"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50e46428470658b3"></script>
<!-- AddThis Button END -->

                       <a class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>comentarios?ID=<?php echo $post->id?>&area=POS&tituloarea=<?php echo $post->titulo; ?>"><img src="<?  echo base_url(); ?>assets/img/button-comentario.png" alt="Fazer um comentário" title="Fazer um comentário" /></a>



                   </a>



					<?php endif; ?>


					<?php if($comentarios): ?>
	                      <div id="publicacoes-artigos-comentarios" style="margin-left: -110px; width: 465px !important;">

	                      <h3 style="left:110px; position:relative;">comentários</h3>

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


                  </div>            </div>

                    </div>
                  </div>
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