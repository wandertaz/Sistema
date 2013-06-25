<!--Veja Tambem---->
<?php if(isset($paginas_cursos) && $paginas_cursos): ?>
	<h1>Veja Também</h1>

	<?php $cont_class = 1; ?>
	<?php foreach($paginas_cursos as $pagina_curso): ?>
		<div id="item-<?php echo $cont_class; ?>">
		   <div class="box-foto">
		   <img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $pagina_curso->imagem; ?>" width="179" height="74" />
		   <span class="borda"></span>
		   </div>
		   <h2><?php echo $pagina_curso->titulo; ?></h2>
		   <p><?php echo $pagina_curso->descricao; ?></p>
                   
                   <?php if($pagina_curso->url =='modulo-de-pesquisa'):?>
                        <a href="<?php echo site_url('pesquisa_online/index/'); ?>">
                            <img img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-laranja-branco.png" />
                        </a>
                   
                   <?php elseif($pagina_curso->url =='central-de-downloads'):?>
                       <a href="<?php echo site_url('central_downloads/lista_downloads'); ?>">
                            <img img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-laranja-branco.png" />
                        </a>
                   <?php elseif($pagina_curso->url =='banco-de-talentos'):?>
                        <a href="<?php echo site_url('banco_talentos_vagas'); ?>">
                            <img img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-laranja-branco.png" />
                        </a>
                   <?php elseif($pagina_curso->url =='autodiagnosticos'):?>
                        <a href="<?php echo site_url('autodiagnosticos/'); ?>">
                            <img img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-laranja-branco.png" />
                        </a>
                  
                   <?php else:?>
                       <a href="<?php echo site_url('educacao_corporativa/'.$pagina_curso->url); ?>">
                            <img img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-laranja-branco.png" />
                        </a>
                   <?php endif;?>
		   
		</div>
		<?php $cont_class++; ?>
	<?php endforeach; ?>
<?php endif; ?>
<!----Veja Tambem---->