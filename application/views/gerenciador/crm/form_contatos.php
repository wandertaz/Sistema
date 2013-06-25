<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> Contato</h3>

	<?php echo form_open_multipart($controller.'/salvar_contato', array("id" => "form"));?>

	  	<fieldset>	  		
                    <!--empresa--><input name="inscritos_id" id="inscritos_id" type="hidden" value="<?php echo (isset($registro) ? $registro->inscritos_id : $inscritos_id); ?>" />
                    <!--id contato--><input name="idcontato_empresa" id="idcontato_empresa" type="hidden" value="<?php echo (isset($registro) ? $registro->idcontato_empresa : ''); ?>" />
			<div class="input text obrigatorio">
	 			<label for="nome">Nome</label>
	 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>
                    
                    	<div class="input text obrigatorio">
	 			<label for="saudacao">Saudação</label>
	 			<input name="saudacao" id="saudacao" type="text" value="<?php echo (isset($registro) ? $registro->saudacao : ''); ?>" class="required" />
			</div>   


			<div class="input text">
	 			<label for="forma_de_tratamento">Forma de Tratamento</label>
	 			<?php echo form_dropdown("forma_de_tratamento", array('Sr' => 'Senhor', 'Srª' => 'Senhora','V.' => 'Você'), set_value("forma_de_tratamento", (isset($registro) ? $registro->forma_de_tratamento : "")), "id=\"forma_de_tratamento\" class=\"required\" "); ?>
			</div>
                    
                    
	 		<div class="input text obrigatorio">
	 			<label for="cpf">Cpf</label>
                                <input name="cpf" id="cpf" onblur="javascript:validaCPF()" type="text" value="<?php echo (isset($registro) ? $registro->cpf : ''); ?>" class="required" />
			</div> 
                    	<div class="input text">
	 			<label for="sexo">Sexo</label>
	 			<?php  echo form_dropdown("sexo", array(''=>'Selecione','F' => 'Feminino', 'M' => 'Masculino'), set_value("sexo", (isset($registro) ? $registro->sexo : "")), "id=\"sexo\" class=\"required\" "); ?>
			</div> 
                    
			<div class="input text obrigatorio">
	 			<label for="cargo">Cargo</label>
	 			<input name="cargo" id="cargo" type="text" value="<?php echo (isset($registro) ? $registro->cargo : ''); ?>" class="required" />
			</div>
                        <div class="input text obrigatorio">
	 			<label for="area">Área/Departamento/Setor</label>
	 			<input name="area" id="cargo" type="text" value="<?php echo (isset($registro) ? $registro->area : ''); ?>" class="required" />
			</div>

			<div class="input text">
	 			<label for="contato_principal">Contato Principal?</label>
	 			<?php  echo form_dropdown("contato_principal", array('C' => 'Celular', 'T' => 'Telefone','E'=>'E-mail'), set_value("contato_principal", (isset($registro) ? $registro->contato_principal : "")), "id=\"contato_principal\" class=\"required\" "); ?>
			</div>                        
                        
                        <div class="input text obrigatorio">
	 			<label for="email">E-mail 1</label>
	 			<input name="email" id="email" type="text" value="<?php echo (isset($registro) ? $registro->email : ''); ?>" class="required" />
			</div>
                        <div class="input text obrigatorio">
	 			<label for="email_secundario">E-mail 2</label>
	 			<input name="email_secundario" id="email_secundario" type="text" value="<?php echo (isset($registro) ? $registro->email_secundario : ''); ?>" class="required" />
			</div>
                        

			<div class="input text obrigatorio">
	 			<label for="telefone">Telefone 1</label>
	 			<input name="telefone" maxlength="14" id="telefone" type="text" value="<?php echo (isset($registro) ? $registro->telefone : ''); ?>" class="required" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
			</div>
                        
                       <div class="input text obrigatorio">
	 			<label for="ramal">Ramal</label>
	 			<input name="ramal" maxlength="4" id="ramal" type="text" value="<?php echo (isset($registro) ? $registro->ramal : ''); ?>"  maxlength="4"/>
			</div>
                    
                        <div class="input text obrigatorio">
	 			<label for="telefone2">Telefone 2</label>
	 			<input name="telefone2" maxlength="14" id="telefone2" type="text" value="<?php echo (isset($registro) ? $registro->telefone2 : ''); ?>" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
			</div>

			<div class="input text obrigatorio">
	 			<label for="celular">Celular 1</label>
	 			<input name="celular" maxlength="14" id="celular" type="text" value="<?php echo (isset($registro) ? $registro->celular : ''); ?>" class="" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
			</div>
                        <div class="input text obrigatorio">
	 			<label for="celular2">Celular 2</label>
	 			<input name="celular2" maxlength="14" id="celular2" type="text" value="<?php echo (isset($registro) ? $registro->celular2 : ''); ?>" class="" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
			</div>
                        
                       <div class="input text obrigatorio">
	 			<label for="fax">Fax</label>
	 			<input name="fax" maxlength="14" id="fax" type="text" value="<?php echo (isset($registro) ? $registro->fax : ''); ?>" class="" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
		       </div>

			<div class="input text obrigatorio">
	 			<label for="data_nascimento">Data de Nascimento</label>
	 			<input name="data_nascimento" id="data_nascimento" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_nascimento) : ''); ?>" class="required datepicker3" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>
                        
                        <div class="input text obrigatorio">
	 			<label for="outra_informacoes">Outras Informações</label>
	 			<textarea name="outra_informacoes" id="outra_informacoes" class=""><?php echo (isset($registro) ? $registro->outra_informacoes : ''); ?></textarea>
			</div>

		
			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>