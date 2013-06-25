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
	 <h1><?php echo $banner_lateral[0]->titulo; ?></h1>
	   <div class="box-foto">
	   <img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $banner_lateral[0]->imagem; ?>" width="179" height="251" />
	   <span class="borda"></span>
	   <a href="<?php echo $banner_lateral[0]->link; ?>"><img img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-cinza-branco.png" border="0"/></a>
	   </div>
	   </div>
<?php endif; ?>


 </div>

<?php if(isset($banner_depoimento) && $banner_depoimento): ?>
	<div id="col3">
		<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $banner_depoimento[0]->imagem; ?>" alt="banner-internas" width="170" />
	</div>
<?php elseif(isset($depoimentos) && $depoimentos): ?>
	 <div id="col3">
	 <h1>Quem já participou</h1>

	 <?php foreach($depoimentos as $depoimento): ?>
		 <p>"<?php echo $depoimento->depoimento; ?>"
		  <span><?php echo $depoimento->nome; ?> - <?php echo $depoimento->empresa; ?></span>
		 </p>
	<?php endforeach; ?>

	 </div>
<?php endif; ?>
<!----Fim-Destaques---->

</div>
<!----Fim-News---->