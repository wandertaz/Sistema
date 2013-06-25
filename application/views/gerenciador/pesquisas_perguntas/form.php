<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>
  
                    <?php if($sugestao):?>
                        <div class="input text" style="float:right;">
                            <label for="pesquisas_id_pesquisas">Sugestão:&nbsp;</label>
                                        <div class="input text" style="border:1px #CC0000 dashed">
                                            <?php echo($sugestao->comentario_cliente);?>
                                        </div>
                        </div>
                    <?php endif;?>
                    
			<div class="input text">
	 			<label for="pesquisas_id_pesquisas">Pesquisa</label>
	 			<?php echo form_dropdown("pesquisas_id_pesquisas", $pesquisas, set_value("pesquisas_id_pesquisas", (isset($registro) ? $registro->pesquisas_id_pesquisas : "")), "class=\"required\""); ?>
			</div>

			<div class="input text">
	 			<label for="pesquisas_perguntas_id_pesquisas_perguntas">Esta é uma sub-pergunta? Escolha a Pergunta principal para agrupamento.</label>
	 			<?php echo form_dropdown("pesquisas_perguntas_id_pesquisas_perguntas", $perguntas, set_value("pesquisas_perguntas_id_pesquisas_perguntas", (isset($registro) ? $registro->pesquisas_perguntas_id_pesquisas_perguntas : ""))); ?>
			</div>

			<div class="input text">
	 			<label for="tipo">Tipo da Pergunta</label>
	 			<?php echo form_dropdown("tipo", $tipos_pergunta, set_value("tipo", (isset($registro) ? $registro->tipo : "")), "class=\"required\""); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="numero">Número</label>
	 			<input name="numero" id="numero" type="text" value="<?php echo (isset($registro) ? $registro->numero : ''); ?>" class="required" onkeypress="return apenasNumeros(event);" />
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="pergunta">Pergunta</label>
	 			<input name="pergunta" id="pergunta" type="text" value="<?php echo (isset($registro) ? $registro->pergunta : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="limite_respostas">Limite de Respostas?</label>
	 			<input name="limite_respostas" id="limite_respostas" type="text" value="<?php echo (isset($registro) ? $registro->limite_respostas : ''); ?>" onkeypress="return apenasNumeros(event);" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="limite_caracteres">Limite de Caracteres?</label>
	 			<input name="limite_caracteres" id="limite_caracteres" type="text" value="<?php echo (isset($registro) ? $registro->limite_caracteres : ''); ?>" onkeypress="return apenasNumeros(event);" />
			</div>

			<div class="input text">
	 			<label for="obrigatorio">Pergunta obrigatória?</label>
	 			<?php echo form_dropdown("obrigatorio", array('S' => 'Sim', 'N' => 'Não'), set_value("obrigatorio", (isset($registro) ? $registro->obrigatorio : "")), "class=\"required\""); ?>
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<input name="id_pesquisas_perguntas" id="id_pesquisas_perguntas" type="hidden" value="<?php echo (isset($registro) ? $registro->id_pesquisas_perguntas : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>
                

	<?php echo form_close();?>

</div>