<div class="depoimentos">
	<h4>ÚLtiMAS PUBLICAÇÕES</h4>

	<?php if(isset($ultimos_artigos) && $ultimos_artigos): ?>
		<h5>Artigos</h5>

		<?php foreach($ultimos_artigos as $ultimo_artigo): ?>
			<h6><?php echo $ultimo_artigo->titulo; ?></h6>
			<p class="ultimosArtigos"><?php echo $ultimo_artigo->descricao; ?>
			<a href="<?php echo site_url('publicacoes/ver_artigo/'.$ultimo_artigo->id.'/'.$ultimo_artigo->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-vermelho-preto.png"></p></a>
		<?php endforeach; ?>

	<?php endif; ?>

	
</div>