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
                        <li><a href="<?php echo site_url('multimidia/videos'); ?>">Videos</a></li>
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
                     <p>&nbsp;</p>

                    <div id="paginationdemo" class="demo">

                    <div id="p1" class="pagedemo _current" style="">

					<?php if($videos): ?>
		                <?php foreach($videos as $video): ?>

							<div id="video-in-lista" style="margin-top:20px; display:inline-block;">
                                                            <div class="box-foto" style="float:left; margin-right:5px;"><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $video->imagem; ?>" alt="quem somos" width="194" height="142"  align="left">
			                     </div>
			                    <div class="texto-descricao-video">
			                     <h3><?php echo personalizar_data('d.m.Y', $video->data); ?></h3>
			                     <h4><?php echo $video->titulo; ?></h4>
								<?php echo $video->descricao; ?>
								<a href="<?php echo site_url('multimidia/ver_video/'.$video->id.'/'.$video->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-vermelho-assista.png" class="btn-vermelho-assista-video"></a>
								</div>
			                     <p></p>
		                      </div>
		                  <?php endforeach; ?>

		                  <?php echo ($paginacao ? $paginacao : ''); ?>
		              <?php endif; ?>

                    </div>
            </div>
                    </div>

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