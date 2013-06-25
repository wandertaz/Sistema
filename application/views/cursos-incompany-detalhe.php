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
                        <li><a href="<?php echo site_url('educacao_corporativa/cursos_incompany'); ?>">Cursos "In Company" ></a></li>
                        <li><a href="#"><?php echo ($curso ? $curso->titulo : ''); ?></a></li>
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
					    <div class="header-grade">
					    	<h3>Curso</h3>
					    </div>
					</div>

					<?php if($curso): ?>
                    
                                       <p class="down-programacao-grade">                                          
                                            <span class="sep"></span>
			                    <img src="<?php echo site_url('assets/img/icon-pen.png')?>">
                                            <a class="various" data-fancybox-type="iframe" href="<?php echo site_url('educacao_corporativa/solicitar_proposta/IN/'.$curso->id); ?>">Solicitar</a> proposta comercial
                                       </p>                                   
                                     <!-- <p class="down-programacao-grade"><a href="<?php //echo base_url('assets/uploads').'/'.$curso->folder; ?>" target="_blank" class="down-programacao">Fazer <span>download</span> de toda a grade</a></p>-->
                 	
						<div style="clear: both;"></div>
                   

                    <div class="grade">
                    	<div class="text-curso">
                    		<h4><?php echo $curso->titulo; ?></h4>
                    		<p>
                    			<?php echo $curso->texto; ?>
                    		</p>
                    		<div id="tabs_wrapper" style="margin-bottom:0;">
                    			<ul id="tabs">
                    				<li class="active tab1"><a href="#tab1">Objetivos</a><span></span></li>
                                                <li class="tab2"><a href="#tab2">Conteúdo</a><span></span></li>
                                                
                    				<!--<li class="tab2"><a href="#tab2">Público Alvo</a><span></span></li>
                    				<li class="tab3"><a href="#tab3">Pré-requisitos</a><span></span></li>-->
                    			</ul>
                    		</div>
							<div id="tabs_content_container">
								<div id="tab1" class="tab1 tab_content" style="display: block;">
									<p><?php echo $curso->objetivos; ?></p>
								</div>
								<div id="tab2" class="tab2 tab_content">
									<p><?php echo $curso->publico_alvo; ?></p>
								</div>
								<!--<div id="tab3" class="tab3 tab_content">
									<p><?php //echo $curso->requisitos; ?></p>
								</div>-->
							</div>
	                    	<div class="share">
	                    		<?php if (trim($curso->folder)!=''): ?>
	                    		<p><img src="<?php echo base_url(); ?>assets/img/icon-download.png" alt="" /><br />Fazer <a href="<?php echo base_url('assets/uploads').'/'.$curso->folder; ?>" target="_blank">download</a> do folder</p>
	                    		<span class="sep"></span>
	                    		<?php endif; ?>
	                    		<p><img src="<?php echo base_url(); ?>assets/img/icon-person.png" alt="" /><br /><a href="<?php echo site_url(); ?>gerenciamento_email/indicar_amigo/<?php echo $curso->id; ?>/IN" data-fancybox-type="iframe" class="various">Indicar</a> para um amigo</p>
	                    	</div>

	                    	<div style="margin-top: 15px;">
	                    		<p><span class="sub-title">CARGA HORÁRIA:</span> <?php echo $curso->carga_horaria; ?><br /></p>
	                    		<!--<a href="<?php //echo site_url('carrinho/adicionar/'.$curso->id.'/IN'); ?>" class="button-inscricao">Fazer inscrição</a>-->
                                        
	                    	</div>
                                <div class="links">

							   
                                
                                        <img src="<?php echo base_url(); ?>assets/img/icon-pen.png" /><a class="various" data-fancybox-type="iframe" href="<?php echo site_url('educacao_corporativa/solicitar_proposta/IN/'.$curso->id); ?>">Solicitar</a> proposta comercial
                                </div>
                                </div>




                	</div>
            	</div>


				<?php endif; ?>

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