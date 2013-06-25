<!--Veja Tambem---->
<h1>Veja Também</h1>
<div id="item-1">
   <div class="box-foto">
   <img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $historia->imagem; ?>" width="179" height="74" />
   <span class="borda"></span>
   </div>
  <h2><?php echo $historia->titulo; ?></h2>
   <p><?php echo character_limiter($historia->descricao,"60","..."); ?></p>
<a href="<?php echo site_url(); ?>quem_somos/historia"><img img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-laranja-branco.png" /></a>
</div>

<div id="item-2">
   <div class="box-foto">
   <img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $cultura->imagem; ?>" width="179" height="74" />
   <span class="borda"></span>
   </div>
   <h2><?php echo $cultura->titulo; ?></h2>
   <p><?php echo character_limiter($cultura->descricao,"60","..."); ?><br/><br/></p>
<a href="<?php echo site_url(); ?>quem_somos/cultura"><img img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-laranja-branco.png" /></a>
</div>

<div id="item-3">
   <div class="box-foto">
   <img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $diferenciais->imagem; ?>" width="179" height="74" />
   <span class="borda"></span>
   </div>
  <h2><?php echo $diferenciais->titulo; ?></h2>
   <p><?php echo character_limiter($diferenciais->descricao,"60","..."); ?></p>
   <a href="<?php echo site_url(); ?>quem_somos/diferenciais"><img img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-laranja-branco.png" /></a>
</div>
<!----Veja Tambem---->