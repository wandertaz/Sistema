<!--Destaques---->
<div id="destaques2">
 <div id="col1">
 <h2>Registre<br /> seu email</h2>
 <p>Gostaria de receber a divulgação de nossos cursos? Basta nos enviar seu nome e email:

  <form id="frmRegistrarEmail" name="frmRegistrarEmail" action="<?php echo site_url('educacao_corporativa/salvar_email'); ?>" method="post">

	 <?php if($this->session->flashdata('msg') != ""):?>
		<?php echo $this->session->flashdata('msg');?>
	<?php endif;?>

	 <input type="text" name="nome" id="registrarEmailNome" placeholder="Seu nome" class="inputRegistrarEmail" />
	 <input type="text" name="email" id="registrarEmailEmail" placeholder="Seu email" class="inputRegistrarEmail" />
	 <input type="submit" name="buscar" id="buscar" class="buttonRegistrarEmail" value="Enviar" />

 </form>
 </p>

 </div>

 <div id="col2">
  <?php if(isset($banner_lateral) && $banner_lateral): ?>
	 <div class="list-destaque">
	 <h1>Próximos Cursos</h1>
	   <div class="box-foto">
	   <img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $banner_lateral[0]->imagem; ?>" width="179" height="251" />
	   <span class="borda"></span>
	   <a href="<?php echo $banner_lateral[0]->link; ?>"><img img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-cinza-branco.png" border="0"/></a>
	   </div>
	   </div>
	<?php endif; ?>
 </div>

	<div id="col3">
		<h1>Veja o que<br />já rolou</h1>

		<div>

			<?php if(isset($video_lateral) && $video_lateral): ?>
				<span class="icon-video"></span>
				<h5>
					<span class="white">Vídeos</span><br/>
					<?php echo $video_lateral[0]->titulo; ?>
				</h5>
				<img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $video_lateral[0]->imagem; ?>" alt="" />
				<a href="<?php echo site_url('multimidia/ver_video/'.$video_lateral[0]->id.'/'.$video_lateral[0]->url); ?>" class="read-more">Assistir</a>
			<?php endif; ?>

			<?php if(isset($galerias_lateral) && $galerias_lateral): ?>
				<span class="icon-photo"></span>
				<h5>
					<span class="white">Fotos</span>
				</h5>

				<?php foreach($galerias_lateral as $galeria): ?>
					<h5>
						<span class="white"><?php echo br_date($galeria->data); ?></span><br />
						<span class="normal"><a href="<?php echo site_url('multimidia/ver_galeria/'.$galeria->id.'/'.$galeria->url); ?>"><?php echo $galeria->titulo; ?></a></span>
					</h5>
					<br />
				<?php endforeach; ?>
				<div style="clear: both"></div>
	 			<a class="icon-more" href="<?php echo site_url('multimidia/galerias'); ?>">Ver mais fotos</a>
	 		<?php endif; ?>
	 	</div>
	</div>
<!----Fim-Destaques---->

</div>
<!----Fim-News---->