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
                        <li><a href="<?php echo site_url('publicacoes/pesquisas'); ?>">Pesquisas e estudos</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3 style="color:#ff3600;">Pesquisas e Estudos</h3>
                    <div class="txt-interna" style="width:470px;">
                     <?php if(isset($pagina) && $pagina): ?>
                     	<?php echo $pagina->texto; ?>
                     <?php endif; ?>

                     <div style="width:100%;">

                     <div class="box-search-noticias">
				    <h3 style=" width:206px; line-height:100%;">&nbsp;</h3>
				    	<form action="<?php echo site_url('publicacoes/pesquisas'); ?>" method="GET">
							<input type="text" name="busca" id="busca" placeholder="Buscar" class="inputBuscarCurso" />
					    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />
					    </form>
				    </div>

                     </div>
                     <p>&nbsp;</p>

                    <div id="paginationdemo" class="demo">
                    <div id="p1" class="pagedemo _current" style="">

                  	<?php if($pesquisas_estudos): ?>
                  		<?php foreach($pesquisas_estudos as $pesquisa): ?>
						    <div id="artigo-in-lista">
		                     <div class="box-foto" style="float:left;">
		                     <span class="borda" style="position:relative; left:0px; top:0px;"></span>
		                     </div>

		                     <div class="texto-interna-artigos">
		                     <h4><?php echo $pesquisa->titulo; ?></h4>
								<?php echo $pesquisa->descricao; ?>
								<a href="<?php echo site_url('publicacoes/ver_pesquisas_estudos/'.$pesquisa->id.'/'.$pesquisa->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-artigos.png"></a>
							</div>
		                     <p></p>

		                     <div class="veja-fotos-quem-somos" style="color:#ff3600;">
		                     <a href="#" style="color:#ff3600;"> <img src="<?php echo base_url(); ?>assets/img/eye-red.png" alt="Ver a Revista MB">Ver a Revista MB</a>
		                      </div>
		                      </div>
		                  <?php endforeach; ?>

		                  <?php echo ($paginacao ? $paginacao : ''); ?>

	                  <?php endif; ?>


                    </div>
            </div>



                    </div>

                  </div>
                </div>
                <div class="center2">
                 <div id="destaques" style="border:none;">
                  <?php include("includes/center-publicacoes-artigos.php");?>
                 </div>
                </div>
                <div class="vejaTambemPublicacoes" style="height:300px;">
					<?php include("includes/veja-tambem-publicacoes-pesquisas.php"); ?>
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