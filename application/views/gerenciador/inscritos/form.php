<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> Inscrito</h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

	  		<input type="hidden" name="tipo_pessoa" id="tipo_pessoa" value="F" />

	 		<div class="input text obrigatorio">
	 			<label for="nome">Nome</label>
	 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="email">E-mail</label>
	 			<input name="email" id="email" type="text" value="<?php echo (isset($registro) ? $registro->email : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="senha">Senha</label>
	 			<input name="senha" id="senha" type="password" value="<?php echo (isset($registro) ? $registro->senha : ''); ?>" class="required" />
			</div>			

			<div class="input text obrigatorio">
	 			<label for="cpf_cnpj">CPF/CNPJ</label>
	 			<input name="cpf_cnpj" id="cpf_cnpj" type="text" value="<?php echo (isset($registro) ? $registro->cpf_cnpj : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_nascimento">Data de Nascimento</label>
	 			<input name="data_nascimento" id="data_nascimento" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_nascimento) : ''); ?>" class="required" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>

			<div class="input text">
	 			<label for="sexo">Sexo</label>
	 			<?php echo form_dropdown("sexo", array('F' => 'Feminino', 'M' => 'Masculino'), set_value("sexo", (isset($registro) ? $registro->sexo : "")), "id=\"sexo\" class=\"required\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="telefone">Telefone</label>
	 			<input name="telefone" maxlength="14" id="telefone" type="text" value="<?php echo (isset($registro) ? $registro->telefone : ''); ?>" class="required" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
			</div>

			<div class="input text obrigatorio">
	 			<label for="celular">Celular</label>
	 			<input name="celular" maxlength="14" id="celular" type="text" value="<?php echo (isset($registro) ? $registro->celular : ''); ?>" class="" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
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
	 			<input name="complemento" id="complemento" type="text" value="<?php echo (isset($registro) ? $registro->complemento : ''); ?>"/>
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

			<div class="input text obrigatorio">
	 			<label for="profissao">Profissão</label>
	 			<input name="profissao" id="profissao" type="text" value="<?php echo (isset($registro) ? $registro->profissao : ''); ?>" class="" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="como_conheceu">Como Conheceu a MB</label>
	 			<textarea name="como_conheceu" id="como_conheceu" class=""><?php echo (isset($registro) ? $registro->como_conheceu : ''); ?></textarea>
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "id=\"ativo\" class=\"required\" "); ?>
			</div>
                        <?php
                       // print_r( $_SERVER['HTTP_REFERER'].'***'.site_url('/multitools/inscritos/index/F'));

                        ?>
                       <?php if($_SERVER['HTTP_REFERER']== site_url('/multitools/inscritos/index/F')):?>
			<!--<div class="input text">
				<label>Banco de Talentos</label>
			</div>-->

			<div class="input text obrigatorio">
	 			<label for="religiao">Religião</label>
	 			<input name="religiao" id="religiao" type="text" value="<?php echo (isset($registro) ? $registro->religiao : ''); ?>" />
			</div>

			<div class="input text">
	 			<label for="estadocivil">Estado Civil</label>
	 			<?php echo form_dropdown("estadocivil", $estados_civis, set_value("estadocivil", (isset($registro) ? $registro->ativo : "")), "id=\"estadocivil\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="filhos">Filhos?</label>
	 			<?php echo form_dropdown("filhos", array('N' => 'Não', 'S' => 'Sim'), set_value("filhos", (isset($registro) ? $registro->filhos : "")), "id=\"filhos\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="qtd_filhos">Quantos filhos?</label>
	 			<input name="qtd_filhos" id="qtd_filhos" type="text" value="<?php echo (isset($registro) ? $registro->qtd_filhos : ''); ?>" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="cnh">Possui CNH?</label>
	 			<?php echo form_dropdown("cnh", array('N' => 'Não', 'S' => 'Sim'), set_value("cnh", (isset($registro) ? $registro->cnh : "")), "id=\"cnh\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="veiculo">Possui Veículo?</label>
	 			<?php echo form_dropdown("veiculo", array('N' => 'Não', 'S' => 'Sim'), set_value("veiculo", (isset($registro) ? $registro->veiculo : "")), "id=\"veiculo\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="deficiencia">Possui alguma deficiência?</label>
	 			<?php echo form_dropdown("deficiencia", array('N' => 'Não', 'S' => 'Sim'), set_value("deficiencia", (isset($registro) ? $registro->deficiencia : "")), "id=\"deficiencia\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="qual_deficiencia">Qual deficiência?</label>
	 			<input name="qual_deficiencia" id="qual_deficiencia" type="text" value="<?php echo (isset($registro) ? $registro->qual_deficiencia : ''); ?>" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="link_facebook">Facebook</label>
	 			<input name="link_facebook" id="link_facebook" type="text" value="<?php echo (isset($registro) ? $registro->link_facebook : ''); ?>" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="link_twitter">Twitter</label>
	 			<input name="link_twitter" id="link_twitter" type="text" value="<?php echo (isset($registro) ? $registro->link_twitter : ''); ?>" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="link_linkedin">Linkedin</label>
	 			<input name="link_linkedin" id="link_linkedin" type="text" value="<?php echo (isset($registro) ? $registro->link_linkedin : ''); ?>" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="trabalhar_outra_cidade">Possui disponibilidade para trabalhar em outra cidade?</label>
	 			<?php echo form_dropdown("trabalhar_outra_cidade", array('N' => 'Não', 'S' => 'Sim'), set_value("trabalhar_outra_cidade", (isset($registro) ? $registro->trabalhar_outra_cidade : "")), "id=\"trabalhar_outra_cidade\" "); ?>
			</div>
                        <?php endif;?>
			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>