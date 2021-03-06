<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $pesquisa->titulo; ?></h3>

	  	<fieldset>

			<?php foreach($perguntas as $pergunta): ?>
			<div class="input text">

	 			<?php if($pergunta->tipo == 'RAD'): ?>
	 				<?php if(isset($pergunta->opcoes) && $pergunta->opcoes): ?>
		 				<label for="inscritos_id"><?php echo $pergunta->pergunta; ?></label>
		 				<?php foreach($pergunta->opcoes as $opcao): ?>
		 					<span class="input">
                                <input type="radio"  name="<?php echo $pergunta->id_pesquisas_perguntas; ?>" value="<?php echo $opcao->id_pesquisas_perguntas_opcoes; ?>" <?php if(isset($pergunta->resposta->opcao_resposta) && $pergunta->resposta->opcao_resposta == $opcao->id_pesquisas_perguntas_opcoes): ?> checked <?php endif; ?> disabled >
								<?php echo $opcao->opcao; ?><?php if ( $opcao->tipo == 'A' ) : ?> - <input type="text" name="aberto_<?php echo $opcao->id_pesquisas_perguntas_opcoes; ?>" size="40"><?php endif; ?>
							</span>
		 				<?php endforeach; ?>
		 			<?php endif; ?>
	 			<?php elseif($pergunta->tipo == 'CHE'): ?>
	 				<?php if(isset($pergunta->opcoes) && $pergunta->opcoes): ?>
		 				<label for="inscritos_id"><?php echo $pergunta->pergunta; ?></label>
		 				<?php foreach($pergunta->opcoes as $opcao): ?>
		 					<span class="input">
								<input type="checkbox" name="<?php echo $pergunta->id_pesquisas_perguntas; ?>" value="<?php echo $opcao->id_pesquisas_perguntas_opcoes; ?>" <?php if(isset($pergunta->resposta[$opcao->id_pesquisas_perguntas_opcoes]->opcao_resposta) && $pergunta->resposta[$opcao->id_pesquisas_perguntas_opcoes]->opcao_resposta == $opcao->id_pesquisas_perguntas_opcoes): ?> checked <?php endif; ?> disabled >
								<?php echo $opcao->opcao; ?><?php if ( $opcao->tipo == 'A' ) : ?> - <input type="text" name="aberto_<?php echo $opcao->id_pesquisas_perguntas_opcoes; ?>" size="40" style='float: none !important; width:200px  !important;' disabled<?php if(isset($pergunta->resposta[$opcao->id_pesquisas_perguntas_opcoes]->opcao_resposta) && $pergunta->resposta[$opcao->id_pesquisas_perguntas_opcoes]->opcao_resposta == $opcao->id_pesquisas_perguntas_opcoes): ?> value="<?php echo $pergunta->resposta[$opcao->id_pesquisas_perguntas_opcoes]->resposta; ?>" <?php endif; ?>><?php endif; ?>
							</span>
		 				<?php endforeach; ?>
		 			<?php endif; ?>
	 			<?php elseif($pergunta->tipo == 'P05'): ?>                                                
	 				<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
	 					<label for="inscritos_id"><?php echo $pergunta->pergunta; ?></label>
		 				<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
		 					<div class="input text">
								<?php echo $subpergunta->pergunta; ?>
								<?php for($i = 1; $i <= 5; $i++): ?>
									<span class="input"><?php echo $i; ?><input type="radio" name="<?php echo $subpergunta->id_pesquisas_perguntas; ?>" value="<?php echo $i; ?>" <?php if(isset($subpergunta->resposta->valor) && $subpergunta->resposta->valor == $i): ?> checked <?php endif; ?> disabled ></span>
                                                                        
								<?php endfor; ?>
							</div>
		 				<?php endforeach; ?>
		 			<?php endif; ?>
	 			<?php elseif($pergunta->tipo == 'P10'): ?>
	 				<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
	 					<label for="inscritos_id"><?php echo $pergunta->pergunta; ?></label>
						<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
		 					<div class="input text">
								<?php echo $subpergunta->pergunta; ?>
								<?php for($i = 1; $i <= 10; $i++): ?>
									<span class="input"><?php echo $i; ?><input type="radio" name="<?php echo $subpergunta->id_pesquisas_perguntas; ?>" value="<?php echo $i; ?>" <?php if(isset($subpergunta->resposta->valor) && $subpergunta->resposta->valor == $i): ?> checked <?php endif; ?> disabled ></span>
								<?php endfor; ?>                                                                        
							</div>
		 				<?php endforeach; ?>
		 			<?php endif; ?>
	 			<?php elseif($pergunta->tipo == 'CLA'): ?>
	 				<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
	 					<label for="inscritos_id"><?php echo $pergunta->pergunta; ?></label>
		 				<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
		 					<div class="input text">
								<?php echo $subpergunta->pergunta; ?>
								<select class="input" name="<?php echo $subpergunta->id_pesquisas_perguntas; ?>" disabled>
									<option value="">--</option>
									<?php for($i = 1; $i <= $pergunta->total_sub_perguntas; $i++): ?>
										<option value="<?php echo $i; ?>"  <?php if(isset($subpergunta->resposta->valor) && $subpergunta->resposta->valor == $i): ?> selected <?php endif; ?>><?php echo $i; ?></value>
                                                                                  
									<?php endfor; ?>
								</select>
							</div>
		 				<?php endforeach; ?>
		 			<?php endif; ?>
	 			<?php else: ?>
 					<label for="inscritos_id"><?php echo $pergunta->pergunta; ?></label>
					<textarea name="<?php echo $pergunta->id_pesquisas_perguntas; ?>" disabled ><?php if(isset($pergunta->resposta->resposta)): echo $pergunta->resposta->resposta; endif; ?></textarea>
                                        
	 			<?php endif; ?>

				<?php if(isset($pergunta->sugestao) && $pergunta->sugestao): ?>
					<div class="input text" style="width:600px;"><i><u>Coment&aacute;rio do cliente:</u><br /> <?php echo $pergunta->sugestao->comentario_cliente; ?> </i></div>
				<?php endif; ?>

			</div>
			<?php endforeach; ?>

			<div class="submit">
				<input type="button" value="Voltar" onclick="history.back()" />
			</div>

		</fieldset>
</div>