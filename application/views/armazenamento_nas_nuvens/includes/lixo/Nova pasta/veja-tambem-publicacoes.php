<!--Veja Tambem---->
<h1>Veja Também</h1>

<?php if(isset($nossa_historia) && $nossa_historia): ?>
	<div id="item-1">
	   <div class="box-foto" style="float:left;">
	   <img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $nossa_historia[0]->imagem; ?>" width="179" height="74" style="float:left;" />
	   <span class="borda"></span>
	   </div>
	  <div style="float:left; width:400px; margin-left:5px;">
	  <h2>Nossa História</h2>
	   <p><?php echo $nossa_historia[0]->descricao; ?></p>
		<a href="<?php echo site_url('quem_somos/historia'); ?>"><img img src="<?php echo base_url(); ?>assets/img/ler-mais-grande.png" /></a>
	    </div>
	</div>
<?php endif; ?>

<?php if(isset($cultura) && $cultura): ?>
	<div id="item-2">
	   <div class="box-foto" style="float:left;">
		   <img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $cultura[0]->imagem; ?>" width="179" height="74" style="float:left;" />
		   <span class="borda"></span>
		   </div>
		  <div style="float:left; width:400px; margin-left:5px;">
		  <h2>Cultura Organizacional</h2>
		   <p><?php echo $cultura[0]->descricao; ?></p>
			<a href="<?php echo site_url('quem_somos/cultura'); ?>"><img img src="<?php echo base_url(); ?>assets/img/ler-mais-grande.png" /></a>
		    </div>
</div>
<?php endif; ?>
<!----Veja Tambem---->