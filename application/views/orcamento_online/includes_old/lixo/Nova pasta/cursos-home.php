<?php if(isset($banner_lateral) && $banner_lateral): ?>
	<div class="cursos">
		<h1><?php echo $banner_lateral[0]->titulo; ?></h1>
	    <div class="box-item">
	        <div class="box-foto">
	        	<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $banner_lateral[0]->imagem; ?>" />
	            <span class="borda"></span>
	        </div>
	        <a href="<?php echo $banner_lateral[0]->link; ?>" class="leia"><span>Leia Mais</span></a>
	    </div>
	</div>
<?php endif; ?>