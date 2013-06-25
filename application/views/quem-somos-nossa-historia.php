<?php

	include("includes/topo.php");

?>





          <?php include("includes/banner-interna.php"); ?>



            <div class="content">

              <div class="content-interna">



                <div class="left-internas">

                  <div class="breadcrumb">

                       <ul>

                        <li><a href="<?php echo site_url();?>index.php">Home ></a></li>

                        <li><a>Quem Somos ></a></li>

                        <li><a href="historia">Nossa História</a></li>

                       </ul>

                  </div>

                  <div class="miolo-interna">



                    <h3>Nossa História</h3>

                    <div class="txt-interna">

                     <?php echo($pagina->texto);?>
                      <div class="veja-fotos-quem-somos">
                      </div>

                    </div>



                  </div>

                </div>

                <div class="center2">

                 <div id="destaques">

                  <?php if(isset($banner_depoimento) && $banner_depoimento): ?>
                 	<div class="depoimentos">
						<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $banner_depoimento[0]->imagem; ?>" alt="banner-internas" width="170" />
					</div>
				<?php elseif(isset($depoimentos) && $depoimentos): ?>
	                  <div class="depoimentos">

	                     <h4>Depoimentos</h4>

	                      <?php foreach ($depoimentos as $item):?>

	                     <p><?php echo($item->depoimento);?>

	                     <span><?php echo($item->nome);?> - <?php echo($item->empresa);?></span>

	                     <?php endforeach;?>

	 				</div>
 				<?php endif; ?>

                 </div>

                </div>

                <div class="vejaTambem">

					<?php include("includes/veja-tambem-quem-somos.php"); ?>

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