     <div class="destaques">
      	<h1>Downloads<br /> em destaques</h1>
      	<a href="#" class="ver-todos">Ver todos destaques</a>
		<ul>
		<?php foreach($query_destaques->result() as $destaque): ?>
			<li>
				<div>
					<h3><?php echo $destaque->nome_categoria; ?></h3>
					<h4><a href="#"><?php echo $destaque->titulo; ?></a></h4>
                    <?php $dadosversao = retorna_ultima_versao_downloads($destaque->id_downloads); ?>
              
					<p class="desc"><?php echo $destaque->descricao; ?></p>
                    <p>Versão: 1.<?php echo $dadosversao[0]['numero_versao']; ?></p>
                    <p><label><input type="checkbox" name="aceite-termos-<?php echo $destaque->id_downloads; ?>"> Li e aceito os <a class="various" data-fancybox-type="iframe" href="<? echo site_url('contato/aceite_me/4');?>">termos de uso</a></label></p>
                </div>

				<p class="price">Comprar por: <strong>R$ <?php echo $destaque->preco; ?></strong></p>
                <a href="<?php echo site_url('carrinho/adicionar').'/'.$destaque->id_downloads.'/DO/false/'.$TipoAcesso;?>" class="button-comprar" title="Comprar">Comprar</a>                
			</li>
		<?php endforeach; ?>
		</ul>
     </div>