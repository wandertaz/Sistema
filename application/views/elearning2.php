<?php

	include("includes/topo.php");
?>
          <?php include("includes/banner-interna.php"); ?>



            <div class="content noticias">

              <div class="content-interna">



                <div class="left-internas" style="width:710px;">

                  <div class="breadcrumb">

                       <ul>

                        <li><a href="<?php echo site_url(); ?>">Home ></a></li>
                        <li><a>Educação Corporativa ></a></li>
                        <li><a>E-learning</a></li>

                       </ul>

                  </div>

                  <div class="miolo-interna">

                    <h3 style="color:#ff3600;">E-learning</h3>

                    <div class="txt-interna" style="width:710px;">

                         <?php if(isset($pagina) && $pagina): ?>
					        	<?php echo $pagina->texto; ?>
					        <?php endif; ?>
                   </div>

				    <div class="box-search-noticias">

				    	<h3 style=" width:206px; color:#f8931f; border:none; width:100px; line-height:100%;">Curso em Destaque</h3>

						<form action="<?php echo site_url('educacao_corporativa/elearning'); ?>" method="get">
							<input type="text" name="busca" id="buscarCurso" placeholder="Buscar Curso" class="inputBuscarCurso" style="top:13px; left:368px;"/>
							<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />
						</form>

				    </div>

                  <div class="txt-interna" style="width:710px;">

                    <div id="paginationdemo" class="demo" style="width:710px;">

                    <div id="p1" class="pagedemo _current" style="">


                    <div id="artigo-in-lista" style="width:700px;">

                      <?php foreach ($cursos as $curso): ?>

                                <div class="texto-interna-news" style="width:320px;">

                                   	<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $curso->imagem; ?>" width="101" height="61">

                                       <h6 style="display:inline-block; position:relative; top:-20px;"><?php echo($curso->titulo);?></h6>

                                       <p><?php echo $curso->descricao;?>

                                         <a href="<?php echo site_url('educacao_corporativa/ver_elearning/'.$curso->id.'/'.$curso->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-comprar-peq.png"></a></p>

                                </div>

                     <?php endforeach;?>



                      </div>

                    <div class="pagination-courses">
                    <?php echo ($paginacao ? $paginacao : ''); ?>
                    </div>

                    </div>
            </div>

                    </div>



                  </div>

                </div>

                <div class="vejaTambem" style="height:300px;">
					<?php include("includes/veja-tambem.php"); ?>
				</div>

              </div>

              <div class="right">

                	<?php include("includes/servicos-home.php"); ?>

              </div>

            </div>



<?php

	include("includes/rodape.php");

?>