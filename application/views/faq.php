<?php
	include("includes/topo.php");
?>


          <?php include("includes/banner-interna.php"); ?>

            <div class="content">
              <div class="content-interna">

                <div class="left-internas" style="width:710px; background-color:#A6A6A6;">
                  <div class="breadcrumb" style="border-bottom:solid thin #111;">
                       <ul>
                        <li><a href="home">Home ></a></li>
                        <li><a href="faq" style="color:white;">FAQ</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3 style="color:white;"><?php echo $pagina->titulo; ?></h3>
                    <div class="txt-interna" style="float:left; width:100%;">
                     <p>&nbsp;</p>
                     <?php echo $pagina->texto; ?>
<div class="veja-fotos-quem-somos">
              <a href="#"> <img src="img/ico-veja-fotos.jpg" alt="veja mais fotos"/>Ver mais Fotos</a>
              </div>
                    </div>

                  </div>
                </div>

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