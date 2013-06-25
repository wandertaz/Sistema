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
	 			<label for="pesquisas_id_pesquisas">Pesquisa</label>
	 			<?php echo form_dropdown("pesquisas_id_pesquisas", $pesquisas, set_value("pesquisas_id_pesquisas", (isset($registro) ? $registro->pesquisas_id_pesquisas : "")), "class=\"required\""); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="nome">Nome</label>
	 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="empresa">Empresa</label>
	 			<input name="empresa" id="empresa" type="text" value="<?php echo (isset($registro) ? $registro->empresa : ''); ?>" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="cargo">Cargo/Área</label>
	 			<input name="cargo" id="cargo" type="text" value="<?php echo (isset($registro) ? $registro->cargo : ''); ?>" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="telefone">Telefone</label>
	 			<input name="telefone" id="telefone" type="text" value="<?php echo (isset($registro) ? $registro->telefone : ''); ?>" class="required" onkeypress="mascaraTelefone(event, this);" maxlength="13" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="email">E-mail</label>
	 			<input name="email" id="email" type="text" value="<?php echo (isset($registro) ? $registro->email : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_envio">Data de Envio</label>
	 			<input name="data_envio" id="data_envio" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_envio) : ''); ?>" disabled />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_resposta">Data de Resposta</label>
	 			<input name="data_resposta" id="data_resposta" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_resposta) : ''); ?>" disabled />
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<input name="id_pesquisas_contatos" id="id_pesquisas_contatos" type="hidden" value="<?php echo (isset($registro) ? $registro->id_pesquisas_contatos : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>