<div id="box-destaques">
 <div id="col1">
	 <h2 style="color:#fff;">Blog</h2>
	 <a style="color:#fff;" href="<?php echo site_url('blog'); ?>" class="vertodos"><img img src="<?php echo base_url(); ?>assets/img/ico-ver-todos-blog.gif" alt="ver-todos"></br>
	 Ver todos</br>
	 os destaques
	 </a>
 </div>

 <?php if(isset($box_blog) && $box_blog): ?>
	 <div id="col2">
		 <div class="list-blog">
		   <div class="box-foto">
		    <img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $box_blog[0]->imagem; ?>" alt="revista MB" width="85" height="114" />
		    <span class="borda"></span>
		   </div>
		   <h3><?php echo $box_blog[0]->titulo; ?></h3>
		   <p><?php echo $box_blog[0]->descricao; ?></p>
		   <a href="<?php echo site_url('blog/ver_post/'.$box_blog[0]->id.'/'.$box_blog[0]->url) ?>"><img img src="<?php echo base_url(); ?>assets/img/btn-lermais-blog-home.gif" width="287"  height="15" alt="leia-mais"/></a>
		 </div>
	 </div>
 <?php endif; ?>

  <?php if(isset($box_multimidia) && $box_multimidia): ?>
	 <div id="col3">
		 <h2>Multímidia</h2>
		  <div class="list-multimidia">
		   <img img src="<?php echo base_url(); ?>assets/img/ico-podcast.gif" alt="podcast" width="39" height="39"/>
		   <span>PODCASTS</span></br>
		   <h3><?php echo $box_multimidia[0]->titulo; ?></h3>
		   <p><?php echo $box_multimidia[0]->descricao; ?></p>
		   <a href="<?php echo site_url('multimidia/ouvir_podcast/'.$box_multimidia[0]->id.'/'.$box_multimidia[0]->url); ?>"><img img src="<?php echo base_url(); ?>assets/img/btn-multimidia-ouvir.gif" alt="leia-mais"/></a>
		 </div>
	 </div>
 <?php endif; ?>
</div>