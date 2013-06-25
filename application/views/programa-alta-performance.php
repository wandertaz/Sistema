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
                        <li><a>Educação Corporativa ></a></li>
                        <li><a href="<?php echo site_url('educacao_corporativa/alta_performance'); ?>">Programa Alta Performance</a></li>
                       </ul>
                  </div>
				  <div class="miolo-interna">
					<div class="cursos">
						<h3>Programa Alta Performance</h3>
					    <div class="text-cursos">
					    	<?php if(isset($pagina) && $pagina): ?>
					        	<?php echo $pagina->texto; ?>
					        <?php endif; ?>
					    </div>
					    <div class="header-grade">
					    	<h3>Grade do</br>programa</h3>
					    </div>
					</div>

					<?php if($cursos): ?>
                                                <?php if(isset($pagina->arquivo)): ?>
						<p class="down-programacao-grade"><a href="<?php echo isset($pagina) && $pagina->arquivo ? base_url('assets/uploads/'.$pagina->arquivo) : ''; ?>" target="_blank" class="down-programacao">Fazer <span>download</span> de toda a grade</a></p>
						<div style="clear: both;"></div>
                                                <?php endif;?>

						<?php foreach($cursos as $curso): ?>
							<div class="grade">
							    <div class="box-foto"><img  width="102" height="160" src="<?php echo base_url(); ?>assets/uploads/<?php echo $curso->imagem; ?>" alt="" /><span></span></div>
		                        <div class="text-programacao">
			                        <h4><?php echo br_date($curso->data_inicio); ?> à <?php echo br_date($curso->data_conclusao); ?></h4>
			                        <h5><?php echo $curso->titulo; ?></h5>
									<p><?php echo $curso->descricao; ?></p>
									<a href="<?php echo site_url('educacao_corporativa/ver_alta_performance/'.$curso->id.'/'.$curso->url); ?>" class="ler-mais">Ler mais</a>
		                        </div>
		                        <div class="links">
			                        <img src="<?php echo base_url(); ?>assets/img/icon-download.png" />Fazer <a href="<?php echo base_url(); ?>assets/uploads/<?php echo $curso->folder; ?>" target="_blank">download</a> do folder

                                               
                                                
                                                <?php if (check_permissao_cadastramento($curso->id,'AL')):?>
                                                <span class="sep"></span>
			                        <img img src="<?php echo base_url(); ?>assets/img/icon-pen.png" />
                                                Fazer <a href="<?php echo site_url('carrinho/inscricao/'.$curso->id.'/AL'); ?>">inscrição</a>
                                                <?php else:?>
                                                    <span class="sep"></span>
                                                    <img img src="<?php echo base_url(); ?>assets/img/icon-pen.png" />
                                                    <a href="<?php echo site_url('gerenciamento_email/avise_me/'.$curso->id.'/AL'); ?>" data-fancybox-type="iframe" class="various">Avise-me de novas turmas</a>
                                                <?php endif;?> 

		                        </div>
		                    </div>
		                <?php endforeach; ?>

		                <div class="pagination-courses">
		                <?php echo ($paginacao ? $paginacao : ''); ?>
		                </div>
					<?php endif; ?>

                </div>
				</div>
				 <div class="center3">
				   <?php
						include("includes/center-interna-alta-performance.php");
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