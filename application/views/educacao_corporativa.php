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
                        <li><a >Educação Corporativa > </a></li>
                       </ul>
                  </div>
				  <div class="miolo-interna">
					<div class="cursos">
						<h3>Educação Corporativa</h3>
					    <div class="text-cursos">
					    	<?php if(isset($pagina) && $pagina): ?>
					        	<?php echo $pagina->texto; ?>
					        <?php endif; ?>
					    </div>

					</div>

                </div>
				</div>
				 <div class="center2">
				   <?php
				   include("includes/center-interna.php");
				   ?>
                 </div>
				<div class="vejaTambem">
					<?php include("includes/veja-tambem.php"); ?>
				</div>

					<?php include("includes/box-destaques-blog.php");?>

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