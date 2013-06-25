<?php 

	include("includes/topo.php"); 

?>

            

            

          <?php include("includes/banner-interna.php"); ?>

           

            <div class="content">

              <div class="content-interna">

             

                <div class="left-internas2">

                  <div class="breadcrumb">

                       <ul>

                        <li><a href="<?php echo site_url();?>index.php">Home ></a></li>

                        <li><a>Serviços ></a></li>

                        <li><a href="educacao_corporativa">Educação Coorporativa</a></li>

                       </ul>

                  </div>

                  <div class="miolo-interna">

                  

                    <h3><?php echo($pagina->titulo);?></h3>

                    <div class="txt-interna-servicos">

                        <?php echo($pagina->texto);?>

</div>

                    <h3>ALGUNS PROJETOS</h3>

                  	

                    <div class="txt-interna-servicos">

                    <?php

					 include('includes/servicos-sanfona-pessoas.php');

					 ?>

                     </div>

                    

                  </div>	

                </div>

                

                <div class="vejaTambem" style="height:440px;">

					<?php include("includes/veja-tambem-servicos.php"); ?>

				</div>

					<?php include("includes/box-destaques.php");?>

              </div>

              <div class="right" style="min-height:1241px;">

                	<?php 

						include("includes/servicos-home.php");

					?>

              </div>

				

				

				

				

				

            </div>



<?php 

	include("includes/rodape.php"); 

?>