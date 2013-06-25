<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">
	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar/'.$pasta['id_pasta'], array("id" => "form"));?>

	  	<fieldset>

			<div class="input text">
	 			<label for="armazenamento_pasta_id_pasta">Pasta<br /><i>Pasta que guarda este arquivo.</i></label>
	 			             
                                <select name="armazenamento_pasta_id_pasta" class="required">
                                   <option value="<?php echo $categorias['id_pasta']?>"> <?php echo $categorias['nome'];?> </option>
                                </select>

			</div>

			<div class="input text obrigatorio">
	 			<label for="numero_versao">Número da Versão <br/><i>Ex: 1.1 , 2.0 ... etc</i> </label><br /><br />
	 			<b></b><input name="numero_versao" id="numero_versao" type="text" style="float:none; width:30px;" value="<?php echo (isset($registro) ? $registro->numero_versao : ''); ?>" class="required" />
			</div>
                       
                        <div class="input text obrigatorio">
	 			<label for="data">Data versão</label>
	 			<input name="data_atualizacao" id="data" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_atualizacao) : ''); ?>" class="required datepicker" readonly="readonly" />
                        </div>
                    

                        <div class="input text obrigatorio">
	 			<label for="titulo">Título</label>
	 			<input name="titulo" id="numero_versao" type="text" value="<?php echo (isset($registro) ? $registro->titulo : ''); ?>" class="required" />
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="descricao_versao">Descrição</label>
				<textarea name="descricao_armazenamento" id="descricao_versao" class="required"><?php echo (isset($registro) ? $registro->descricao_armazenamento : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="nome_arquivo_original">Arquivo </label>
	 			<input id="nome_arquivo_original" type="file" name="nome_arquivo_original" size="47">
			</div>
                    
                        <div class="input text">
	 			<label for="nome_arquivo_original">Descrição extensão<br/><i>Ex: áudio, vídeo, planilha, texto... etc</i> </label><br /><br />
	 			<!--<input id="descricao_extensao" type="text" value="<?php echo (isset($registro) ? $registro->descricao_extensao : ''); ?>" name="descricao_extensao" size="50">-->
                                <select name="descricao_extensao" id="descricao_extensao">
                                    <option value="texto" <?php echo (isset($registro) ? $registro->descricao_extensao=='texto'?'selected="selected"':'' : 'selected="selected"'); ?>>Texto</option>
                                    <option value="planilha" <?php echo (isset($registro) ? $registro->descricao_extensao=='planilha'?'selected="selected"':'' : ''); ?>>Planilha</option>
                                    <option value="slide" <?php echo (isset($registro) ? $registro->descricao_extensao=='slide'?'selected="selected"':'' : ''); ?>>Slide</option>
                                    <option value="audio" <?php echo (isset($registro) ? $registro->descricao_extensao=='audio'?'selected="selected"':'' : ''); ?>>Áudio</option>
                                    <option value="video" <?php echo (isset($registro) ? $registro->descricao_extensao=='video'?'selected="selected"':'' : ''); ?>>Vídeo</option>
                                    <option value="outros"<?php echo (isset($registro) ? $registro->descricao_extensao=='outros'?'selected="selected"':'' : ''); ?>>Outros</option>                                     
                                </select> 
			</div>
                    

			<?php if(isset($registro->nome_arquivo_original) && $registro->nome_arquivo_original): ?>
				<div class="input text obrigatorio">
					<label for="imagem">Arquivo Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/armazenamento_nuvem/<?php echo $registro->nome_arquivo_servidor; ?>" target="_blank">Ver Arquivo</a>
				</div>
			<?php endif; ?>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>



			<input name="id_armazenamento" id="id_download_versoes" type="hidden" value="<?php echo (isset($registro) ? $registro->id_armazenamento : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>