<div class="cursos">
	<h3>Cursos Abertos</h3>
    <div class="text-cursos">
    	<?php if(isset($pagina) && $pagina): ?>
        	<?php echo $pagina->texto; ?>
        <?php endif; ?>
    </div>
    <div class="box-search-cursos">
    	<h3 style=" width:206px; line-height:100%;">Programação</br>2012</h3>
    	<form action="<?php echo site_url('educacao_corporativa/cursos_abertos'); ?>" method="GET">
			<input type="text" name="busca" id="buscarCurso" placeholder="Buscar Curso" class="inputBuscarCurso" />
	    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />
    	</form>
    </div>
    <a href="#" class="down-programacao">Fazer <span>download</span> de toda a programação</a>
</div>