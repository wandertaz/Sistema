<?php 
	include("includes/topo.php"); 
?>
            
            
            <?php include("includes/banner.php"); ?>
            
            <div class="content">
                <div class="left" style="height:1141px;">
                	<?php 
						include("includes/cursos-home.php");
						include("includes/publicacoes-home.php"); 
						include("includes/enquete-home.php"); 
					?>
                </div>
                <div class="center" style="height:1141px;"><?php 
						include("includes/center-home.php"); 
					?></div>
                <div class="right"  style="height:1141px;">
                	<?php 
						include("includes/servicos-home.php"); 
					?>
                </div>
            </div>

<?php 
	include("includes/rodape.php"); 
?>