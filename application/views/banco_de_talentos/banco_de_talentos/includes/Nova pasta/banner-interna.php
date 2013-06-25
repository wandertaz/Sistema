<?php if(isset($pagina) && $pagina): ?>
	<div class="banner-internas">
	     <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $pagina->imagem; ?>" alt="banner-internas" width="990" height="242" />
	     <div class="descricao-banner-interna">
	      <h2><?php echo $pagina->descricao; ?></h2>
	     </div>
	</div>
<?php endif; ?>