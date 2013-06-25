<?php 
	include("includes/topo-interna.php"); 
?>
            
            
            <?php include("includes/banner.php"); ?>
            
            <div class="content">
                <div class="left">
                	<?php 
						include("includes/cursos-interna.php");
						include("includes/programacao-interna.php");
					?>
                </div>
                <div class="center"><?php 
						include("includes/center-interna.php");
					?></div>
                <div class="right">
                	<?php 
						include("includes/servicos-home.php");
					?>
                </div>
				
				<div class="vejaTambem">
					<?php include("includes/veja-tambem.php"); ?>
				</div>
				
				<div class="ultimasPostagens">
					<?php include("includes/ultimas-postagens.php");?>
				</div>
				
            </div>

<?php 
	include("includes/rodape.php"); 
?>