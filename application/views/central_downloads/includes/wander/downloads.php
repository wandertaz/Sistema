	<?php if(!$query_downloads):?>
		<p>Você ainda não comprou nenhum arquivo.</p>
		<p>Navegue pelos nossos serviços e adquira uma gama variada de documentos, planilhas e arquivos para melhorar agora mesmo a qualidade do seu negócio.</p>
	<?php else: ?>
	<?php foreach($query_downloads as $download): ?>
	<li>
		<div>
			<h3><?php echo $download->nome_categoria; ?></h3>
			<h4><a href="#"><?php echo $download->titulo; ?></a></h4>
			<p class="desc"><?php echo $download->descricao; ?></p>
		</div>

		<div class="detalhes-versao">
			<p class="data-aquisicao">Data de aquisição: <?php echo date('d', strtotime($download->data_inscricao)); ?> de <?php echo br_month(date('m', strtotime($download->data_inscricao))); ?> de <?php echo date('Y',strtotime($download->data_inscricao)); ?></p>

			<?php $dados_versao = retorna_versoes_downloads($download->id_downloads); ?>

			<?php foreach($dados_versao as $versao): ?>
				<?php if($versao['numero_versao'] >= $download->numero_versao): ?>
				<p><b>Versão <?php echo $versao['numero_versao']; ?></b></p>
				<p>Detalhes do arquivo: </p>
				<p>Formato - <?php echo $versao['formato_arquivo']; ?></p>
				<p>Tamanho - <?php echo round($versao['tamanhomb'], 2); ?>mb</p>
				<div class="adquirir-versao">
					<p><input type="checkbox" checked="checked" disabled="disabled" name="aceite-termos-<?php echo $versao['id_download_versoes']; ?>"> Li e aceito os <a href="termos" target="_blank">termos de uso</a></p>
					<a href="<?php echo site_url('central_downloads/functionUp_/'.$versao['id_download_versoes'].'/'.$versao['chave']); ?>" class="button-download" title="Fazer download do arquivo">Fazer download do arquivo</a>
				</div>
				<br />
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</li>
	<?php endforeach; ?>
	<?php endif; ?>