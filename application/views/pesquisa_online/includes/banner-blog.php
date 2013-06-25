<?php if(isset($pagina) && $pagina): ?>
	<div class="banner-internas">
		<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $pagina->imagem; ?>" alt="banner-internas" />


		<div class="descricao-banner-interna">
			<h2><?php echo $pagina->descricao; ?><br /></h2>
		</div>

		<?php if(isset($post_destaque) && $post_destaque): ?>
			<div id="colunista-da-semana">
				<span></span><h3>Colunista da semana</h3>
				<div><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $post_destaque[0]->imagem_colunista; ?>" alt="" title="" width="53" height="63" /><h4><?php echo $post_destaque[0]->colunista; ?></h4>
                <h4 style="margin-top:0px; text-transform: none;"><?php echo $post_destaque[0]->descricao_colunista; ?></h4>
                </div>
			</div>
		<?php endif; ?>

	</div>
<?php endif; ?>