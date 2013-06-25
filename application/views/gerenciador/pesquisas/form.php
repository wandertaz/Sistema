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
	 			<label for="inscritos_id">Cliente</label>
	 			<?php echo form_dropdown("inscritos_id", $inscritos, set_value("inscritos_id", (isset($registro) ? $registro->inscritos_id : "")), "class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="titulo">Título</label>
	 			<input name="titulo" id="titulo" type="text" value="<?php echo (isset($registro) ? $registro->titulo : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="logo">Logo </label>
	 			<input id="logo" type="file" name="logo" size="47">
	 			<span> (145x34)</span>
			</div>

			<?php if(isset($registro->logo) && $registro->logo): ?>
				<div class="input text obrigatorio">
					<label for="imagem">Logo Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/logo/<?php echo $registro->logo; ?>" target="_blank">Ver Imagem</a>
				</div>
			<?php endif; ?>

			<div class="input text obrigatorio">
	 			<label for="apresentacao">Texto de Apresentação</label><br />
				<textarea name="apresentacao" id="apresentacao" class="editor"><?php echo (isset($registro) ? $registro->apresentacao : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="agradecimentos">Texto de Agradecimento</label><br />
				<textarea name="agradecimentos" id="agradecimentos" class="editor"><?php echo (isset($registro) ? $registro->agradecimentos : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="mensagem_email">Texto de E-mail (Enviado ao pesquisado)</label><br />
				<textarea name="mensagem_email" id="mensagem_email" class="editor"><?php echo (isset($registro) ? $registro->mensagem_email : ''); ?></textarea>
			</div>
	 		<!--<div class="input text obrigatorio">
	 			<label for="titulo">Mail Chimp</label>-->
                                <input disabled="disabled"  id="mailchimp_list_id" type="hidden" value="<?php echo (isset($registro) ? $registro->mailchimp_list_id : ''); ?>"/>
			<!--</div>-->
			
                    
                    
                    
                    
                        <div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('N' => 'Não', 'S' => 'Sim'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>
			<?php if ( $flag_status ) : ?>
			<div class="input text">
	 			<label for="status">Status</label>
	 			<?php echo form_dropdown("status_exibir", array('IN' => 'Status Inicial','NA' => 'Não Aprovado', 'AL' => 'Alteração', 'AP' => 'Aprovado'), set_value("status", (isset($registro) ? $registro->status : "")), "class=\"required\" disabled"); ?>
				
	 			<input id="status" type="hidden" name="status" value="<?php echo $registro->status; ?>">
			</div>
			<div class="input text obrigatorio">
	 			<label for="arquivo_relatorio">Arquivo de Relatório </label>
	 			<input id="arquivo_relatorio" type="file" name="arquivo_relatorio" size="47">
			</div>

			<?php if(isset($registro->arquivo_relatorio) && $registro->arquivo_relatorio): ?>
				<div class="input text obrigatorio">
					<label for="arquivo_relatorio">Relatório Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/logo/<?php echo $registro->arquivo_relatorio; ?>" target="_blank">Ver Arquivo</a>
				</div>
			<?php endif; ?>

			<?php if(isset($registro->arquivo_dados) && $registro->arquivo_dados): ?>
				<div class="input text obrigatorio">
					<label for="arquivo_dados">Base de dados enviada pelo cliente:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/ModuloPesquisa/Arquivos/<?php echo $registro->arquivo_dados; ?>" target="_blank">Ver Arquivo</a>
				</div>
			<?php endif; ?>
			
			<?php endif; ?>

			<input name="id_pesquisas" id="id_pesquisas" type="hidden" value="<?php echo (isset($registro) ? $registro->id_pesquisas : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>