<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>

<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>

          <?php //include("includes/banner-interna.php"); ?>

            <div class="content">
              <div class="content-interna">
                <div class="left-internas" style="width:710px;">
                   <div class="breadcrumb">
                       <ul>
                        <li><a href="#">Home ></a></li>
                        <li><a href="#">Bussiness Store > </a></li>
                        <li><a href="#">Autodiagnóstico</a></li>
                       </ul>
                  </div>
				  <div class="miolo-interna">
                     <h3>Autodiagnóstico</h3>
                     	<div class="text-cursos-ad" style="float:left; margin-left:65px;">
					    	<?php if(isset($pagina) && $pagina): ?>
					        	<?php echo $pagina->texto; ?>
					        <?php endif; ?>
					    </div>

                     <div style="clear:both;"></div>

                     <h3 style="display:inline-block;">Autodiagnósticos Oferecidos</h3>

					 <div style="clear:both;"></div>

					 <?php if($autodiagnosticos): ?>

						<div style="width:700px; min-height:300px; margin-left:30px;">

							<?php foreach($autodiagnosticos as $autodiagnostico): ?>
								<div class="lista-autodiagnostico">
									<img src="<?php echo base_url();?>assets/img/icone-autodiagnostico.jpg" align="left"/>
									<h1><?php echo $autodiagnostico->nome_tipo; ?></h1>
									<a href="<?php echo site_url('autodiagnosticos/ver_autodiagnostico/'.$autodiagnostico->id_autodiagnostico.'/'.$autodiagnostico->url); ?>"><h2><?php echo $autodiagnostico->nome; ?></h2></a>
									<p><?php echo $autodiagnostico->breve_descricao; ?></p>
									<h3>R$ <?php echo number_format($autodiagnostico->preco, 2, ',', '.'); ?></h3>
									<a href="<?php echo site_url('carrinho/adicionar/'.$autodiagnostico->id_autodiagnostico.'/AU'); ?>"><img src="<?php echo base_url();?>assets/img/btn-comprar-peq.png"/></a>
								</div>
							<?php endforeach; ?>

							<div class="pagination-courses">
								<?php echo $paginacao ? $paginacao : ''; ?>
							</div>
						</div>
					<?php endif; ?>

                </div>
				</div>

				<div class="vejaTambem">					
                                    <?php
                                        include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'veja-tambem.php';
                                        ?>
				</div>
                                        <?php
                                            include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'box-destaques-blog.php';
                                        ?>

					
               </div>
				<div class="right">
             
                                        <?php
                                        include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'servicos-home.php';
                                        ?>
                </div>
            </div>

<?php
	//include("includes/rodape.php");
?>

<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
?>