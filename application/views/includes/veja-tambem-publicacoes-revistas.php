<!--Veja Tambem---->
<h1>Veja Também</h1>

<?php if(isset($artigo_mb) && $artigo_mb): ?>
	<div id="item-1">
	  <div style="float:left; width:400px; margin-left:5px;" class="box-foto">
	  <h2>Artigos</h2>
	   <p><?php echo $artigo_mb[0]->titulo; ?></p>
		<a href="<?php echo site_url('publicacoes/ver_artigo/'.$artigo_mb[0]->id.'/'.$artigo_mb[0]->url); ?>"><img img src="<?php echo base_url(); ?>assets/img/ler-mais-grande.png" /></a>
	    </div>
	</div>
<?php endif; ?>

<?php if(isset($pesquisa_estudo) && $pesquisa_estudo): ?>
	<div id="item-2">
	  <div style="float:left; width:400px; margin-left:5px;" class="box-foto">
	  <h2>Estudos e Pesquisas</h2>
	   <p><?php echo $pesquisa_estudo[0]->titulo; ?></p>
		<a href="<?php echo site_url('publicacoes/ver_pesquisas_estudos/'.$pesquisa_estudo[0]->id.'/'.$pesquisa_estudo[0]->url); ?>"><img img src="<?php echo base_url(); ?>assets/img/ler-mais-grande.png" /></a>
	    </div>
	</div>
<?php endif; ?>
<!----Veja Tambem---->