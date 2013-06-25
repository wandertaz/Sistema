<?php include("includes/topo.php"); ?>
<?php
   //include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>


<div class="content" id="content-area-restrita">

           <div class="menuAreaRestrita">
                <h1>Área Restrita</h1>
                <?php // include('includes/menu-area-restrita.php'); ?>
                <?php
                    include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
                ?>
           </div>
    <div class="content-interna">

    <!-- Menu lateral -->
     <div class="left-cursos equalH-meus-cursos">
        <div class="miolo-interna">
         <?php include("includes/menu-left.php"); ?>
       </div>
     </div>

	<div class="centerCursos equalH-meus-cursos armazenamento_nas_nuvens_center">

		<div class="selecionar-curso">
			<form id="<?php echo site_url('armazenamento_nas_nuvens/index/'.$TipoAcesso); ?>" name="formulario-curso" action="" method="get">
				<input type="text" name="busca" class="s-field" id="id" placeholder="Buscar um arquivo">
				<input type="submit" name="enviar" id="enviar" class="buttonBuscarCurso" style="margin-top:4px; cursor:pointer;">
			</form>
		</div>

		<?php if(isset($arquivos) && $arquivos): ?>
		<h1 class="title-nuvens-folder"><?php echo $arquivos[0]->nome; ?></h1>

		<ul class="downloads armazenamentos">

			<?php foreach($arquivos as $arquivo): ?>
				<li>
					<div>
						<h4><a href="#"><?php echo $arquivo->titulo; ?></a></h4>
						<p class="desc"><?php echo $arquivo->descricao_armazenamento; ?></p>
					</div>
					<div class="detalhes-versao">
						<p class="data-aquisicao">Data da Versão: <?php echo date('d', strtotime($arquivo->data_atualizacao)); ?> de <?php echo br_month(date('m', strtotime($arquivo->data_atualizacao))); ?>, <?php echo date('Y', strtotime($arquivo->data_atualizacao)); ?></p>
						<p>Detalhes do arquivo: </p>
						<p>Versão - <?php echo $arquivo->numero_versao; ?></p>
						<p>Formato - <?php echo $arquivo->formato_arquivo; ?> <i><?php echo $arquivo->descricao_extensao==''?'':'('.$arquivo->descricao_extensao.')'; ?></i></p>
						<p>Tamanho - <?php echo round($arquivo->tamanhoMB, 2); ?> Mb</p>
						<div class="adquirir-versao">
							<a href="<?php echo site_url('armazenamento_nas_nuvens/functionUp_/'.$arquivo->id_armazenamento.'/'.$arquivo->chave); ?>" class="button-download" title="Fazer download do arquivo">Fazer download do arquivo</a>
						</div>
					</div>
				</li>
			<?php endforeach; ?>

		</ul>
		<?php else: ?>
			Nenhum arquivo encontrado
		<?php endif; ?>
     </div>

     <!-- Right Sidebar -->
     <div class="rightMeusCursos sidebar ultimos_arquivos_recebidos">
     	<h2>últimos arquivos recebidos</h2>

     	<ul class="txt-right">
     		<?php if(isset($ultimos_arquivos) && $ultimos_arquivos): ?>
     			<?php foreach($ultimos_arquivos as $ultimo_arquivo): ?>
					<li>
		     			<a href="<?php echo site_url('armazenamento_nas_nuvens/functionUp_/'.$ultimo_arquivo->id_armazenamento.'/'.$ultimo_arquivo->chave); ?>"><?php echo $ultimo_arquivo->titulo; ?> - <?php echo $ultimo_arquivo->formato_arquivo; ?></a>
		     			<span class="data"><?php echo br_semana(date('N', strtotime($ultimo_arquivo->data_atualizacao))); ?>, <?php echo br_date($ultimo_arquivo->data_atualizacao); ?> - <?php echo date('H', strtotime($ultimo_arquivo->data_atualizacao)).'h'.date('i', strtotime($ultimo_arquivo->data_atualizacao)) ?></span>
		     		</li>
	     		<?php endforeach; ?>
     		<?php else: ?>
    			<li>Nenhum arquivo recebido</li>
			<?php endif; ?>
     	</ul>

     </div>

   </div>


 </div>

<?php 

    //include("includes/rodape.php"); 

include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';

?>
