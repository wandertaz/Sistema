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
                        <li><a href="<?php echo site_url('multimidia/galerias'); ?>">Galerias de Fotos</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3 style="color:#ff3600;">Galeria de Fotos</h3>
                    <div class="txt-interna">
                     <?php if(isset($pagina) && $pagina): ?>
                     	<?php echo $pagina->texto; ?>
                     <?php endif; ?>

                     <div class="revista-buscar">
	                     <form action="<?php echo site_url('multimidia/galerias'); ?>" method="GET">
								<input type="text" name="busca" id="busca" placeholder="Buscar" class="inputBuscarCurso" style="top:3px;" />
						    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" style="position:relative; top:-11px; right:97px;"/>
						    </form>
                     </div>


                     <p>&nbsp;</p>

				<?php if($galerias): ?>
                    <div id="paginationdemo" class="demo">
	                    <div id="p1" class="pagedemo _current" style="">

						<?php foreach($galerias as $galeria): ?>
							<div id="artigo-in-lista" style="display:inline-block; margin-top:20px;">
		                     <div class="box-foto" style="float:left;"><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $galeria->imagem; ?>" alt="quem somos" width="85" align="left">
		                     <span class="borda" style="position:relative; left:0px; top:0px;"></span>
		                     </div>

		                     <div class="texto-interna-galeria">
		                     <h3><?php echo personalizar_data('d.m.Y', $galeria->data); ?></h3>
		                     <h4><?php echo $galeria->titulo; ?></h4>
		                     <?php echo $galeria->descricao; ?>
		                     <a href="<?php echo site_url('multimidia/ver_galeria/'.$galeria->id.'/'.$galeria->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-ver-galeria.png"></a>
							</div></div>
						<?php endforeach; ?>

	                    </div>

						<?php echo $paginacao ? $paginacao : ''; ?>
            		</div>
            	<?php endif; ?>



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