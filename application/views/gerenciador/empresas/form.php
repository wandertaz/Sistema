<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

	 		<div class="input text obrigatorio">
	 			<label for="nome">Nome</label>
	 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="cnpj">CNPJ</label>
	 			<input name="cpf_cnpj" id="cnpj" type="text" value="<?php echo (isset($registro) ? $registro->cpf_cnpj : ''); ?>" class="required" onkeypress="mascara_cnpj(event, this);" maxlength="18" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="telefone">Telefone</label>
	 			<input name="telefone" maxlength="13" id="telefone" type="text" value="<?php echo (isset($registro) ? $registro->telefone : ''); ?>" class="required" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
			</div>

			<div class="input text obrigatorio">
	 			<label for="endereco">Endereço</label>
	 			<input name="endereco" id="endereco" type="text" value="<?php echo (isset($registro) ? $registro->endereco : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="numero">Número</label>
	 			<input name="numero" id="numero" type="text" value="<?php echo (isset($registro) ? $registro->numero : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="complemento">Complemento</label>
	 			<input name="complemento" id="complemento" type="text" value="<?php echo (isset($registro) ? $registro->complemento : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="bairro">Bairro</label>
	 			<input name="bairro" id="bairro" type="text" value="<?php echo (isset($registro) ? $registro->bairro : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="cidade">Cidade</label>
	 			<input name="cidade" id="cidade" type="text" value="<?php echo (isset($registro) ? $registro->cidade : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="estado">UF</label>
	 			<input name="estado" maxlength="2" id="estado" type="text" value="<?php echo (isset($registro) ? $registro->estado : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="cep">CEP</label>
	 			<input name="cep" id="cep" type="text" value="<?php echo (isset($registro) ? $registro->cep : ''); ?>" class="required" onkeypress="mascaraCep(event, this);" maxlength="9"/>
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "id=\"ativo\" class=\"required\" "); ?>
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />
                        
                        <input name="tipo_pessoa" id="id" type="hidden" value="J" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>