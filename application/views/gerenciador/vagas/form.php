<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	}
	);
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

	  		<div class="input text obrigatorio">
	 			<label for="inscritos_id">Empresa</label>
	 			<?php echo form_dropdown("inscritos_id", $empresas, set_value("inscritos_id", (isset($registro) ? $registro->inscritos_id : "")), "id=\"inscritos_id\" class=\"required\" "); ?>
			</div>

			<div class="input text">
	 			<label for="exibir_nome_empresa">Exibir nome da empresa?</label>
	 			<?php echo form_dropdown("exibir_nome_empresa", array('S' => 'Sim', 'N' => 'Não'), set_value("exibir_nome_empresa", (isset($registro) ? $registro->exibir_nome_empresa : "")), "id=\"exibir_nome_empresa\" "); ?>
			</div>

			<div class="input text">
	 			<label for="titulo_cargo">Título do Cargo</label>
	 			<input name="titulo_cargo" id="titulo_cargo" type="text" value="<?php echo (isset($registro) ? $registro->titulo_cargo : ''); ?>" class="required" />
			</div>

			<div class="input text">
	 			<label for="descricao">Breve Descrição da vaga</label>
	 			<textarea name="descricao" id="descricao"><?php echo (isset($registro) ? $registro->descricao : ''); ?></textarea>
			</div>

			<div class="input text">
	 			<label for="quantidade_vagas">Quantidade de Vagas</label>
	 			<input name="quantidade_vagas" id="quantidade_vagas" type="text" value="<?php echo (isset($registro) ? $registro->quantidade_vagas : ''); ?>" />
			</div>

			<div class="input text">
	 			<label for="cidade_atuacao">Cidade onde o profissional irá atuar</label>
	 			<input name="cidade_atuacao" id="cidade_atuacao" type="text" value="<?php echo (isset($registro) ? $registro->cidade_atuacao : ''); ?>" />
			</div>

	  		<div class="input text obrigatorio">
	 			<label for="niveis_de_atuacao_id_nivel">Níveis de Atuação</label>
	 			<?php echo form_dropdown("niveis_de_atuacao_id_nivel", $niveis_atuacao, set_value("niveis_de_atuacao_id_nivel", (isset($registro) ? $registro->niveis_de_atuacao_id_nivel : "")), "id=\"niveis_de_atuacao_id_nivel\" class=\"required\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="niveis_de_atuacao_id_nivel">Áreas de Atuação</label>
	 			<?php foreach($areas_atuacao as $id_area => $area_atuacao): ?>
	 				<div class="input text">
					<input style="width: 15px;" type="checkbox" name="areas_atuacao[]" id="areas_atuacao" value="<?php echo $id_area ?>" <?php if(isset($areas_atuacao_vagas) && in_array($id_area, $areas_atuacao_vagas)): ?> checked="checked" <?php endif; ?>> <p style="float:left; padding: 0 5px;"><?php echo $area_atuacao; ?></p>
	 				</div>
				<?php endforeach; ?>
			</div>

			<div class="input text">
	 			<label for="grau_formacao">Grau de Formação</label>
	 			<?php echo form_dropdown("grau_formacao", array('' => '--Selecione--') + $graus_formacao, set_value("grau_formacao", (isset($registro) ? $registro->grau_formacao : "")), "id=\"grau_formacao\" class=\"grau_formacao\" "); ?>
			</div>

			<div class="input text">
	 			<label for="curso_formacao">Curso de Formação</label>
	 			<input name="curso_formacao" id="curso_formacao" type="text" value="<?php echo (isset($registro) ? $registro->curso_formacao : ''); ?>" />
			</div>

			<div class="input text">
	 			<label for="outros_cursos">Qualificação (outros cursos)</label>
	 			<textarea name="outros_cursos" id="outros_cursos"><?php echo (isset($registro) ? $registro->outros_cursos : ''); ?></textarea>
			</div>

                        <div class="input text obrigatorio">
	 			<label for="experiencia">Experiência</label>
                               
	 				<div class="input text">
                                            <input style="width: 15px;" type="radio" name="experiencia" id="experiencia" value="Não é necessária experiência" <?php echo (isset($registro) ? $registro->experiencia=='Não é necessária experiência'?'checked=""':'': ''); ?>> <p style="float:left; padding: 0 5px;">Não é necessária experiência</p>
	 				</div>
                                
                                	 <div class="input text">
                                            <input style="width: 15px;" type="radio" name="experiencia" id="experiencia" value="6 meses a 1 ano" <?php echo (isset($registro) ? $registro->experiencia=='6 meses a 1 ano'?'checked=""':'': ''); ?>> <p style="float:left; padding: 0 5px;">6 meses a 1 ano</p>
	 				</div>
                                
                                        <div class="input text">
                                            <input style="width: 15px;" type="radio" name="experiencia" id="experiencia" value="1 a 2 anos" <?php echo (isset($registro) ? $registro->experiencia=='1 a 2 anos'?'checked=""':'': ''); ?>> <p style="float:left; padding: 0 5px;">1 a 2 anos</p>
	 				</div>
                                
                                	<div class="input text">
                                            <input style="width: 15px;" type="radio" name="experiencia" id="experiencia" value="2 a 4 anos" <?php echo (isset($registro) ? $registro->experiencia=='2 a 4 anos'?'checked=""':'': ''); ?>> <p style="float:left; padding: 0 5px;">2 a 4 anos</p>
	 				</div>
                                
                                	<div class="input text">
                                            <input style="width: 15px;" type="radio" name="experiencia" id="experiencia" value="Acima de 5 anos" <?php echo (isset($registro) ? $registro->experiencia=='Acima de 5 anos'?'checked=""':'': ''); ?>> <p style="float:left; padding: 0 5px;">Acima de 5 anos</p>
	 				</div>
                                        <div class="input text">
                                            <input style="width: 15px;" type="radio" name="experiencia" id="experiencia" value="Acima de 10 anos" <?php echo (isset($registro) ? $registro->experiencia=='Acima de 10 anos'?'checked=""':'': ''); ?>> <p style="float:left; padding: 0 5px;">Acima de 10 anos</p>
	 				</div>
				
			</div>
                    

			<div class="input text">
	 			<label for="conhecimentos_necessarios">Habilidades e Conhecimentos Necessários</label>
	 			<textarea name="conhecimentos_necessarios" id="conhecimentos_necessarios"><?php echo (isset($registro) ? $registro->conhecimentos_necessarios : ''); ?></textarea>
			</div>

			<div class="input text">
	 			<label for="sexo">Sexo</label>
	 			<?php echo form_dropdown("sexo", array('I' => 'Indiferente', 'F' => 'Feminino', 'M' => 'Masculino'), set_value("sexo", (isset($registro) ? $registro->sexo : "")), "id=\"sexo\" "); ?>
			</div>

			<div class="input text">
	 			<label for="idade_minima">Idade Mínima</label>
	 			<input name="idade_minima" id="idade_minima" type="text" value="<?php echo (isset($registro) ? $registro->idade_minima : ''); ?>" />
			</div>

			<div class="input text">
	 			<label for="idade_maxima">Idade Máxima</label>
	 			<input name="idade_maxima" id="idade_maxima" type="text" value="<?php echo (isset($registro) ? $registro->idade_maxima : ''); ?>" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="idiomas">Idiomas</label>

	 			<?php foreach($idiomas as $id_idioma => $idioma): ?>
	 				<div class="input text">
						<input style="width: 15px;" type="checkbox" name="idiomas[]" id="idiomas" value="<?php echo $id_idioma ?>" <?php if(isset($ids_idiomas_vagas) && in_array($id_idioma, $ids_idiomas_vagas)): ?> checked="checked" <?php endif; ?> onclick="$('#niveis_<?php echo $id_idioma; ?>').toggle(); "> <p style="float:left; padding: 0 5px;"><?php echo $idioma; ?></p>

	 						<div id="niveis_<?php echo $id_idioma; ?>" <?php if(!isset($idiomas_vagas[$id_idioma])): ?> style="display:none;" <?php endif; ?> >
								<div class="input text">
						 			<label for="nivel_leitura">Leitura</label>
						 			<?php echo form_dropdown("nivel_leitura_".$id_idioma, array('' => 'Selecione', 'N' => 'Nenhum',  'B' => 'Básico', 'I' => 'Intermediário', 'A' => 'Avançado', 'F' => 'Fluente'), set_value("nivel_leitura", (isset($idiomas_vagas[$id_idioma]) ? $idiomas_vagas[$id_idioma]->nivel_leitura : "")), "id=\"nivel_leitura\" "); ?>
					 			</div>
					 			<div class="input text">
									<label for="nivel_escrita">Escrita</label>
									<?php echo form_dropdown("nivel_escrita_".$id_idioma, array('' => 'Selecione', 'N' => 'Nenhum',  'B' => 'Básico', 'I' => 'Intermediário', 'A' => 'Avançado', 'F' => 'Fluente'), set_value("nivel_escrita", (isset($idiomas_vagas[$id_idioma]) ? $idiomas_vagas[$id_idioma]->nivel_escrita : "")), "id=\"nivel_escrita\" "); ?>
					 			</div>
					 			<div class="input text">
									<label for="nivel_conversacao">Conversação</label>
									<?php echo form_dropdown("nivel_conversacao_".$id_idioma, array('' => 'Selecione', 'N' => 'Nenhum',  'B' => 'Básico', 'I' => 'Intermediário', 'A' => 'Avançado', 'F' => 'Fluente'), set_value("nivel_conversacao", (isset($idiomas_vagas[$id_idioma]) ? $idiomas_vagas[$id_idioma]->nivel_conversacao : "")), "id=\"nivel_conversacao\" "); ?>
					 			</div>
				 			</div>

					</div>
				<?php endforeach; ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="pretensao_salarial_id">Faixa Salarial</label>
	 			<?php echo form_dropdown("pretensao_salarial_id", $pretensoes_salariais, set_value("pretensao_salarial_id", (isset($faixa_salarial) && $faixa_salarial ? $faixa_salarial : "")), "id=\"pretensao_salarial_id\" "); ?>
			</div>

			<div class="input text">
	 			<label for="exibir_faixa_salarial">Exibir faixa salarial?</label>
	 			<?php echo form_dropdown("exibir_faixa_salarial", array('S' => 'Sim', 'N' => 'Não'), set_value("exibir_faixa_salarial", (isset($registro) ? $registro->exibir_faixa_salarial : "")), "id=\"exibir_nome_empresa\" "); ?>
			</div>

			<div class="input text">
	 			<label for="beneficios">Benefícios</label>
	 			<textarea name="beneficios" id="beneficios"><?php echo (isset($registro) ? $registro->beneficios : ''); ?></textarea>
			</div>

			<div class="input text">
	 			<label for="regime_contratacao">Regime de Contratação</label>
	 			<?php echo form_dropdown("regime_contratacao", array('' => '--Selecione--') + $tipos_contrato, set_value("regime_contratacao", (isset($registro) ? $registro->regime_contratacao : "")), "id=\"regime_contratacao\" class=\"regime_contratacao\" "); ?>
			</div>

			<div class="input text">
	 			<label for="horario">Horário</label>
	 			<input name="horario" id="horario" type="text" value="<?php echo (isset($registro) ? $registro->horario : ''); ?>" />
			</div>

			<div class="input text">
	 			<label for="informacoes_adicionais">Informações Adicionais</label>
	 			<textarea name="informacoes_adicionais" id="informacoes_adicionais"><?php echo (isset($registro) ? $registro->informacoes_adicionais : ''); ?></textarea>
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "id=\"ativo\" "); ?>
			</div>

			<div class="input text">
	 			<label for="status">Status da Vaga</label>
	 			<?php echo form_dropdown("status", array('P' => 'Pendente', 'C' => 'Concluída'), set_value("status", (isset($registro) ? $registro->status : "")), "id=\"status\" "); ?>
			</div>

			<input name="id_vaga" id="id_vaga" type="hidden" value="<?php echo isset($registro) ? $registro->id_vaga : ''; ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>