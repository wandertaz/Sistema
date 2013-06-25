<?php include("includes/topo.php"); ?>

   </div>

<div class="content">
	<div class="content" id="content-area-restrita">
    <div class="menuAreaRestrita">
                <h1>Área Restrita</h1>               
                <?php
                   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
                ?>
   </div>
</div>
    <?php //include('includes/destaques.php'); ?>

    <div class="content-interna">

    <!-- Menu lateral -->
     <div class="left-cursos equalH-meus-cursos">
        <div class="miolo-interna">
         <?php include("includes/menu-left.php"); ?>
       </div>
     </div>

	<div class="centerCursos equalH-meus-cursos">
		<h1>Meus arquivos</h1>

		<?php if(isset($query_downloads) && $query_downloads):?>

			<div id="container-abas">
			    <div class="viewport">
			        <ul class="overview" id="abas">
					<?php foreach($query_categorias->result() as $categoria): ?>
						<li><a href="javascript:;" data-id-area="<?php echo $categoria->id_downloads_categorias; ?>"><?php echo $categoria->nome_categoria; ?></a></li>
					<?php endforeach; ?>
						<li><a href="#" style="visibility: hidden">...</a></li>
			        </ul>
			    </div>
			    <a class="buttons prev" href="javascript:;">&lt;</a>
			    <a class="buttons next" href="javascript:;">&gt;</a>
			</div>

			<div id="lista-subcategorias">
				<?php //include('includes/subcategorias.php'); ?>
			</div>

			<ul id="lista-downloads">
				<?php include('includes/downloads.php'); ?>
			</ul>
		<?php else: ?>
			<p>Nenhum arquivo disponível.</p>
		<?php endif; ?>
     </div>

     <!-- Right Sidebar -->
	<div class="rightMeusCursos sidebar">
		<h2>Novas atualizações de arquivos</h2>
		<ul>

		<?php if(isset($downloads_atualizacoes) && $downloads_atualizacoes): ?>
			<?php foreach($downloads_atualizacoes as $atualizacao): ?>
				<li>
					<?php if($atualizacao->cobrada == 'N'): ?>
						<a href="<?php echo site_url('central_downloads/functionUp_/'.$atualizacao->id_download_versoes.'/'.$atualizacao->chave); ?>"><?php echo $atualizacao->titulo; ?></a>
						<b><?php echo 'Versão '.$atualizacao->numero_versao; ?></b>
						<span class="data"><?php echo br_semana(date('N', strtotime($atualizacao->created))); ?>, <?php echo date('d/m/y h:i',strtotime($atualizacao->created)); ?></span>
					<?php else: ?>
						<a href="<?php echo site_url('carrinho/adicionar').'/'.$atualizacao->id_download_versoes.'/DO/false/'.$TipoAcesso;?>"><?php echo $atualizacao->titulo; ?></a>
						<b><?php echo 'Versão '.$atualizacao->numero_versao; ?></b>
						<span class="data"><?php echo br_semana(date('N', strtotime($atualizacao->created))); ?>, <?php echo date('d/m/y h:i',strtotime($atualizacao->created)); ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		<?php else: ?>
			<li><span>Nenhuma atualização.</span></li>
		<?php endif; ?>
	</div>
</div>

</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#abas a").click(function(){
		$("#abas li a").removeClass();
		$(this).addClass('active');
		var id_categoria = $(this).attr('data-id-area');
		$.ajax({
			url: "<?php echo site_url('central_downloads/get_subcategorias/'); ?>" + '/' + id_categoria
		}).done(function(html) {
			//$("#lista-subcategorias").html(html);
			$.ajax({
				url: "<?php echo site_url('central_downloads/get_downloads/'); ?>" + '/' + id_categoria + '/' + '<?php echo $TipoAcesso; ?>'
			}).done(function(html) {
				$("#lista-downloads").html(html);
			});
		});
	});

	$("#lista-subcategorias select").live("change", function(){
		$.ajax({
			url: "<?php echo site_url('central_downloads/get_downloads/'); ?>" + '/' + $(this).val() + '/' + '<?php echo $TipoAcesso; ?>'
		}).done(function(html) {
			$("#lista-downloads").html(html);
		});
	});
});
</script>
<?php //include("includes/rodape.php"); ?>

<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
?>