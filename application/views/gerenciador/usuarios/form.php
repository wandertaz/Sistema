<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate({
			rules: {
				confirmacao_senha: {equalTo: "#senha"}
			}
		});
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

	  		<div class="input text">
	 			<label for="tipo">Tipo de Usu&aacute;rio</label>
	 			<?php echo form_dropdown("tipo", array('A' => 'Administrador', 'I' => 'Instrutor', 'C' => 'Colunista'), set_value("tipo", (isset($registro) ? $registro->tipo : "")), "class=\"required\""); ?>
			</div>


	 		<div class="input text obrigatorio">
	 			<label for="nome">Nome</label>
	 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="email">E-mail</label>
	 			<input name="email" id="email" type="text" value="<?php echo (isset($registro) ? $registro->email : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="login">Login</label>
	 			<input name="login" id="login" type="text" value="<?php echo (isset($registro) ? $registro->login : ''); ?>" class="required" />
			</div>

			<div class="input text">
	 			<label for="senha">Senha</label>
	 			<input name="senha" id="senha" type="password" value="" class="" />
			</div>

			<div class="input text">
	 			<label for="confirmacao_senha">Confirme a Senha</label>
	 			<input name="confirmacao_senha" id="confirmacao_senha" type="password" value="" class="" />
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>