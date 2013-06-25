<?php include("includes/topo.php"); ?>


          <?php include("includes/banner-interna.php"); ?>

            <div class="content">
              <div class="content-interna">
                <div class="left-internas" style="width:710px;">
                   <div class="breadcrumb">
                       <ul>
                           <li><a href="<?php echo site_url();?>">Home ></a></li>
                        <li><a>Pesquisa site > </a></li>
                       
                       </ul>
                  </div>
				  <div class="miolo-interna">
                     <h3>Pesquisa - site</h3>
                     	<div class="text-cursos-ad" style="float:left; margin-left:65px;">
					    	<?php if(isset($pagina) && $pagina): ?>
					        	<?php echo $pagina->texto; ?>
					        <?php endif; ?>
					    </div>

                     <div style="clear:both;"></div>                    

					 <div style="clear:both;"></div>

					 <?php if($pesquisas): ?>

						<div style="width:700px; min-height:300px; margin-left:30px;">

							<?php foreach($pesquisas as $pesquisa): ?>
                                                      <?php //print_r($pesquisa->link);?>
								<div class="lista-autodiagnostico">									
									<h1><?php echo $pesquisa->area; ?></h1>
									<a href="<?php echo site_url($pesquisa->link); ?>"><h2><?php echo $pesquisa->titulo; ?></h2></a>
									<p><?php echo $pesquisa->descricao; ?></p>									
									<a href="<?php echo site_url($pesquisa->link); ?>"><img src="<?php echo base_url();?>assets/img/btn-leia-mais-laranja-branco.png"/></a>
                                                                        
								</div>
							<?php endforeach; ?>

							<div class="pagination-courses">
								<?php echo $paginacao ? $paginacao : ''; ?>
							</div>
						</div>
                                         <?php else: ?>
                                         <div style="width:700px; min-height:300px; margin-left:30px;">
                                             Nenhum conteúdo foi encontrado
                                         </div>
					<?php endif; ?>

                </div>
				</div>

				<div class="vejaTambem">
                                    <?php include("includes/veja-tambem-Business-store.php"); ?>
                                   
				</div>
                                        <?php include("includes/box-destaques-blog.php"); ?>
                                       
					
               </div>
				<div class="right">
                                       <?php include("includes/servicos-home.php"); ?>
                                       
                </div>
            </div>

<?php
	include("includes/rodape.php");
?>

