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
                        <li><a href="<?php echo site_url('multimidia/podcasts'); ?>">&Aacute;udios</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3 style="color:#ff3600;">PODCAST</h3>
                    <h3 style="color:#ff3600; width:100px; position:relative; top:100px; border:none;">TODOS OS PODCASTS</h3>
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


                    <div id="paginationdemo" class="demo">

					<?php if($podcasts): ?>
						<div id="p1" class="pagedemo _current" style="">

						<?php foreach($podcasts as $podcast): ?>
		                    <div id="podcast-in-lista">
			                     <div class="box-foto" style="float:left;"><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $podcast->imagem; ?>" alt="quem somos" width="73" align="left">
			                     </div>
			                     <div class="texto-interna-artigos">
			                     <h3 style="border:none; color:#FF3600; font-size:12px; margin-top:0px; font-style:italic;"><?php echo personalizar_data('d.m.Y', $podcast->data); ?></h3>
			                     <h4><?php echo $podcast->titulo; ?></h4>
								<?php echo $podcast->descricao; ?>
								<a href="<?php echo site_url('multimidia/ver_podcast/'.$podcast->id.'/'.$podcast->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-ouvir-grande.png"></a>
								</div>
			                     <p></p>
		                      </div>
		                  <?php endforeach; ?>

		                  <?php echo $paginacao ? $paginacao : ''; ?>

	                    </div>
                <?php endif; ?>
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