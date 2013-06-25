<script type="text/javascript" src="<?php echo base_url(); ?>assets/multitools/js/bancodetalentos.js"></script>
<script type="text/javascript">

jQuery(function(){
	jQuery("#form").validate();

	jQuery(".mes_ano").mask("99/9999");
});

/**
 *
 * @access public
 * @return void
 **/
function atualizaCampos(campo, campoRelacional, div){

	if($(campo).val() == 'N'){
		$(campoRelacional).removeClass('required');
		$(campoRelacional).val('');
		$(div).hide();
	}
	else{
		$(campoRelacional).addClass('required');
		$(div).show();
	}
}
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

			<?php if(isset($inscrito_id)): ?>
		  		<div class="input text">
		 			<label>DADOS PESSOAIS</label>
				</div>

				<div class="input text">
		 			<label for="email">E-mail</label>
		 			<input name="email" id="email" type="text" value="<?php echo (isset($registro) ? $registro->email : ''); ?>" class="required" <?php if(isset($inscrito_id)): ?>readonly="readonly" <?php endif; ?> />
				</div>

				<div class="input text">
		 			<label for="cpf_cnpj">CPF</label>
		 			<input name="cpf_cnpj" id="cpf_cnpj" type="text" value="<?php echo (isset($registro) ? $registro->cpf_cnpj : ''); ?>" class="required" <?php if(isset($inscrito_id)): ?>readonly="readonly" <?php endif; ?> onkeypress="mascaraCpf(event, this);" maxlength="14" />
				</div>

				<div class="input text">
		 			<label for="nome">Nome Completo</label>
		 			<input name="nome" id="nome" type="text" value="<?php echo (isset($registro) ? $registro->nome : ''); ?>" class="required" />
				</div>

				<div class="input text">
		 			<label for="data_nascimento">Data de Nascimento</label>
		 			<input name="data_nascimento" id="data_nascimento" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_nascimento) : ''); ?>" class="required" onkeypress="mascaraData(event, this);" maxlength="10" />
				</div>

				<div class="input text">
		 			<label for="sexo">Sexo</label>
		 			<?php echo form_dropdown("sexo", array('F' => 'Feminino', 'M' => 'Masculino'), set_value("sexo", (isset($registro) ? $registro->sexo : "")), "id=\"sexo\" class=\"required\" "); ?>
				</div>

				<div class="input text">
		 			<label for="telefone">Telefone</label>
		 			<input name="telefone" maxlength="14" id="telefone" type="text" value="<?php echo (isset($registro) ? $registro->telefone : ''); ?>" class="required" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
				</div>

				<div class="input text">
		 			<label for="celular">Celular</label>
		 			<input name="celular" maxlength="14" id="celular" type="text" value="<?php echo (isset($registro) ? $registro->celular : ''); ?>" class="required" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
				</div>

				<div class="input text">
		 			<label for="estadocivil">Estado Civil</label>
		 			<?php echo form_dropdown("estadocivil", $estados_civis, set_value("estadocivil", (isset($registro) ? $registro->ativo : "")), "id=\"estadocivil\" "); ?>
				</div>

				<div class="input text">
		 			<label for="religiao">Religião</label>
		 			<input name="religiao" id="religiao" type="text" value="<?php echo (isset($registro) ? $registro->religiao : ''); ?>" class="required" />
				</div>

				<div class="input text">
		 			<label for="cep">CEP</label>
		 			<input name="cep" id="cep" type="text" value="<?php echo (isset($registro) ? $registro->cep : ''); ?>" class="required" onkeypress="mascaraCep(event, this);" maxlength="9"/>
				</div>

				<div class="input text">
		 			<label for="endereco">Endereço</label>
		 			<input name="endereco" id="endereco" type="text" value="<?php echo (isset($registro) ? $registro->endereco : ''); ?>" class="required" />
				</div>

				<div class="input text">
		 			<label for="numero">Número</label>
		 			<input name="numero" id="numero" type="text" value="<?php echo (isset($registro) ? $registro->numero : ''); ?>" class="required" />
				</div>

				<div class="input text">
		 			<label for="complemento">Complemento</label>
		 			<input name="complemento" id="complemento" type="text" value="<?php echo (isset($registro) ? $registro->complemento : ''); ?>" class="" />
				</div>

				<div class="input text">
		 			<label for="bairro">Bairro</label>
		 			<input name="bairro" id="bairro" type="text" value="<?php echo (isset($registro) ? $registro->bairro : ''); ?>" class="required" />
				</div>

				<div class="input text">
		 			<label for="cidade">Cidade</label>
		 			<input name="cidade" id="cidade" type="text" value="<?php echo (isset($registro) ? $registro->cidade : ''); ?>" class="required" />
				</div>

				<div class="input text">
		 			<label for="estado">UF</label>
		 			<input name="estado" maxlength="2" id="estado" type="text" value="<?php echo (isset($registro) ? $registro->estado : ''); ?>" class="required" />
				</div>

				<div class="input text">
		 			<label for="filhos">Filhos?</label>
		 			<?php echo form_dropdown("filhos", array('N' => 'Não', 'S' => 'Sim'), set_value("filhos", (isset($registro) ? $registro->filhos : "")), "id=\"filhos\" onchange=\"atualizaCampos('#filhos', '#qtd_filhos', '#divFilhos');\" "); ?>
				</div>

				<div class="input text" id="divFilhos">
		 			<label for="qtd_filhos">Quantos filhos?</label>
		 			<input name="qtd_filhos" id="qtd_filhos" type="text" value="<?php echo (isset($registro) ? $registro->qtd_filhos : ''); ?>" <?php if(isset($registro) && $registro->filhos == 'S'): ?> class="required" <?php endif; ?> />
				</div>

				<div class="input text">
		 			<label for="cnh">Possui CNH?</label>
		 			<?php echo form_dropdown("cnh", array('N' => 'Não', 'S' => 'Sim'), set_value("cnh", (isset($registro) ? $registro->cnh : "")), "id=\"cnh\" "); ?>
				</div>

				<div class="input text">
		 			<label for="veiculo">Possui Veículo?</label>
		 			<?php echo form_dropdown("veiculo", array('N' => 'Não', 'S' => 'Sim'), set_value("veiculo", (isset($registro) ? $registro->veiculo : "")), "id=\"veiculo\" "); ?>
				</div>

				<div class="input text">
		 			<label for="deficiencia">É portador de necessidades especiais?</label>
		 			<?php echo form_dropdown("deficiencia", array('N' => 'Não', 'S' => 'Sim'), set_value("deficiencia", (isset($registro) ? $registro->deficiencia : "")), "id=\"deficiencia\" onchange=\"atualizaCampos('#deficiencia', '#qual_deficiencia', '#divNecessidade');\""); ?>
				</div>

				<div class="input text" id="divNecessidade">
		 			<label for="qual_deficiencia">Qual necessidade?</label>
		 			<input name="qual_deficiencia" id="qual_deficiencia" type="text" value="<?php echo (isset($registro) ? $registro->qual_deficiencia : ''); ?>" <?php if(isset($registro) && $registro->deficiencia == 'S'): ?> class="required" <?php endif; ?>/>
				</div>

				<div class="input text">
		 			<label for="link_facebook">Facebook</label>
		 			<input name="link_facebook" id="link_facebook" type="text" value="<?php echo (isset($registro) ? $registro->link_facebook : ''); ?>" />
				</div>

				<div class="input text">
		 			<label for="link_twitter">Twitter</label>
		 			<input name="link_twitter" id="link_twitter" type="text" value="<?php echo (isset($registro) ? $registro->link_twitter : ''); ?>" />
				</div>

				<div class="input text">
		 			<label for="link_linkedin">Linkedin</label>
		 			<input name="link_linkedin" id="link_linkedin" type="text" value="<?php echo (isset($registro) ? $registro->link_linkedin : ''); ?>" />
				</div>

				<input name="id_curriculo" id="id_curriculo" type="hidden" value="<?php echo isset($curriculo_id) ? $curriculo_id : ''; ?>" class="" />
				<input name="inscritos_id" id="inscritos_id" type="hidden" value="<?php echo isset($inscrito_id) ? $inscrito_id : ''; ?>" class="" />

			<?php else: ?>
				<div class="input text">
		 			<label for="inscritos_id">Inscrito</label>
		 			<?php echo form_dropdown("inscritos_id", $inscritos, set_value("inscritos_id", (isset($registro) ? $registro->inscritos_id : "")), "id=\"inscritos_id\" "); ?>
				</div>
			<?php endif; ?>

			<div class="input text">
	 			<label>FORMAÇÃO ACADÊMICA</label>
			</div>

			<?php foreach($formacao_academica as $formacao): ?>
				<div class="formacao_academica_origin origins set_formacao_academica_add" id="formacao_academica">
					<div class="input text">
			 			<label for="grau_formacao">Grau de Formação</label>
			 			<?php echo form_dropdown("grau_formacao[]", array('' => '--Selecione--') + $graus_formacao, set_value("grau_formacao", (!isset($formacao_academica['vazio']) ? $formacao->grau_formacao : "")), "id=\"grau_formacao\" class=\"grau_formacao required\" "); ?>
					</div>

					<div class="input text">
			 			<label for="status">Status do Curso</label>
			 			<?php echo form_dropdown("status[]", array('' => '--Selecione--') + $status_formacao, set_value("status", (!isset($formacao_academica['vazio']) ? $formacao->status : "")), "id=\"status\" class=\"status required\""); ?>
					</div>

					<div class="input text">
			 			<label for="nome_curso">Nome do Curso</label>
			 			<input name="nome_curso[]" id="nome_curso" class="nome_curso required" type="text" value="<?php echo (!isset($formacao_academica['vazio']) ? $formacao->nome_curso : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="instituicao">Instituição</label>
			 			<input name="instituicao[]" id="instituicao" class="instituicao required" type="text" value="<?php echo (!isset($formacao_academica['vazio']) ? $formacao->instituicao : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="data_inicio">Data de Início (mês/ano)</label>
			 			<input name="data_inicio[]" id="data_inicio" class="data_inicio required mes_ano" type="text" value="<?php echo (!isset($formacao_academica['vazio']) ? ($formacao->data_inicio) : ''); ?>" maxlength="10"/>
					</div>

					<div class="input text">
			 			<label for="data_conclusao">Data de Conclusão (mês/ano)</label>
			 			<input name="data_conclusao[]" id="data_conclusao" class="data_conclusao required mes_ano" type="text" value="<?php echo (!isset($formacao_academica['vazio']) ? ($formacao->data_conclusao) : ''); ?>" maxlength="10"/>
					</div>

					<div class="input text"><hr /></div>
				</div>
			<?php endforeach; ?>

			<div class="input text">
	        	<a id="btn_add_formacao_academica" class="btn_add_modulo" href="">+ Incluir outra formação</a>
			</div>

			<div class="input text obrigatorio">
	 			<label for="trabalhar_outra_cidade">IDIOMAS</label>
			</div>

			<div class="input text obrigatorio">
	 			<label for="idiomas">Idiomas</label>

	 			<?php foreach($idiomas as $id_idioma => $idioma): ?>
	 				<div class="input text">
						<input style="width: 12px;" type="checkbox" name="idiomas[]" id="idiomas" value="<?php echo $id_idioma ?>" <?php if(isset($ids_idiomas_vagas) && in_array($id_idioma, $ids_idiomas_vagas)): ?> checked="checked" <?php endif; ?> onclick="$('#niveis_<?php echo $id_idioma; ?>').toggle(); "> <p style="float:left; padding: 0 5px;"><?php echo $idioma; ?></p>

	 						<div id="niveis_<?php echo $id_idioma; ?>" <?php if(!isset($idiomas_vagas[$id_idioma])): ?> style="display:none;" <?php endif; ?> >
								<div class="input text">
						 			<label for="nivel_leitura">Leitura</label>
						 			<?php echo form_dropdown("nivel_leitura_".$id_idioma, array('' => 'Selecione', 'N' => 'Nenhum', 'B' => 'Básico', 'I' => 'Intermediário', 'A' => 'Avançado', 'F' => 'Fluente'), set_value("nivel_leitura", (isset($idiomas_vagas[$id_idioma]) ? $idiomas_vagas[$id_idioma]->nivel_leitura : "")), "id=\"nivel_leitura\" "); ?>
					 			</div>
					 			<div class="input text">
									<label for="nivel_escrita">Escrita</label>
									<?php echo form_dropdown("nivel_escrita_".$id_idioma, array('' => 'Selecione',  'N' => 'Nenhum', 'B' => 'Básico', 'I' => 'Intermediário', 'A' => 'Avançado', 'F' => 'Fluente'), set_value("nivel_escrita", (isset($idiomas_vagas[$id_idioma]) ? $idiomas_vagas[$id_idioma]->nivel_escrita : "")), "id=\"nivel_escrita\" "); ?>
					 			</div>
					 			<div class="input text">
									<label for="nivel_conversacao">Conversação</label>
									<?php echo form_dropdown("nivel_conversacao_".$id_idioma, array('' => 'Selecione',  'N' => 'Nenhum', 'B' => 'Básico', 'I' => 'Intermediário', 'A' => 'Avançado', 'F' => 'Fluente'), set_value("nivel_conversacao", (isset($idiomas_vagas[$id_idioma]) ? $idiomas_vagas[$id_idioma]->nivel_conversacao : "")), "id=\"nivel_conversacao\" "); ?>
					 			</div>
				 			</div>

					</div>
				<?php endforeach; ?>
			</div>

			<div class="input text">
	 			<label>CURSOS COMPLEMENTARES</label>
			</div>

			<?php foreach($cursos_complementares as $curso): ?>
				<div id="formacao_academica_origin_complementar" class="origins formacao_academica_origin_complementar">
					<div class="input text">
			 			<label for="nome_curso">Nome do Curso</label>
			 			<input name="nome_curso_complementar[]" class="nome_curso_complementar" id="nome_curso" type="text" value="<?php echo (!isset($cursos_complementares['vazio']) ? $curso->nome_curso : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="carga_horaria">Carga Horária</label>
			 			<input name="carga_horaria[]" id="carga_horaria" class="carga_horaria" type="text" value="<?php echo (!isset($cursos_complementares['vazio']) ? $curso->carga_horaria : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="cidade_pais">Cidade/País</label>
			 			<input name="cidade_pais[]" id="cidade_pais" class="cidade_pais" type="text" value="<?php echo (!isset($cursos_complementares['vazio']) ? $curso->cidade_pais : ''); ?>"/>
					</div>

					<div class="input text">
			 			<label for="instituicao">Instituição</label>
			 			<input name="instituicao_complementar[]" class="instituicao_complementar" id="instituicao" type="text" value="<?php echo (!isset($cursos_complementares['vazio']) ? $curso->instituicao : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="data_inicio">Data de Início (mês/ano)</label>
			 			<input name="data_inicio_complementar[]" class="data_inicio_complementar mes_ano" id="data_inicio" type="text" value="<?php echo (!isset($cursos_complementares['vazio']) ? ($curso->data_inicio) : ''); ?>" class="datepicker" maxlength="10" onkeypress="mascaraData(event, this);" />
					</div>

					<div class="input text">
			 			<label for="data_fim">Data de Conclusão (mês/ano)</label>
			 			<input name="data_fim[]" id="data_fim" class="data_fim mes_ano" type="text" value="<?php echo (!isset($cursos_complementares['vazio']) ? ($curso->data_fim) : ''); ?>" class="datepicker" onkeypress="mascaraData(event, this);" maxlength="10"/>
					</div>

					<div class="input text">
					<hr />
					</div>
				</div>

			<?php endforeach; ?>
			<div class="input text">
	        	<a id="btn_add_formacao_academica_complementar" class="btn_add_modulo" href="">+ Incluir outro Curso Complementar</a>
			</div>

			<div class="input text">
	 			<label>HISTÓRICO PROFISSIONAL</label>
			</div>

			<?php $x = 0; ?>
			<?php foreach($historico_profissional as $historico): ?>
				<?php $x++; ?>
				<div id="historico_profissional" class="historico_profissional holder_cadastro_curriculo container_page_cadastro_curriculo">

					<div class="input text">
			 			<label for="empresa">Empresa</label>
			 			<input name="empresa_<?php echo $x;?>" class="empresa" id="empresa" type="text" value="<?php echo (!isset($historico_profissional['vazio']) ? $historico->empresa : ''); ?>" />
					</div>

					<?php if(isset($historico->cargos)): ?>
						<?php foreach($historico->cargos as $cargo): ?>
							<div id="cargo_origin" class="cargo_origin">
								<div class="input text">
						 			<label for="cargo">Cargo</label>
						 			<input name="cargo_<?php echo $x;?>[]" id="cargo" class="cargo_profissao" type="text" value="<?php echo (!isset($historico_profissional['vazio']) ? $cargo->cargo : ''); ?>" />
								</div>
							</div>
						<?php endforeach; ?>
					<?php else: ?>
						<div id="cargo_origin" class="cargo_origin">
							<div class="input text">
					 			<label for="cargo">Cargo</label>
					 			<input name="cargo_<?php echo $x;?>[]" id="cargo" class="cargo_profissao" type="text" value="" />
							</div>
						</div>
					<?php endif; ?>

					<div class="input text">
						<div class="add_fields"></div>
		        		<a id="btn_add_cargo" class="btn_add_cargo btn_add_modulo add_campo" href="">+ Incluir outro Cargo</a>
					</div>

					<div class="input text">
			 			<label for="data_inicial">Entrada</label>
			 			<input name="data_inicial_<?php echo $x;?>" class="data_inicial" id="data_inicial" type="text" value="<?php echo (!isset($historico_profissional['vazio']) ? br_date($historico->data_inicial) : ''); ?>" class="datepicker" onkeypress="mascaraData(event, this);" maxlength="10"/>
					</div>

					<div class="input text">
			 			<label for="data_saida">Saída</label>
			 			<input name="data_saida_<?php echo $x;?>" class="data_saida" id="data_saida" type="text" value="<?php echo (!isset($historico_profissional['vazio']) ? br_date($historico->data_saida) : ''); ?>" class="datepicker" onkeypress="mascaraData(event, this);" maxlength="10"/>
					</div>

					<div class="input text">
			 			<label for="motivo_desligamento">Motivo de Desligamento</label>
			 			<input name="motivo_desligamento_<?php echo $x;?>" class="motivo_desligamento" id="motivo_desligamento" type="text" value="<?php echo (!isset($historico_profissional['vazio']) ? $historico->motivo_desligamento : ''); ?>"/>
					</div>

					<div class="input text">
			 			<label for="salario">Salário</label>
			 			<input name="salario_<?php echo $x;?>" class="salario" id="salario" type="text" value="<?php echo (!isset($historico_profissional['vazio']) ? $historico->salario : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="beneficios">Benefícios</label>
			 			<input name="beneficios_<?php echo $x;?>" class="beneficios" id="beneficios" type="text" value="<?php echo (!isset($historico_profissional['vazio']) ? $historico->beneficios : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="superior_imediato">Superior Imediato</label>
			 			<input name="superior_imediato_<?php echo $x;?>" class="superior_imediato" id="superior_imediato" type="text" value="<?php echo (!isset($historico_profissional['vazio']) ? $historico->superior_imediato : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="cargo_superior_imediato">Cargo do Superior Imediato</label>
			 			<input name="cargo_superior_imediato_<?php echo $x;?>" class="cargo_superior_imediato" id="cargo_superior_imediato" type="text" value="<?php echo (!isset($historico_profissional['vazio']) ? $historico->cargo_superior_imediato : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="principais_atribuicoes">Principais Atribuições</label>
			 			<input name="principais_atribuicoes_<?php echo $x;?>" class="principais_atribuicoes" id="principais_atribuicoes" type="text" value="<?php echo (!isset($historico_profissional['vazio']) ? $historico->principais_atribuicoes : ''); ?>" />
						<input type="hidden" name="historico_x" id="historico_x" class="historico_x" value="<?php echo $x; ?>" >
					</div>


					<div class="input text">
					<hr />
					</div>
				</div>
			<?php endforeach; ?>
			<div class="input text">
				 <div class="add_sets"></div>
	        	<a id="btn_add_historico_profissional" class="btn_add_historico_profissional btn_add_modulo add_set" href="">+ Incluir outra experiência</a>
				<input type="hidden" name="num_itens_historico" id="num_itens_historico" value="<?php echo $x;?>">
			</div>

			<div class="input text obrigatorio">
	 			<label for="trabalhar_outra_cidade">Possui disponibilidade para trabalhar em outra cidade?</label>
	 			<?php echo form_dropdown("trabalhar_outra_cidade", array('N' => 'Não', 'S' => 'Sim'), set_value("trabalhar_outra_cidade", (isset($registro) ? $registro->trabalhar_outra_cidade : "")), "id=\"trabalhar_outra_cidade\" class=\"required\" "); ?>
			</div>

			<div class="input text">
	 			<label>REFERÊNCIAS PROFISSIONAIS</label>
			</div>

			<?php foreach($referencias_profissionais as $referencia): ?>
				<div id="referencia_profissional_origin_origin" class="origins referencia_profissional_origin_origin">
					<div class="input text">
			 			<label for="empresa">Empresa</label>
			 			<input name="empresa_referencia[]" class="empresa_referencia" id="empresa_referencia" type="text" value="<?php echo (!isset($referencias_profissionais['vazio']) ? $referencia->empresa : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="nome_superior_imediato">Superior Imediato</label>
			 			<input name="nome_superior_imediato[]" class="nome_superior_imediato" id="nome_superior_imediato" type="text" value="<?php echo (!isset($referencias_profissionais['vazio']) ? $referencia->nome_superior_imediato : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="cargo">Cargo</label>
			 			<input name="cargo_referencia[]" class="cargo_referencia" id="cargo_referencia" type="text" value="<?php echo (!isset($referencias_profissionais['vazio']) ? $referencia->cargo : ''); ?>" />
					</div>

					<div class="input text">
			 			<label for="telefone_comercial">Telefone</label>
			 			<input name="telefone_comercial[]" class="telefone_comercial" id="telefone_comercial" type="text" value="<?php echo (!isset($referencias_profissionais['vazio']) ? $referencia->telefone_comercial : ''); ?>" onkeypress="mascaraTelefone(event, this);" maxlength="13"/>
					</div>

					<div class="input text">
			 			<label for="email">E-mail</label>
			 			<input name="email_referencia[]" class="email_referencia" id="email_referencia" type="text" value="<?php echo (!isset($referencias_profissionais['vazio']) ? $referencia->email : ''); ?>" />
					</div>

					<div class="input text">
					<hr />
					</div>
				</div>
			<?php endforeach; ?>

			<div class="input text">
	        	<a id="btn_add_referencia_profissional" class="btn_add_modulo" href="">+ Incluir outra referência</a>
			</div>

			<div class="input text">
	 			<label>OBJETIVOS PROFISSIONAIS</label>
			</div>

			<div class="input text obrigatorio">
	 			<label for="objetivosprofissionais">Objetivos</label>
	 			<textarea name="objetivosprofissionais" id="objetivosprofissionais" class="required"><?php echo (isset($registro) ? $registro->objetivosprofissionais : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="niveis_de_atuacao_id_nivel">Níveis de Atuação</label>
	 			<?php echo form_dropdown("niveis_de_atuacao_id_nivel", $niveis_atuacao, set_value("niveis_de_atuacao_id_nivel", (isset($registro) ? $registro->niveis_de_atuacao_id_nivel : "")), "id=\"niveis_de_atuacao_id_nivel\" class=\"required\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="niveis_de_atuacao_id_nivel">Áreas de Atuação</label>
	 			<?php foreach($areas_atuacao as $id_area => $area_atuacao): ?>
	 				<div class="input text">
					<input style="width: 12px;" type="checkbox" class="required" name="areas_atuacao[]" id="areas_atuacao" value="<?php echo $id_area ?>" <?php if(isset($areas_atuacao_cadastradas) && in_array($id_area, $areas_atuacao_cadastradas)): ?> checked="checked" <?php endif; ?>> <p style="float:left; padding: 0 5px;"><?php echo $area_atuacao; ?></p>
	 				</div>
				<?php endforeach; ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="segmento_atuacao_id">Segmento de Atuação</label>
	 			<?php echo form_dropdown("segmento_atuacao_id", array('' => '--Selecione--') + $segmentos_atuacao, set_value("segmento_atuacao_id", (isset($segmento_atuacao_cadastrado) && $segmento_atuacao_cadastrado ? $segmento_atuacao_cadastrado : "")), "id=\"segmento_atuacao_id\" class=\"required\""); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="disponibilidade_horario_id">Disponibilidade de Horário</label>
	 			<?php echo form_dropdown("disponibilidade_horario_id", array('' => '--Selecione--') + $disponibilidades_horario, set_value("disponibilidade_horario_id", (isset($disponibilidade_cadastrada) && $disponibilidade_cadastrada ? $disponibilidade_cadastrada : "")), "id=\"disponibilidade_horario_id\" class=\"required\""); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="pretensao_salarial_id">Pretensão Salarial</label>
	 			<?php echo form_dropdown("pretensao_salarial_id", array('' => '--Selecione--') + $pretensoes_salariais, set_value("pretensao_salarial_id", (isset($pretensao_salarial_cadastrada) && $pretensao_salarial_cadastrada ? $pretensao_salarial_cadastrada : "")), "id=\"pretensao_salarial_id\" class=\"required\""); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="perfil_acessivel">Perfil Acessível?</label>
	 			<?php echo form_dropdown("perfil_acessivel", array('S' => 'Sim', 'N' => 'Não'), set_value("perfil_acessivel", (isset($registro) ? $registro->perfil_acessivel : "")), "id=\"perfil_acessivel\" "); ?>
			</div>

			<div class="input text obrigatorio">
	 			<label for="descricao_sigilosa">Descrição Sigilosa do Currículo</label>
	 			<textarea name="descricao_sigilosa" id="descricao_sigilosa"><?php echo (isset($registro) ? $registro->descricao_sigilosa : ''); ?></textarea>
			</div>

			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

		<?php if(isset($registro)): ?>
			<fieldset>

				<div class="input text">
					<h3>Resultados dos processos deste currículo</h3>
				</div>

				<div class="input text">
					<?php if(isset($processos) && $processos): ?>
						<?php foreach($processos as $processo): ?>
							<p><?php echo $processo->titulo; ?>: <a href="<?php echo base_url(); ?>assets/uploads/<?php echo $processo->arquivo_resultado; ?>" target="_blank">Ver Resultado</a></p>
						<?php endforeach; ?>
					<?php else: ?>
						<p>Nenhum resultado foi encontrado para este currículo.</p>
					<?php endif; ?>
				</div>
			</fieldset>
		<?php endif; ?>

	<?php echo form_close();?>

</div>