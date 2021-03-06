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
                        <li><a href="<?php echo site_url('educacao_corporativa/cursos_abertos'); ?>">Cursos Abertos ></a></li>
                        <li><a href="#"><?php echo ($curso ? $curso->titulo : ''); ?></a></li>
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
					    <div class="header-grade">
					    	<h3>Curso</h3>
					    </div>
					</div>

					<?php if($curso): ?>
                                      <?php if($curso->folder!=''): ?>
					<p class="down-programacao-grade"><a href="<?php echo base_url('assets/uploads').'/'.$curso->folder; ?>" target="_blank" class="down-programacao">Fazer <span>download</span> de toda a grade</a></p>
					<div style="clear: both;"></div>
                                      <?php endif;?>

					<div class="grade">
                        <div class="text-curso">

                        	<?php if($this->session->flashdata('msg')): ?>
                        		<div id="msg"><?php echo $this->session->flashdata('msg');?></div><br />
                        	<?php endif; ?>

	                        <h4><?php echo $curso->titulo; ?></h4>

							<p><?php echo $curso->texto; ?></p>

							<div id="tabs_wrapper">
								<ul id="tabs">
									<li class="active tab1"><a href="#tab1">Conteúdo</a><span></span></li>
									<li class="tab2"><a href="#tab2">Instrutor</a><span></span></li>
									<li class="tab3"><a href="#tab3">Diferenciais</a><span></span></li>
								</ul>

								<div id="tabs_content_container">
									<div id="tab1" class="tab1 tab_content" style="display: block;">
										<p><?php echo $curso->conteudo; ?></p>
									</div>
									<div id="tab2" class="tab2 tab_content">
										<p><?php echo $curso->instrutor; ?></p>
									</div>
									<div id="tab3" class="tab3 tab_content">
										<p><?php echo $curso->requisitos; ?></p>
									</div>
								</div>
							</div>

	                        <div class="share">
                                     <?php if (trim($curso->folder)!=''):?>
		                        <p><img src="<?php echo base_url(); ?>assets/img/icon-download.png" alt="" /><br />Fazer <a href="<?php echo base_url('assets/uploads').'/'.$curso->folder; ?>" target="_blank">download</a> do folder</p>
		                        <span class="sep"></span>
                                      <?php endif;?>
		                        <p><img src="<?php echo base_url(); ?>assets/img/icon-person.png" alt="" /><br /><a href="<?php echo site_url(); ?>gerenciamento_email/indicar_amigo/<?php echo $curso->id; ?>/AB" data-fancybox-type="iframe" class="various">Indicar</a> para um amigo</p>
	                        </div>

							<p>
							<span class="sub-title">Carga horária:</span> <?php echo $curso->carga_horaria; ?><br />
							<span class="sub-title">VALOR DO CURSO:</span> <?php echo $curso->valor; ?><br />
							<span class="sub-title">Período:</span><?php echo br_date($curso->data_inicio); ?> à <?php echo br_date($curso->data_conclusao); ?><br />
							<span class="sub-title">Horário:</span> <?php echo $curso->horario; ?><br />
							<span class="sub-title">Local:</span><?php echo $curso->local; ?>
							</p>

							<?php if($turmas): ?>
							<p>
                                                                
								<span class="sub-title">TURMAS</span><br />
								<?php foreach($turmas as $turma): ?>
									<?php echo br_date($turma->data_inicial); ?> 
                                                                       
                                                                         <?php if (check_permissao_cadastramento($curso->id,'AB',$turma->id)):?>
                                                                            <img img src="<?php echo base_url(); ?>assets/img/icon-pen.png" />
                                                                            Fazer <a style="text-decoration: none;color: #F7931E;" href="<?php echo site_url('carrinho/adicionar/'.$curso->id.'/AB/'.$turma->id); ?>">inscrição</a><br />
                                                                        <?php else:?>
                                                                             <img img src="<?php echo base_url(); ?>assets/img/icon-pen.png" />
                                                                              <a href="<?php echo site_url('gerenciamento_email/avise_me/'.$curso->id.'/AB'); ?>" data-fancybox-type="iframe" class="various">Avise-me de novas turmas</a>                                                                            
                                                                        <?php endif;?>                                                                             
								<?php endforeach; ?>
							</p>

							<?php else: ?>

								<p>
										<br /><span class="sub-title">Ainda não há turmas disponíveis.</span>
									</p>
							<?php endif; ?>
                        </div>
                    </div>


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













<script type="text/javascript">
$(document).ready(function(){
	$("#tabs li").click(function() {
		$("#tabs li").removeClass('active');
		$(this).addClass("active");
		$(".tab_content").hide();
		var selected_tab = $(this).find("a").attr("href");
		$(selected_tab).fadeIn();
		return false;
	});
});
</script>