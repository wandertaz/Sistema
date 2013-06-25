<?php if(isset($pagina) && $pagina): ?>
	<div class="banner-internas">
		<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $pagina->imagem; ?>" alt="banner-internas" />

		<?php if(isset($post_destaque) && $post_destaque): ?>
			<div class="descricao-banner-interna">
				<h2><?php echo $post_destaque[0]->titulo; ?><br />
					<a href="<?php echo site_url('blog/ver_post/'.$post_destaque[0]->id.'/'.$post_destaque[0]->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-artigos.png" alt="" height="15" style="position: relative" width="295" /></a>
				</h2>
			</div>

			<div id="colunista-da-semana">
				<span></span><h3>Colunista da semana</h3>
				<div><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $post_destaque[0]->imagem_colunista; ?>" alt="" title="" /><h4><?php echo $post_destaque[0]->colunista; ?></h4></div>
			</div>
		<?php endif; ?>

	</div>
<?php endif; ?>