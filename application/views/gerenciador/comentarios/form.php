<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

	  		<?php if(isset($registro)): ?>
	  			<h3 style="font-size: 16px; font-weight: normal;">
	  			<strong><?php echo $registro->titulo_registro; ?></strong><br />
	  			<p style="font-size: 12px;"><strong>Área: </strong><?php echo $areas[$registro->area];?><br />
	  			<strong>Data: </strong><?php echo date('d/m/y, H:i:s', strtotime($registro->created));?><br />
	  			</p>
	  			</h3><br />
			<?php endif; ?>

	 		<div class="input text obrigatorio">
	 			<label for="nome">Nome</label>
	 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="email">E-mail</label>
	 			<input name="email" id="email" type="text" value="<?php echo (isset($registro) ? $registro->email : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="comentario">Descrição</label>
				<textarea name="comentario" id="comentario" class="required"><?php echo (isset($registro) ? $registro->comentario : ''); ?></textarea>
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>