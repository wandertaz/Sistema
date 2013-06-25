<?php
include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>
          
<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>

    <?php //include("includes/banner-interna.php"); ?>

            <div class="content">
              <div class="content-interna">
                <div class="left-internas">
                   <div class="breadcrumb">
                       <ul>
                        <li><a href="<?php echo site_url(); ?>">Home ></a></li>
                        <li><a>Educação Corporativa > </a></li>
                        <li><a href="<?php echo site_url('autodiagnosticos'); ?>">Autodiagnósticos > </a></li>
                        <li><a><?php echo $autodiagnostico->nome; ?></a></li>
                       </ul>
                  </div>
				  <div class="miolo-interna">
					<div class="cursos" style="border:none;">
						<h3>Autodiagnóstico</h3>
					    <div class="text-cursos">
					    	<?php if(isset($pagina) && $pagina): ?>
					        	<?php echo $pagina->texto; ?>
					        <?php endif; ?>
					    </div>
					    <div class="box-search-cursos">
					    	<h3 style=" width:206px; line-height:100%;"></h3>
					    	<form action="<?php echo site_url('autodiagnosticos/index'); ?>" method="GET">
								<input type="text" name="busca" id="buscarCurso" placeholder="Buscar Autodiagnóstico" class="inputBuscarCurso" />
						    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />
					    	</form>
					    </div>

						<?php if($autodiagnostico): ?>
						    <div style="display:inline-block;">
						    <img src="<?php echo base_url();?>assets/img/icone-autodiagnostico.jpg" style="margin-left:31px" align="left"/>
						    <h3 style="border:none; width:200px; position:relative; top:-5px;"><?php echo $autodiagnostico->nome_tipo; ?></h3>
						    <h3 style="color:black; border:none; width:250px; margin:0px; padding:0px;"><?php echo $autodiagnostico->nome; ?></h3>

						    <div class="text-cursos">
						    	<p>Sobre: <?php echo $autodiagnostico->texto; ?></p>

						    	<span class="valor">VALOR:</span> R$ <?php echo number_format($autodiagnostico->preco, 2, ',', '.'); ?>

						    	<a href="<?php echo site_url('carrinho/adicionar/'.$autodiagnostico->id_autodiagnostico.'/AU'); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-comprar-vermelho.jpg"></a>

						    	<span class="voltar"><a href="<?php echo site_url('autodiagnosticos'); ?>">Voltar</a></span>

						    	</div>
						    </div>
						<?php endif; ?>

					</div>
					<div style="clear: both;"></div>

                </div>
				</div>
				 <div class="center2">
				   <?php
				   //include("includes/center-interna.php");
				   ?>
                                     	<?php 
                                        
                                        //include("includes/box-destaques-blog.php");
                                        include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'center-interna.php';
                                        
                                        ?>
                 </div>
				<div class="vejaTambem">
					<?php 
                                        
                                        //include("includes/veja-tambem.php"); 
                                        include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'veja-tambem.php';
                                        ?>
				</div>

					<?php 
                                        
                                        //include("includes/box-destaques-blog.php");
                                        include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'box-destaques-blog.php';
                                        
                                        ?>

               </div>
				<div class="right">
                	<?php
                	//include("includes/servicos-home.php");
                	?>
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