<?php
	include("includes/topo.php");
?>
          <?php include("includes/banner-blog.php"); ?>

            <div class="content blog">
              <div class="content-interna" style="background:#231F20;">

                <div class="left-internas">
                  <div class="breadcrumb">
                       <ul>
                        <li><a href="<?php echo site_url(); ?>">Home ></a></li>
                        <li><a href="<?php echo site_url('blog'); ?>">Blog</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3 style="color:#ff3600;"><?php echo ($titulo ? $titulo : 'Blog'); ?></h3>
                    <div class="txt-interna">

                        <?php if(isset($fotocolunista)&&$fotocolunista): ?>
                        <div class="box-foto" style="float: left;">
                            <img width="53" height="63" style="margin-right:4px" title="" alt="" src="<?php echo site_url();?>assets/uploads/<?php echo $fotocolunista;?>">
                        </div>
                        <?php endif; ?>

                     <?php if(isset($texto) && $texto): ?>
                     	<p><?php echo $texto; ?></p>
                     <?php elseif($titulo == 'Blog'): ?>
			        	<?php echo $pagina->texto; ?>
			        <?php endif; ?>
					</div>
				    <div class="box-search-blog">
				    	<h3 style=" width:206px; line-height:100%;">Todos os</br>posts</h3>

				    	<form action="<?php echo site_url('blog/index'); ?>" method="GET">
							<input type="text" name="busca" id="buscarCurso" placeholder="Buscar Post" class="inputBuscarCurso" style="top:13px;" />
					    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />
				    	</form>
				    </div>

				<?php if($posts): ?>
                  <div class="txt-interna">
                    <div id="paginationdemo" class="demo">
                    <div id="p1" class="pagedemo _current" style="">

                    	<?php foreach($posts as $post): ?>
							<div id="artigo-in-lista">
		                     <div class="box-foto" style="float:left;"><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $post->imagem; ?>" alt="" width="85" height="114" align="left">
		                     <span class="borda" style="position:relative; left:0px; top:0px;"></span>
		                     </div>

		                     <div class="texto-interna-artigos">

			                     <h4><?php echo $post->colunista; ?></h4>
                                 <h3 style="margin-top:0px; font-size:11px;"><?php echo $post->titulo; ?></h3>
								 <?php echo $post->descricao; ?>
								<a href="<?php echo site_url('blog/ver_post').'/'.$post->id.'/'.$post->url; ?>"><img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-preto.png" style="padding-bottom: 2.5em"></a>
							</div>
		                     <p>&nbsp;</p>

		                      </div>
		                  <?php endforeach; ?>

			                    </div>


		            </div>

		            <?php echo ($paginacao ? $paginacao : ''); ?>

                   </div>
               <?php else: ?>
               		Nenhum post foi encontrado.

                <?php endif; ?>

                  </div>
                </div>
                <div class="center-blog">
					<?php include("includes/center-blog.php"); ?>
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