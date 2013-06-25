<?php if(isset($colunistas) && $colunistas): ?>
	<div id="colunistas">
		<h2>Colunistas</h2>
		<ul>
			<?php foreach($colunistas as $colunista): ?>
				<?php if($colunista->total > 0): ?>
					<li><a href="<?php echo site_url('blog/index?colunista='.$colunista->id); ?>"><?php echo $colunista->nome; ?> (<?php echo $colunista->total; ?>)</a></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

<?php if(isset($categorias) && $categorias): ?>
	<div id="categorias">
		<h2>Categorias</h2>
		<ul>
			<?php foreach($categorias as $categoria): ?>
				<?php if($categoria->total > 0): ?>
					<li><a href="<?php echo site_url('blog/index?categoria='.$categoria->id); ?>"><?php echo $categoria->categoria; ?> (<?php echo $categoria->total; ?>)</a></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

<?php if(isset($arquivos_posts) && $arquivos_posts): ?>
	<div id="arquivos">
		<h2>Arquivos</h2>
		<ul>
			<?php foreach($arquivos_posts as $ano_mes => $arquivo): ?>
				<li><a href="<?php echo site_url('blog/index?ano_mes='.$ano_mes); ?>"><?php echo $arquivo; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>