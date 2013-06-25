<div id="box-destaques">
	 <?php if(isset($box_destaques) && $box_destaques): ?>
		 <div id="col1">
		 <h2>Destaques</h2>
		 <a href="<?php echo site_url('noticias/destaques'); ?>" class="vertodos"><img img src="<?php echo base_url(); ?>assets/img/ico-ver-todos-destaques.gif" alt="ver-todos"></br>
		 Ver todos</br>
		 os destaques
		 </a>
		 </div>

		 <div id="col2">
		 	 <?php foreach($box_destaques as $key => $destaque): ?>
				 <div class="list-destaque <?php if($key == 1): ?> ultimo <?php endif; ?>">
				   <div class="box-foto">
				    <img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $destaque->imagem; ?>" alt="revista MB" width="179" height="74" />
				    <span class="borda"></span>
				   </div>
				   <p><?php echo $destaque->descricao; ?></p>
				   <a href="<?php echo site_url('noticias/destaques'); ?>"><img img src="<?php echo base_url(); ?>assets/img/bt-lermais-destaques.gif" alt="leia-mais"/></a>
				 </div>
			 <?php endforeach; ?>
		 </div>

	 <?php endif; ?>

	 <?php if(isset($box_news) && $box_news): ?>
		 <div id="col3">
			 <h2>News</h2>
			  <div class="list-news">
			   <span class="data"><?php echo date('d.m.Y', strtotime($box_news[0]->data)); ?></span>
			   <h3><?php echo $box_news[0]->titulo; ?></h3>
			   <p><?php echo $box_news[0]->descricao; ?></p>
			   <a href="<?php echo site_url('noticias/news'); ?>"><img img src="<?php echo base_url(); ?>assets/img/bt-lermais-destaques.gif" alt="leia-mais"/></a>
			 </div>
		 </div>
	 <?php endif; ?>
</div>