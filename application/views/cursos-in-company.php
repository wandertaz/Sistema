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
                        <li><a>Educação Corporativa > </a></li>
                        <li><a href="<?php echo site_url('educacao_corporativa/cursos_incompany'); ?>">Cursos "In Company" </a></li>
                       </ul>
                  </div>
				  <div class="miolo-interna">
					<div class="cursos">
						<h3>Cursos "In Company"</h3>
					    <div class="text-cursos">
					    	<?php if(isset($pagina) && $pagina): ?>
					        	<?php echo $pagina->texto; ?>
					        <?php endif; ?>
					    </div>
					    <div class="box-search-cursos">
					    	<h3 style=" width:206px; line-height:100%;">Relação de Cursos</h3>
					    	<form action="<?php echo site_url('educacao_corporativa/cursos_incompany'); ?>" method="GET">
								<input type="text" name="busca" id="buscarCurso" placeholder="Buscar Curso" class="inputBuscarCurso" />
						    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />
					    	</form>
					    </div>
                                            <?php if(isset($pagina->arquivo)): ?>
					    <a href="<?php echo isset($pagina) && $pagina->arquivo ? base_url('assets/uploads/'.$pagina->arquivo) : ''; ?>" target="_blank" class="down-programacao">Fazer <span>download</span> de toda a programação</a>
					 <?php endif;?>
                                        </div>

					<div style="clear: both;"></div>


					<?php if($cursos): ?>
						<?php foreach($cursos as $curso): ?>
							<div class="grade">
								<div class="box-foto"><img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $curso->imagem; ?>" width="102" height="160" alt="" /><span></span></div>
		                        <div class="text-programacao">
                                   <!-- <h4><?php echo br_date($curso->data_inicio); ?> à <?php echo br_date($curso->data_conclusao); ?></h4> -->
			                        <h5><?php echo $curso->titulo; ?></h5>
									<p><?php echo $curso->descricao; ?></p>
									<a href="<?php echo site_url('educacao_corporativa/ver_curso_incompany/'.$curso->id.'/'.$curso->url); ?>" class="ler-mais">Ler mais</a>
		                        </div>
		                        <div class="links">
                                            <?php if (trim($curso->folder)!=''):?>
			                        <img img src="<?php echo base_url(); ?>assets/img/icon-download.png" />Fazer <a href="<?php echo base_url(); ?>assets/uploads/<?php echo $curso->folder; ?>" target="_blank">download</a> do folder
                                             <?php else:?>
                                                <img img src="<?php echo base_url(); ?>assets/img/icon-download.png" />Fazer <a >download</a> do folder
                                            <?php endif;?>

									<span class="sep"></span>
			                        <img src="<?php echo base_url(); ?>assets/img/icon-pen.png" /><a class="various" data-fancybox-type="iframe" href="<?php echo site_url('educacao_corporativa/solicitar_proposta/IN/'.$curso->id); ?>">Solicitar</a> proposta comercial


							    </div>
		                    </div>
		                <?php endforeach; ?>
		                <div class="pagination-courses">
		                <?php echo ($paginacao ? $paginacao : ''); ?>
		                </div>
                         <?php else: ?>
                                       <br> Nenhum curso foi encontrado!
	                <?php endif; ?>

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