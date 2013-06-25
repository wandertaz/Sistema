<?php

	include("includes/topo.php");

?>





          <?php include("includes/banner-interna.php"); ?>



            <div class="content">

              <div class="content-interna">



                <div class="left-internas" style="width:710px;">

                  <div class="breadcrumb">

                       <ul>

                        <li><a href="<?php echo site_url();?>index.php">Home ></a></li>

                        <li><a>Quem Somos ></a></li>

                        <li><a>Nossos Clientes</a></li>

                       </ul>

                  </div>

                  <div class="miolo-interna">



                    <h3>Nossos Clientes</h3>

                    <div class="txt-interna" style="width:710px;">

                     <?php echo($pagina->texto);?>
                      <div class="veja-fotos-quem-somos">
                      </div>

                    </div>



                  </div>

                </div>

                

                <div class="vejaTambem" style="margin-top:0px;">

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