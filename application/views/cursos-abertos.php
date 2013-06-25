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
                        <li><a >Educação Corporativa > </a></li>
                        <li><a href="<?php echo site_url('educacao_corporativa/cursos_abertos'); ?>">Cursos Abertos </a></li>
                       </ul>
                  </div>
				  <div class="miolo-interna">
					<div class="cursos">
						<h3>Cursos Abertos</h3>
					    <div class="text-cursos">
					    	<?php if(isset($pagina) && $pagina): ?>
					        	<?php echo $pagina->texto; ?>
					        <?php endif; ?>
					    </div>
					    <div class="box-search-cursos">
					    	<h3 style=" width:206px; line-height:100%;font-size: 14px;">Programação</h3>
					    	<form action="<?php echo site_url('educacao_corporativa/cursos_abertos'); ?>" method="GET">
								<input type="text" name="busca" id="buscarCurso" placeholder="Buscar Curso" class="inputBuscarCurso" />
						    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />
					    	</form>
					    </div>
					     <?php if(isset($pagina->arquivo)): ?>
					    <a href="<?php echo isset($pagina) && $pagina->arquivo ? base_url('assets/uploads/'.$pagina->arquivo) : ''; ?>" target="_blank" class="down-programacao">Fazer <span>download</span> de toda a programação</a>
					 <?php endif;?>
					</div>

					<div style="clear: both;"></div>					
						<h3 style=" width:206px; line-height:100%; border:0;margin-bottom: 10px;font-size: 14px;">Listagem de Cursos</h3>
					<div style="clear: both;"></div>

					<?php if($cursos): ?>
						<?php foreach($cursos as $curso): ?>
							<div class="grade">
							    <div class="box-foto"><img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $curso->imagem; ?>" width="102" height="160" alt="" /><span></span></div>
		                        <div class="text-programacao">
                                            <h4><?php echo br_date($curso->data_inicio); ?> à <?php echo br_date($curso->data_conclusao); ?></h4>
			                        <h5><?php echo $curso->titulo; ?></h5>
									<p><?php echo $curso->descricao; ?></p>
                                        <a href="<?php echo site_url('educacao_corporativa/ver_curso_aberto/'.$curso->id.'/'.$curso->url); ?>" class="ler-mais">Ler mais</a>
		                        </div>
		                        <div class="links">
                                             <?php if (trim($curso->folder)!=''):?>
			                        <img img src="<?php echo base_url(); ?>assets/img/icon-download.png" />Fazer <a href="<?php echo base_url(); ?>assets/uploads/<?php echo $curso->folder; ?>" target="_blank">download</a> do folder
                                             <?php else:?>
                                                <img img src="<?php echo base_url(); ?>assets/img/icon-download.png" />Fazer <a href="#" target="_blank">download</a> do folder
                                                <?php endif;?>


                                                <?php if ($curso->disponivel == 'S'):?>
                                                <span class="sep"></span>
			                        <img img src="<?php echo base_url(); ?>assets/img/icon-pen.png" />
												 <a href="<?php echo site_url('carrinho/inscricao/'.$curso->id.'/AB'); ?>">Ler mais e ver turmas</a>
                                                <?php else:?>
                                                    <span class="sep"></span>
                                                    <img img src="<?php echo base_url(); ?>assets/img/icon-pen.png" />
                                                    <a href="<?php echo site_url('gerenciamento_email/avise_me/'.$curso->id.'/AB'); ?>" data-fancybox-type="iframe" class="various">Avise-me de novas turmas</a>
                                                <?php endif;?>
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