<?php if(isset($banners) && $banners): ?>
	<div class="slider-wrapper theme-default">

		<div id="slider" class="nivoSlider">
			<?php foreach($banners as $banner): ?>
		    	<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $banner->imagem; ?>" width="990" height="367" alt="" title="#htmlcaption<?php echo $banner->id; ?>" />
		    <?php endforeach; ?>
		</div>

		<?php foreach($banners as $banner): ?>
			<div id="htmlcaption<?php echo $banner->id; ?>" class="nivo-html-caption">
				<div class="txt-banner">
				<h2><?php echo $banner->titulo; ?></h2>
				<p><?php echo nl2br($banner->descricao); ?></p>

				</div>
			</div>
		<?php endforeach; ?>

	</div>
<?php endif; ?>
