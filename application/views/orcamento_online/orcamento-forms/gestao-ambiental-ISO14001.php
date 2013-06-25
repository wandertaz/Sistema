<h3 style="margin-bottom: 15px;">Sistema de Gestão Ambiental - ISO4001</h3>

<div class="formulario-orcamento-online">
<form action="<? echo site_url('orcamento_online/salvar_orcamento/GA/'.$id_orcamento_online);?>" id="form_orcamento_online_ga" method="post">
<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Segmento da Empresa</h1>
		<div class="box-radio to-left">
			<label for="segmento_empresa_0" class="box-input"><input type="radio" name="segmento_empresa" id="segmento_empresa_0" class="to-left" value="Indústria">
			<span class="to-left">Indústria</span></label>

			<label for="segmento_empresa_1" class="box-input"><input type="radio" name="segmento_empresa" id="segmento_empresa_1" class="to-left" value="Comércio">
			<span class="to-left">Comércio</span></label>

			<label for="segmento_empresa_2" class="box-input"><input type="radio" name="segmento_empresa" id="segmento_empresa_2" class="to-left" value="Serviço">
			<span class="to-left">Serviço</span></label>

			<label for="segmento_empresa_3" class="box-input"><input type="radio" name="segmento_empresa" id="segmento_empresa_3" class="to-left" value="Gestão Pública">
			<span class="to-left">Gestão Pública</span></label>

			<label for="segmento_empresa_4" class="box-input"><input type="radio" name="segmento_empresa" id="segmento_empresa_4" class="to-left" value="Terceiro Setor">
			<span class="to-left">Terceiro Setor</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Quantidade de Colaboradores</h1>
		<div class="box-radio to-left">
			<label for="qtd_colaboradores_0" class="box-input"><input type="radio" name="qt_participantes" id="qtd_colaboradores_0" class="to-left" value="0">
			<span class="to-left">Até 15</span></label>

			<label for="qtd_colaboradores_1" class="box-input"><input type="radio" name="qt_participantes" id="qtd_colaboradores_1" class="to-left" value="1">
			<span class="to-left">16 a 50</span></label>

			<label for="qtd_colaboradores_2" class="box-input"><input type="radio" name="qt_participantes" id="qtd_colaboradores_2" class="to-left" value="2">
			<span class="to-left">51 a 150</span></label>

			<label for="qtd_colaboradores_3" class="box-input"><input type="radio" name="qt_participantes" id="qtd_colaboradores_3" class="to-left" value="3">
			<span class="to-left">151 a 500</span></label>

			<label for="qtd_colaboradores_4" class="box-input"><input type="radio" name="qt_participantes" id="qtd_colaboradores_4" class="to-left" value="4">
			<span class="to-left">Acima de 500</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-full-col left-col to-left">
		<h1 class="to-left">Descreva os produtos e serviços de sua empresa:</h1>
		<div class="box-textarea to-left">
			<textarea name="desc_produtos_servicos" id=""></textarea>										
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Possui algum tipo de Certificação?</h1>
		<div class="box-radio to-left">
			<label for="possui_alguma_certificacao_0" class="box-input"><input type="radio" name="possui_alguma_certificacao" id="possui_alguma_certificacao_0" class="to-left" value="Não">
			<span class="to-left">Não</span></label>

			<label for="possui_alguma_certificacao_1" class="box-input"><input type="radio" name="possui_alguma_certificacao" id="possui_alguma_certificacao_1" class="to-left" value="Produto">
			<span class="to-left">Produto</span></label>

			<label for="possui_alguma_certificacao_2" class="box-input"><input type="radio" name="possui_alguma_certificacao" id="possui_alguma_certificacao_2" class="to-left" value="INMETRO">
			<span class="to-left">INMETRO</span></label>

			<label for="possui_alguma_certificacao_3" class="box-input"><input type="radio" name="possui_alguma_certificacao" id="possui_alguma_certificacao_3" class="to-left" value="UCE">
			<span class="to-left">UCE</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Possui Sala de Treinamento e/ou Reuniões com recursos audiovisuais?</h1>
		<div class="box-radio to-left">
			<label for="possui_sala_0" class="box-input"><input type="radio" name="possui_sala" id="possui_sala_0" class="to-left" value="Não">
			<span class="to-left">Não</span></label>

			<label for="possui_sala_1" class="box-input"><input type="radio" name="possui_sala" id="possui_sala_1" class="to-left" value="Sala com mobília (mesa/ cadeiras)">
			<span class="to-left">Sala com mobília (mesa/ cadeiras)</span></label>

			<label for="possui_sala_2" class="box-input"><input type="radio" name="possui_sala" id="possui_sala_2" class="to-left" value="Sala com mobília e audiovisual">
			<span class="to-left">Sala com mobília e audiovisual</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Quantas unidades (Matriz e Filiais) deverão ser certificadas?</h1>
		<div class="box-radio to-left">
			<label for="qtd_unidades_certificadas_0" class="box-input"><input type="radio" name="qtd_unidades_certificadas" id="qtd_unidades_certificadas_0" class="to-left" value="1">
			<span class="to-left">1</span></label>

			<label for="qtd_unidades_certificadas_1" class="box-input"><input type="radio" name="qtd_unidades_certificadas" id="qtd_unidades_certificadas_1" class="to-left" value="2">
			<span class="to-left">2</span></label>

			<label for="qtd_unidades_certificadas_2" class="box-input"><input type="radio" name="qtd_unidades_certificadas" id="qtd_unidades_certificadas_2" class="to-left" value="3">
			<span class="to-left">3</span></label>

			<label for="qtd_unidades_certificadas_3" class="box-input"><input type="radio" name="qtd_unidades_certificadas" id="qtd_unidades_certificadas_3" class="to-left" value="4">
			<span class="to-left">4 ou mais</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Localização das Unidades</h1>
		<div class="box-radio to-left">
			<label for="local_unidades_0" class="box-input"><input type="radio" name="localizacao_unidade" id="local_unidades_0" class="to-left" value="Manaus">
			<span class="to-left">Manaus e Região Meteropolitana</span></label>

			<label for="local_unidades_1" class="box-input"><input type="radio" name="localizacao_unidade" id="local_unidades_1" class="to-left" value="norte">
			<span class="to-left">Capitais da Região Norte</span></label>

			<label for="local_unidades_2" class="box-input"><input type="radio" name="localizacao_unidade" id="local_unidades_2" class="to-left" value="Capitais">
			<span class="to-left">Capitais de outras Regiões</span></label>

			<label for="local_unidades_3" class="box-input"><input type="radio" name="localizacao_unidade" id="local_unidades_3" class="to-left" value="interior">
			<span class="to-left">Cidades do interior (todas as Regiões do Brasil)</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Possui departamento ou profissional da Qualidade na Empresa?</h1>
		<div class="box-radio to-left">
			<label for="possui_departamento_qualidade_0" class="box-input"><input type="radio" name="possui_departamento_qualidade" id="possui_departamento_qualidade_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="possui_departamento_qualidade_1" class="box-input"><input type="radio" name="possui_departamento_qualidade" id="possui_departamento_qualidade_1" class="to-left" value="Não">
			<span class="to-left">Não</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Qual a expectativa de prazo para a certificação?</h1>
		<div class="box-radio to-left">
			<label for="prazo_0" class="box-input"><input type="radio" name="expectativa_certificacao" id="prazo_0" class="to-left" value="0">
			<span class="to-left">6 a 8 meses</span></label>

			<label for="prazo_1" class="box-input"><input type="radio" name="expectativa_certificacao" id="prazo_1" class="to-left" value="1">
			<span class="to-left">8 a 10 meses</span></label>

			<label for="prazo_2" class="box-input"><input type="radio" name="expectativa_certificacao" id="prazo_2" class="to-left" value="2">
			<span class="to-left">10 a 12 meses</span></label>

			<label for="prazo_3" class="box-input"><input type="radio" name="expectativa_certificacao" id="prazo_3" class="to-left" value="3">
			<span class="to-left">12 a 14 meses</span></label>
			
			<label for="prazo_4" class="box-input"><input type="radio" name="expectativa_certificacao" id="prazo_4" class="to-left" value="4">
			<span class="to-left">Acima de 14 meses</span></label>
		</div>
	</div>
</div>


<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Quais os principais resíduos sólidos gerados?</h1>
		<div class="box-radio to-left">
			<label for="residuos_solidos_gerados_0" class="box-input"><input type="radio" name="residuos_solidos_gerados" id="residuos_solidos_gerados_0" class="to-left" value="Papel/ Papelão">
			<span class="to-left">Papel/ Papelão</span></label>

			<label for="residuos_solidos_gerados_1" class="box-input"><input type="radio" name="residuos_solidos_gerados" id="residuos_solidos_gerados_1" class="to-left" value="Plástico">
			<span class="to-left">Plástico</span></label>

			<label for="residuos_solidos_gerados_2" class="box-input"><input type="radio" name="residuos_solidos_gerados" id="residuos_solidos_gerados_2" class="to-left" value="Orgânico">
			<span class="to-left">Orgânico</span></label>

			<label for="residuos_solidos_gerados_3" class="box-input"><input type="radio" name="residuos_solidos_gerados" id="residuos_solidos_gerados_3" class="to-left" value="Metais">
			<span class="to-left">Metais</span></label>
			
			<label for="residuos_solidos_gerados_4" class="box-input"><input type="radio" name="residuos_solidos_gerados" id="residuos_solidos_gerados_4" class="to-left" value="Hospitalar">
			<span class="to-left">Hospitalar</span></label>
			
			<label for="residuos_solidos_gerados_5" class="box-input"><input type="radio" name="residuos_solidos_gerados" id="residuos_solidos_gerados_5" class="to-left" value="Trapos contaminados">
			<span class="to-left">Trapos contaminados</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Possui outros resíduos?</h1>
		<div class="box-radio to-left">
			<label for="outros_residuos_0" class="box-input"><input type="radio" name="outros_residuos" id="outros_residuos_0" class="to-left" value="Não">
			<span class="to-left">Não</span></label>

			<label for="outros_residuos_1" class="box-input"><input type="radio" name="outros_residuos" id="outros_residuos_1" class="to-left" value="Resíduos líquidos">
			<span class="to-left">Resíduos líquidos</span></label>

			<label for="outros_residuos_2" class="box-input"><input type="radio" name="outros_residuos" id="outros_residuos_2" class="to-left" value="Resíduos atmosféricos">
			<span class="to-left">Resíduos atmosféricos</span></label>
		</div>
	</div>
</div>


<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Realiza coleta seletiva?</h1>
		<div class="box-radio to-left">
			<label for="coleta_seletiva_0" class="box-input"><input type="radio" name="coleta_seletiva" id="coleta_seletiva_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="coleta_seletiva_1" class="box-input"><input type="radio" name="coleta_seletiva" id="coleta_seletiva_1" class="to-left" value="Não">
			<span class="to-left">Não</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Possui Estação de Tratamento de Efluentes?</h1>
		<div class="box-radio to-left">
			<label for="tratamento_efluentes_0" class="box-input"><input type="radio" name="tratamento_efluentes" id="tratamento_efluentes_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="tratamento_efluentes_1" class="box-input"><input type="radio" name="tratamento_efluentes" id="tratamento_efluentes_1" class="to-left" value="Não">
			<span class="to-left">Não</span></label>

			<label for="tratamento_efluentes_2" class="box-input"><input type="radio" name="tratamento_efluentes" id="tratamento_efluentes_2" class="to-left" value="Não há exigência">
			<span class="to-left">Não há exigência</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Atende toda a documentação legal (licenças e registros IPAAM, IBAMA, Vigilância, etc)?</h1>
		<div class="box-radio to-left">
			<label for="possui_doc_legal_0" class="box-input"><input type="radio" name="possui_doc_legal" id="possui_doc_legal_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="possui_doc_legal_1" class="box-input"><input type="radio" name="possui_doc_legal" id="possui_doc_legal_1" class="to-left" value="Não">
			<span class="to-left">Não</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Possui laudo de destinação para tratamento dos resíduos?</h1>
		<div class="box-radio to-left">
			<label for="destinacao_tratamento_residuos_0" class="box-input"><input type="radio" name="destinacao_tratamento_residuos" id="destinacao_tratamento_residuos_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="destinacao_tratamento_residuos_1" class="box-input"><input type="radio" name="destinacao_tratamento_residuos" id="destinacao_tratamento_residuos_1" class="to-left" value="Não">
			<span class="to-left">Não</span></label>

			<label for="destinacao_tratamento_residuos_2" class="box-input"><input type="radio" name="destinacao_tratamento_residuos" id="destinacao_tratamento_residuos_2" class="to-left" value="Não há tratamento dos resíduos">
			<span class="to-left">Não há tratamento dos resíduos</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Possuem alguma assessoria interna ou terceirizada para atendimento à legislação ambiental?</h1>
		<div class="box-radio to-left">
			<label for="assessoria_leg_ambiental_0" class="box-input"><input type="radio" name="possui_assessoria_leg_ambiental" id="assessoria_leg_ambiental_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="assessoria_leg_ambiental_1" class="box-input"><input type="radio" name="possui_assessoria_leg_ambiental" id="assessoria_leg_ambiental_1" class="to-left" value="Não">
			<span class="to-left">Não</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Possui Sistema de Gestão da Qualidade (ISO 9001) já implantado na empresa?</h1>
		<div class="box-radio to-left">
			<label for="iso9001_0" class="box-input"><input type="radio" name="form_orcamento_iso9001" id="iso9001_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="iso9001_1" class="box-input"><input type="radio" name="form_orcamento_iso9001" id="iso9001_1" class="to-left" value="Nao">
			<span class="to-left">Não</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="right-col to-right">
		<input type="submit" value="" class="input-submit-orcamento">
	</div>
</div>		
</form>
</div>