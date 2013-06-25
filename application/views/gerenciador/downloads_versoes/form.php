<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

			<div class="input text">
	 			<label for="autodiagnosticos_id_autodiagnostico">Download</label>
	 			<?php echo form_dropdown("downloads_id_downloads", $downloads, set_value("downloads_id_downloads", (isset($registro) ? $registro->downloads_id_downloads : "")), "class=\"required\""); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="numero_versao">Número da Versão</label><br />
	 			<input name="numero_versao" id="numero_versao" type="text" value="<?php echo (isset($registro) ? $registro->numero_versao : ''); ?>" class="required" />
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="descricao_versao">Descrição</label>
				<textarea name="descricao_versao" id="descricao_versao" class="required"><?php echo (isset($registro) ? $registro->descricao_versao : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="nome_arquivo_original">Arquivo </label>
	 			<input id="nome_arquivo_original" type="file" name="nome_arquivo_original" size="47">
			</div>

			<?php if(isset($registro->nome_arquivo_servidor) && $registro->nome_arquivo_servidor): ?>
				<div class="input text obrigatorio">
					<label for="imagem">Arquivo Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/downloads/<?php echo $registro->nome_arquivo_servidor; ?>" target="_blank">Ver Arquivo</a>
				</div>
			<?php endif; ?>

			<div class="input text obrigatorio">
	 			<label for="nome_arquivo_original">Descrição extensão<br/><i>Ex: áudio, vídeo, planilha, texto... etc</i> </label><br /><br />
	 			<!--<input name="descricao_extensao" id="descricao_extensao" type="text" value="<?php //echo (isset($registro) ? $registro->descricao_extensao : ''); ?>" />-->
                                <select name="descricao_extensao" id="descricao_extensao">
                                    <option value="texto" <?php echo (isset($registro) ? $registro->descricao_extensao=='texto'?'selected="selected"':'' : 'selected="selected"'); ?>>Texto</option>
                                    <option value="planilha" <?php echo (isset($registro) ? $registro->descricao_extensao=='planilha'?'selected="selected"':'' : ''); ?>>Planilha</option>
                                    <option value="slide" <?php echo (isset($registro) ? $registro->descricao_extensao=='slide'?'selected="selected"':'' : ''); ?>>Slide</option>
                                    <option value="audio" <?php echo (isset($registro) ? $registro->descricao_extensao=='audio'?'selected="selected"':'' : ''); ?>>Áudio</option>
                                    <option value="video" <?php echo (isset($registro) ? $registro->descricao_extensao=='video'?'selected="selected"':'' : ''); ?>>Vídeo</option>
                                    <option value="outros"<?php echo (isset($registro) ? $registro->descricao_extensao=='outros'?'selected="selected"':'' : ''); ?>>Outros</option>                                     
                                </select> 
                        
                        </div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<div class="input text">
	 			<label for="cobrada">Cobrar Atualização (para compradores de outras versões)? <br /><i>Se SIM, compradores de versões antigas terão de comprar para ter acesso ao arquivo atualizado. Se NÃO, esta versão estará disponível gratuitamente na área restrita (somente para quem já possui outra versão). </i></label>
	 			<?php echo form_dropdown("cobrada", array('S' => 'Sim', 'N' => 'Não'), set_value("cobrada", (isset($registro) ? $registro->cobrada : "")), "class=\"required\""); ?>
			</div>

			<input name="id_download_versoes" id="id_download_versoes" type="hidden" value="<?php echo (isset($registro) ? $registro->id_download_versoes : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>