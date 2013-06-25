<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $pesquisa->titulo; ?></h3>

	<?php echo form_open_multipart($controller.'/salvar_questionario', array("id"=>"form"));?>
	  	<fieldset>

	  		<div class="input text">
	 			<label for="contato_id">Contato</label>
	 			<?php echo form_dropdown("contato_id", $contatos, set_value("contato_id", (isset($registro) ? $registro->contato_id : "")), "class=\"required\""); ?>
			</div>

			<?php $i = 1 ?>
			<?php foreach($perguntas as $pergunta): ?>
			<div class="input text">

	 			<?php if($pergunta->tipo == 'RAD'): ?>
	 				<?php if(isset($pergunta->opcoes) && $pergunta->opcoes): ?>
		 				<label for="inscritos_id"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></label>
		 				<?php foreach($pergunta->opcoes as $opcao): ?>
		 					<span class="input">
								<input type="radio" name="<?php echo $pergunta->id_pesquisas_perguntas; ?>" value="<?php echo $opcao->id_pesquisas_perguntas_opcoes; ?>">
								<?php echo $opcao->opcao; ?><?php if ( $opcao->tipo == 'A' ) : ?> - <input type="text" name="aberto_<?php echo $opcao->id_pesquisas_perguntas_opcoes; ?>" size="40" style='float: none !important; width:200px  !important;'><?php endif; ?>
							</span>
		 				<?php endforeach; ?>
		 			<?php endif; ?>
	 			<?php elseif($pergunta->tipo == 'CHE'): ?>
	 				<?php if(isset($pergunta->opcoes) && $pergunta->opcoes): ?>
		 				<label for="inscritos_id"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></label>
		 				<?php foreach($pergunta->opcoes as $opcao): ?>
		 					<span class="input">
								<input type="checkbox" name="<?php echo $pergunta->id_pesquisas_perguntas; ?>[]" value="<?php echo $opcao->id_pesquisas_perguntas_opcoes; ?>">
								<?php echo $opcao->opcao; ?><?php if ( $opcao->tipo == 'A' ) : ?> - <input type="text" name="aberto_<?php echo $opcao->id_pesquisas_perguntas_opcoes; ?>"  size="40" style='float: none !important; width:200px  !important;'><?php endif; ?>
							</span>
		 				<?php endforeach; ?>
		 			<?php endif; ?>
	 			<?php elseif($pergunta->tipo == 'P05'): ?>
	 				<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
	 					<label for="inscritos_id"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></label>
		 				<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
		 					<div class="input text">
								<?php echo $subpergunta->pergunta; ?>
								<?php for($i = 1; $i <= 5; $i++): ?>
									<span class="input"><?php echo $i; ?><input type="radio" name="<?php echo $subpergunta->id_pesquisas_perguntas; ?>" value="<?php echo $i; ?>"></span>
								<?php endfor; ?>
							</div>
		 				<?php endforeach; ?>
		 			<?php endif; ?>
	 			<?php elseif($pergunta->tipo == 'P10'): ?>
	 				<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
	 					<label for="inscritos_id"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></label>
						<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
		 					<div class="input text">
								<?php echo $subpergunta->pergunta; ?>
							<?php for($i = 1; $i <= 10; $i++): ?>
									<span class="input"><?php echo $i; ?><input type="radio" name="<?php echo $subpergunta->id_pesquisas_perguntas; ?>" value="<?php echo $i; ?>" ></span>
								<?php endfor; ?>
							</div>
		 				<?php endforeach; ?>
		 			<?php endif; ?>
	 			<?php elseif($pergunta->tipo == 'CLA'): ?>
	 				<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
	 					<label for="inscritos_id"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></label>
		 				<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
		 					<div class="input text">
								<?php echo $subpergunta->pergunta; ?>
								<select class="input" name="<?php echo $subpergunta->id_pesquisas_perguntas; ?>">
									<option value="">--</option>
									<?php for($i = 1; $i <= $pergunta->total_sub_perguntas; $i++): ?>
										<option value="<?php echo $i; ?>" ><?php echo $i; ?></value>
									<?php endfor; ?>
								</select>
							</div>
		 				<?php endforeach; ?>
		 			<?php endif; ?>
	 			<?php else: ?>
 					<label for="inscritos_id"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></label>
					<textarea name="<?php echo $pergunta->id_pesquisas_perguntas; ?>"></textarea>
	 			<?php endif; ?>

			</div>
			<?php $i++; ?>
			<?php endforeach; ?>

			<input type="hidden" name="pesquisa_id" value="<?php echo $pesquisa->id_pesquisas; ?>" />

			<div class="submit">
				<input type="submit" value="Responder" id="envia" />
				<input type="button" value="Voltar" onclick="history.back()" />
			</div>

		</fieldset>
	<?php echo form_close();?>
</div>