<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> Folowups</h3>

	<?php echo form_open_multipart($controller.'/salvar_folowups', array("id" => "form"));?>

	  	<fieldset>	  		
                    <!--empresa--><input name="proposta_id" id="proposta_id" type="hidden" value="<?php echo (isset($proposta_id) ? $proposta_id :''); ?>" />
                    <?php if (isset($registro)): ?><!--id projeto--><input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" /><?php endif; ?>
			
                    

			<div class="input text obrigatorio">
	 			<label for="data_acao">Data da Ação</label>
	 			<input name="data_acao" id="data_acao" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_acao) : ''); ?>" class="required datepicker2" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>
                    

			<div class="input text obrigatorio">
	 			<label for="id_usuario_responsavel_folowups">Responsável pelo Folowup (MB)</label>
	 			<?php  echo form_dropdown("id_usuario_responsavel_folowups", $usuarios, set_value("id_usuario_responsavel_folowups", (isset($registro) ? $registro->id_usuario_responsavel_folowups : "")), "id=\"id_usuario_responsavel_folowups\" class=\"required\" "); ?>
			</div>
                    
			<div class="input text obrigatorio">
	 			<label for="contato_empresa_id">Nome do Contato do Cliente</label>
	 			<?php  echo form_dropdown("contato_empresa_id", $contatos, set_value("contato_empresa_id", (isset($registro) ? $registro->contato_empresa_id : "")), "id=\"contato_empresa_id\" class=\"required\" "); ?>
			</div>
                    
                        <div class="input text obrigatorio">
	 			<label for="descricao_acao">Descrição da ação</label>
	 			<textarea name="descricao_acao" id="descricao_acao" class=""><?php echo (isset($registro) ? $registro->descricao_acao : ''); ?></textarea>
			</div>
                    
                        <div class="input text">
	 			<label for="retorno_cliente">Retorno do cliente</label>
	 			<textarea name="retorno_cliente" id="retorno_cliente" class=""><?php echo (isset($registro) ? $registro->retorno_cliente : ''); ?></textarea>
			</div>
                    
                        <div class="input text">
	 			<label for="condicao_promocao">Condição especial/Promoção</label>
	 			<textarea name="condicao_promocao" id="condicao_promocao" class=""><?php echo (isset($registro) ? $registro->condicao_promocao : ''); ?></textarea>
			</div>

		
			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>