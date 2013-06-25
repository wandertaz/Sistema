<?php if(isset($banner_enquete) && $banner_enquete): ?>
<div class="enquete">
	<h1><?php echo $banner_enquete[0]->titulo; ?></h1>
    <div class="box-item">
		<a href="<?php echo $banner_enquete[0]->link; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $banner_enquete[0]->imagem; ?>" alt="banner-internas" width="170" /></a>
    </div>
</div>
<?php elseif(isset($enquete) && $enquete && $enquete[0]->alternativas): ?>
	<div class="enquete">
		<h1>Enquete</h1>
	    <div class="box-item">
			<h3><?php echo $enquete[0]->pergunta; ?></h3>

			<form action="<?php echo site_url('home/votar_enquete'); ?>" method="POST" accept-charset="utf-8">

				<?php if($this->session->flashdata('msg') != ""):?>
					<?php echo $this->session->flashdata('msg');?>
				<?php endif;?>

			    <input type="hidden" name="enquete_id" value="<?php echo $enquete[0]->id; ?>" >

				<fieldset class="radios">
			        <?php foreach($enquete[0]->alternativas as $alternativa): ?>
						<label class="label_radio r_on" for="<?php echo $alternativa->id; ?>">
							<input name="resposta_id" id="<?php echo $alternativa->id; ?>" value="<?php echo $alternativa->id; ?>" type="radio" />
							<?php echo $alternativa->resposta; ?>
						</label>
			        <?php endforeach; ?>

					<input type="image" src="<?php echo base_url(); ?>assets/img/btn-votar.png" width="130" height="15" name="votar" class="votar"/>
			    </fieldset>

			</form>

	    </div>
	</div>
<?php endif; ?>