<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>
<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> Empresa</h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

                    <input type="hidden" name="tipo_pessoa" id="tipo_pessoa" value="J" />

	<!--		<div class="input text">
	 			<label for="inscrito_responsavel_id">Responsável</label>
	 			<?php //echo form_dropdown("inscrito_responsavel_id", $inscritos, set_value("inscrito_responsavel_id", (isset($registro) ? $registro->inscrito_responsavel_id : "")), "id=\"inscrito_responsavel_id\" "); ?>
			</div>

			<div class="input text">
	 			<label for="empresa_id">Empresa (Cursos In Company e Programa de Desenvolvimento)</label>
	 			<?php //echo form_dropdown("empresa_id", $empresas, set_value("empresa_id", (isset($registro) ? $registro->empresa_id : "")), "id=\"empresa_id\" "); ?>
			</div>
-->
	 		<div class="input text obrigatorio">
	 			<label for="nome">Razão Social</label>
	 			<input name="razao_social" id="razao_social" type="text" value="<?php echo (isset($registro) ? $registro->razao_social : ''); ?>" class="required" />
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="nome">Nome Fantasia</label>
	 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>

                        <div class="input text obrigatorio">
	 			<label for="nome">Nome Gestor</label>
	 			<input name="nome_gestor" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome_gestor : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="email">E-mail Gestor</label>
	 			<input name="email" id="email" type="text" value="<?php echo (isset($registro) ? $registro->email : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="senha">Senha</label>
	 			<input name="senha" id="senha" type="password" value="<?php echo (isset($registro) ? $registro->senha : ''); ?>" class="required" />
			</div>


			<div class="input text obrigatorio">
	 			<label for="cpf_cnpj">CNPJ</label>
	 			<input name="cpf_cnpj" id="cpf_cnpj" type="text" value="<?php echo (isset($registro) ? $registro->cpf_cnpj : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_nascimento">Data de Fundação</label>
	 			<input name="data_nascimento" id="data_nascimento" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_nascimento) : ''); ?>" class="required" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>

			<!--<div class="input text">
	 			<label for="sexo">Sexo</label>
	 			<?php //echo form_dropdown("sexo", array('F' => 'Feminino', 'M' => 'Masculino'), set_value("sexo", (isset($registro) ? $registro->sexo : "")), "id=\"sexo\" class=\"required\" "); ?>
			</div>-->

			<div class="input text obrigatorio">
	 			<label for="telefone">Telefone Gestor</label>
	 			<input name="telefone" maxlength="14" id="telefone" type="text" value="<?php echo (isset($registro) ? $registro->telefone : ''); ?>" class="required" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
			</div>

			<div class="input text obrigatorio">
	 			<label for="celular">Celular Gestor</label>
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
	 			<label for="profissao">Cargo Gestor</label>
	 			<input name="profissao" id="profissao" type="text" value="<?php echo (isset($registro) ? $registro->profissao : ''); ?>" class="" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="como_conheceu">Como Conheceu a MB</label>
	 			<textarea name="como_conheceu" id="como_conheceu" class=""><?php echo (isset($registro) ? $registro->como_conheceu : ''); ?></textarea>
			</div>
                        
                        
                        <div class="input text">
	 			<label for="atuacao_empresa">Ramo de atuação</label>
	 			<?php echo form_dropdown("atuacao_empresa", array('Indústria' => 'Indústria', 'Comércio' => 'Comércio','Serviços'=>'Serviços',''=>'Construção Civil','Gestão Pública'=>'Gestão Pública'), set_value("atuacao_empresa", (isset($registro) ? $registro->atuacao_empresa : "")), "id=\"atuacao_empresa\" class=\"required\" "); ?>
			</div>
                        <div class="input text">
	 			<label for="porte_empresa">Porte da empresa</label>
	 			<?php echo form_dropdown("porte_empresa", array('G' => 'Grande', 'M' => 'Média','P'=>'Pequena'), set_value("porte_empresa", (isset($registro) ? $registro->porte_empresa : "")), "id=\"porte_empresa\" class=\"required\" "); ?>
			</div>
                        
                       <div class="input text">
	 			<label for="nacionalidade_empresa">Nacionalidade</label>
	 			<?php echo form_dropdown("nacionalidade_empresa", array('N' => 'Nacional', 'M' => 'Multinacional'), set_value("nacionalidade_empresa", (isset($registro) ? $registro->nacionalidade_empresa : "")), "id=\"nacionalidade_empresa\" class=\"required\" "); ?>
			</div>
                        
                        
                        <div class="input text obrigatorio">
	 			<label for="descricao_atividades">Descrição sumária das atividades da empresa</label>
	 			<textarea name="descricao_atividades" id="descricao_atividades" class=""><?php echo (isset($registro) ? $registro->descricao_atividades : ''); ?></textarea>
			</div>
                        
			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "id=\"ativo\" class=\"required\" "); ?>
			</div>                       
                       
			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>