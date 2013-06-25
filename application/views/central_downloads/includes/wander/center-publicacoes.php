<div class="depoimentos">
	<h4>ÚLtiMAS PUBLICAÇÕES</h4>


	<?php if(isset($ultimas_pesquisas) && $ultimas_pesquisas): ?>
		<h5>Pesquisas</h5>

		<?php foreach($ultimas_pesquisas as $ultima_pesquisa): ?>
			<h6><?php echo $ultima_pesquisa->titulo; ?></h6>
			<p class="ultimosArtigos"><?php echo $ultima_pesquisa->descricao; ?>
			<a href="<?php echo site_url('publicacoes/ver_pesquisas_estudos/'.$ultima_pesquisa->id.'/'.$ultima_pesquisa->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-vermelho-preto.png"></p></a>
		<?php endforeach; ?>

	<?php endif; ?>

	<?php if(isset($ultimos_estudos) && $ultimos_estudos): ?>
		<h5>Estudos</h5>

		<?php foreach($ultimos_estudos as $ultimo_estudo): ?>
			<h6><?php echo $ultimo_estudo->titulo; ?></h6>
			<p class="ultimosArtigos"><?php echo $ultimo_estudo->descricao; ?>
			<a href="<?php echo site_url('publicacoes/ver_pesquisas_estudos/'.$ultimo_estudo->id.'/'.$ultimo_estudo->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-vermelho-preto.png"></p></a>
		<?php endforeach; ?>

	<?php endif; ?>
</div>