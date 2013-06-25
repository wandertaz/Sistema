<div id="destaques" style="border:none;">
	<div class="depoimentos">
	  	<h4>ÚLtiMAS postagens</h4>

		<?php if(isset($ultimo_video) && $ultimo_video): ?>
			<h7><img src="<?php echo base_url(); ?>assets/img/icon-projetor.png" alt="" width="30" height="30" style="margin-right:5px;" align="middle">Videos</h7>
		  	<h6 style="font-size:11px; margin-left:40px; font-size:10px; margin-top:0px; font-family:'alright_sans_boldregular', Arial, Helvetica, sans-serif;"><?php echo $ultimo_video[0]->titulo; ?></h6>
		  	<p class="ultimosArtigos"><a href="<?php echo site_url('multimidia/ver_video/'.$ultimo_video[0]->id.'/'.$ultimo_video[0]->url); ?>"><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $ultimo_video[0]->imagem; ?>" alt="" width="178" height="93"><img src="<?php echo base_url(); ?>assets/img/assistir-black.png" alt=""></a></p>
		  	<h6>&nbsp;</h6>
		<?php endif; ?>

		<?php if(isset($ultimo_podcast) && $ultimo_podcast): ?>
			<h7><img src="<?php echo base_url(); ?>assets/img/podcast-icon.png" alt="" width="30" height="30" style="margin-right:5px;" align="middle">Podcasts</h7>
		  	<h6 style="font-size:11px; margin-left:40px; font-size:10px; margin-top:0px; font-family:'alright_sans_boldregular', Arial, Helvetica, sans-serif;"><?php echo $ultimo_podcast[0]->titulo; ?></h6>
		  	<p class="ultimosArtigos"><?php echo $ultimo_podcast[0]->descricao; ?>
		    <a href="<?php echo site_url('multimidia/ver_podcast/'.$ultimo_podcast[0]->id.'/'.$ultimo_podcast[0]->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-ouvir.png" alt=""></p></a>
		  	<h6>&nbsp;</h6>
		<?php endif; ?>

		<?php if(isset($ultimas_galerias) && $ultimas_galerias): ?>
			<h7><img src="<?php echo base_url(); ?>assets/img/photo-icon.png" alt="" width="30" height="30" style="margin-right:5px;" align="middle">Fotos</h7>

			<?php foreach($ultimas_galerias as $ultima_galeria): ?>
				<h6 style="font-size:11px; margin-left:40px; font-size:10px; margin-top:0px; font-style:italic; color:#ff3600; font-family:'alright_sans_regularregular', Arial, Helvetica, sans-serif;"><?php echo personalizar_data('d.m.Y', $ultima_galeria->data); ?></h6>
			  	<a href="<?php echo site_url('multimidia/ver_galeria/'.$ultima_galeria->id.'/'.$ultima_galeria->url); ?>"><p class="ultimosArtigos"><font style="text-transform:uppercase; font-family:'alright_sans_boldregular', Arial, Helvetica, sans-serif;"><?php echo $ultima_galeria->titulo; ?></font></p></a>
				<h6>&nbsp;</h6>
			<?php endforeach; ?>
		<?php endif; ?>

	</div>
</div>