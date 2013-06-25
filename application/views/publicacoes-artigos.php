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
                        <li><a>Publicações ></a></li>
                        <li><a href="<?php echo site_url('publicacoes/artigos'); ?>">Artigos</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3 style="color:#ff3600;">Artigos</h3>
                    <div class="txt-interna" >
                     <?php if(isset($pagina) && $pagina): ?>
                     	<?php echo $pagina->texto; ?>
                     <?php endif; ?>


						<div style="width:100%;">
	                     <div class="box-search-noticias">
					    <h3 style=" width:206px; line-height:100%;">&nbsp;</h3>
					    	<form action="<?php echo site_url('publicacoes/artigos') ?>" method="GET">
								<input type="text" name="busca_artigo" id="busca_artigo" placeholder="Buscar" class="inputBuscarCurso" style="left:130px; top:-16px;" />
						    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" style="margin-top:-15px;" />
						    </form>
					    </div>
				    	</div>


                     <p>&nbsp;</p>

                    <div id="paginationdemo" class="demo">

	                    <?php if($artigos): ?>

							<div id="p1" class="pagedemo _current" style="">

		                    <?php foreach($artigos as $artigo): ?>
								<div id="artigo-in-lista" style="display:inline-block; margin-bottom:40px;">
				                     <div class="box-foto" style="float:left;"><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $artigo->imagem; ?>" alt="quem somos" width="85" align="left">
				                     <span class="borda" style="position:relative; left:0px; top:0px;"></span>
				                     </div>

				                     <div class="texto-interna-artigos">
				                     <h4><?php echo $artigo->titulo; ?></h4>
				                     <h5><?php echo $artigo->autor; ?></h5>
									  <?php echo $artigo->descricao; ?>
										<a href="<?php echo site_url('publicacoes/ver_artigo/'.$artigo->id.'/'.$artigo->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-artigos.png"></a>
									</div>
				                     <p></p>

				                     <div class="veja-fotos-quem-somos" style="color:#ff3600;">

				                      </div>

			                      </div>
		                      <?php endforeach; ?>

		                    </div>

		                    <?php echo (isset($paginacao) && $paginacao ? $paginacao : ''); ?>

	                    <?php endif; ?>
            </div>



                    </div>

                  </div>
                </div>
                <div class="center2">
                 <div id="destaques" style="border:none;">
                  	<?php include("includes/center-publicacoes.php");?>
                 </div>
                </div>
                <div class="vejaTambemPublicacoes" style="height:300px;">
					<?php include("includes/veja-tambem-publicacoes-artigos.php"); ?>
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