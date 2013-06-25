<!--Destaques---->
<?php if(isset($destaques) && $destaques): ?>
<div id="destaques">
	<div id="col1">
		<h2>Destaques</h2>
		<a href="<?php echo site_url('noticias/destaques'); ?>" class="vertodos"><img src="<?php echo base_url(); ?>assets/img/ico-ver-todos-destaques.gif" alt="ver-todos"></br>
		Ver todos</br>
		os destaques
		</a>
	</div>
	<div id="col2">
		<?php foreach($destaques as $key => $destaque): ?>
		<div class="list-destaque <?php if($key == 1): ?> ultimo <?php endif; ?>">
			 <div class="box-foto">
			  <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $destaque->imagem; ?>" alt="revista MB" width="179" height="74" />
			  <span class="borda"></span>
			 </div>
			 <p><?php echo $destaque->descricao; ?></p>
			 <a href="<?php echo site_url('noticias/noticias_abertas?id_noticia='.$destaque->id ); ?>"><img src="<?php echo base_url(); ?>assets/img/bt-lermais-destaques.gif" alt="leia-mais"/></a>
		</div>
		<?php endforeach; ?>

	</div>

</div>
<?php endif; ?>
<!--Fim-Destaques---->

<!--Blog---->
<?php if(isset($posts_home) && $posts_home): ?>
<div id="blog">
	<div id="col1">
	<h2>Blog</h2>
	<a href="<?php echo site_url('blog'); ?>" class="vertodos"><img src="<?php echo base_url(); ?>assets/img/ico-ver-todos-blog.gif" alt="ver-todos"></br>
	Ver todos</br>
	as postagens
	</a>
	</div>
	<div id="col2">
		<?php foreach($posts_home as $key => $post_home): ?>
			<div class="list-blog <?php if($key == 1): ?> ultimo <?php endif; ?>">
				  <div class="box-foto">
				   <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $post_home->imagem; ?>" alt="revista MB" width="85" height="114" />
				   <span class="borda"></span>
				  </div>
				  <h3><?php echo $post_home->titulo; ?></h3>
				  <p><?php echo $post_home->descricao; ?></p>
			  	  <a href="<?php echo site_url('blog/ver_post/'.$post_home->id.'/'.$post_home->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-lermais-blog-home.gif" width="287"  height="15" alt="leia-mais"/></a>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>
<!--Fim-blog---->

<!--News---->
<?php if(isset($news) && $news): ?>
<div id="news">
	<div id="col1">
		<h2>News</h2>
		<a href="#" class="vertodos"><img src="<?php echo base_url(); ?>assets/img/ico-ver-todos-destaques.gif" alt="ver-todos"></br>
		Ver todas</br>
		as Notícias
		</a>
	</div>
	<div id="col2">
		<?php foreach($news as $key => $new): ?>
			<div class="list-news <?php if($key == 1): ?> ultimo <?php endif; ?>">
			  <span class="data"><?php echo date('d.m.Y', strtotime($new->data)); ?></span>
			  <h3><?php echo $new->titulo; ?></h3>
			  <p><?php echo $new->descricao; ?></p>
			  <a href="<?php echo site_url('noticias/noticias_abertas?id_noticia='.$destaque->id ); ?>"><img src="<?php echo base_url(); ?>assets/img/bt-lermais-destaques.gif" alt="leia-mais"/></a>
			</div>
		<?php endforeach; ?>
	</div>

</div>
<?php endif; ?>
<!--Fim-News---->

<!--multimidia---->
<div id="multimidia">
<div id="col1">
<h2>multimidia</h2>
<a href="<?php echo site_url('multimidia'); ?>" class="vertodos"><img src="<?php echo base_url(); ?>assets/img/ico-ver-todos-destaques.gif" alt="ver-todos"/></br>
Ver mais</br>
Arquivos
</a>
</div>
<div id="col2">

	<?php if(isset($podcast) && $podcast): ?>
		<div class="list-multimidia">
		  <img src="<?php echo base_url(); ?>assets/img/ico-podcast.gif" alt="podcast" width="39" height="39"/>
		  <span>PODCASTS</span></br>
		  <h3><?php echo $podcast[0]->titulo; ?></h3>
		  <p><?php echo $podcast[0]->descricao; ?></p>
		  <a href="<?php echo site_url('multimidia/ver_podcast/'.$podcast[0]->id.'/'.$podcast[0]->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-multimidia-ouvir.gif" alt="leia-mais"/></a>
		</div>
	<?php endif; ?>

	<?php if(isset($video) && $video): ?>
		<div class="list-multimidia ultimo">
		  <img src="<?php echo base_url(); ?>assets/img/ico-video.gif" alt="podcast" width="39" height="39"/>
		  <span>Videos</span></br>
		  <h3><?php echo $video[0]->titulo; ?></h3>
		   <div class="box-foto">
		   <a href="<?php echo site_url('multimidia/ver_video/'.$video[0]->id.'/'.$video[0]->url); ?>">
		   <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $video[0]->imagem; ?>" alt="assistir video" width="178" height="93" />
		   <span class="borda"></span>
		   </a>
		  </div>
		  <a href="<?php echo site_url('multimidia/ver_video/'.$video[0]->id.'/'.$video[0]->url); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-multimidia-assistir.gif" alt="leia-mais"/></a>
		</div>
	<?php endif; ?>
</div>

</div>
<!----Fim-News---->