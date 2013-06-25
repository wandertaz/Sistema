<h3 style="margin-bottom: 15px;">Auditoria Interna</h3>

<div class="formulario-orcamento-online">
    <form action="<? echo site_url('orcamento_online/salvar_orcamento/AI/'.$id_orcamento_online);?>" id="form_orcamento_online_ai" method="post">
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
			<label for="qtd_colaboradores_0" class="box-input"><input type="radio" name="qt_participantes" id="qtd_colaboradores_0" class="to-left" value="Ate 15">
			<span class="to-left">Até 15</span></label>

			<label for="qtd_colaboradores_1" class="box-input"><input type="radio" name="qt_participantes" id="qtd_colaboradores_1" class="to-left" value="16 a 50">
			<span class="to-left">16 a 50</span></label>

			<label for="qtd_colaboradores_2" class="box-input"><input type="radio" name="qt_participantes" id="qtd_colaboradores_2" class="to-left" value="51 a 150">
			<span class="to-left">51 a 150</span></label>

			<label for="qtd_colaboradores_3" class="box-input"><input type="radio" name="qt_participantes" id="qtd_colaboradores_3" class="to-left" value="151 a 500">
			<span class="to-left">151 a 500</span></label>

			<label for="qtd_colaboradores_4" class="box-input"><input type="radio" name="qt_participantes" id="qtd_colaboradores_4" class="to-left" value="Acima de 500">
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
		<h1 class="to-left">Qual sistema de Gestão será auditado?</h1>
		<div class="box-radio to-left">
			<label for="sistema_auditado_0" class="box-input"><input type="radio" name="sistema_auditado" id="sistema_auditado_0" class="to-left" value="ISO 9001(Gestão de Qualidade)">
			<span class="to-left">ISO 9001(Gestão de Qualidade)</span></label>

			<label for="sistema_auditado_1" class="box-input"><input type="radio" name="sistema_auditado" id="sistema_auditado_1" class="to-left" value="OHSAS 18001(Gestão Segurança e Saúde)">
			<span class="to-left">OHSAS 18001(Gestão Segurança e Saúde)</span></label>

			<label for="sistema_auditado_2" class="box-input"><input type="radio" name="sistema_auditado" id="sistema_auditado_2" class="to-left" value="SA 8000/NBR16001(Gestão de Resp. Social)<">
			<span class="to-left">SA 8000/NBR16001(Gestão de Resp. Social)</span></label>

			<label for="sistema_auditado_3" class="box-input"><input type="radio" name="sistema_auditado" id="sistema_auditado_3" class="to-left" value="PBQP-h(Programa Brasileiro Qualidade na Habitação)">
			<span class="to-left">PBQP-h(Programa Brasileiro Qualidade na Habitação)</span></label>
			
			<label for="sistema_auditado_4" class="box-input"><input type="radio" name="sistema_auditado" id="sistema_auditado_4" class="to-left" value="Outro">
			<span class="to-left">Outro</span></label>
		</div>
	</div>
</div>


<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Qual o organismo certificador (OCC) certificou seu Sistema de Gestão?</h1>
		<div class="box-radio to-left">
			<label for="qual_occ_certificou_0" class="box-input"><input type="radio" name="qual_occ_certificou" id="qual_occ_certificou_0" class="to-left" value="TÜV">
			<span class="to-left">TÜV</span></label>

			<label for="qual_occ_certificou_1" class="box-input"><input type="radio" name="qual_occ_certificou" id="qual_occ_certificou_1" class="to-left" value="BV">
			<span class="to-left">BV</span></label>

			<label for="qual_occ_certificou_2" class="box-input"><input type="radio" name="qual_occ_certificou" id="qual_occ_certificou_2" class="to-left" value="BSI">
			<span class="to-left">BSI</span></label>

			<label for="qual_occ_certificou_3" class="box-input"><input type="radio" name="qual_occ_certificou" id="qual_occ_certificou_3" class="to-left" value="FCAV">
			<span class="to-left">FCAV</span></label>
			
			<label for="qual_occ_certificou_4" class="box-input"><input type="radio" name="qual_occ_certificou" id="qual_occ_certificou_4" class="to-left" value="BRASCERT">
			<span class="to-left">BRASCERT</span></label>

			<label for="qual_occ_certificou_5" class="box-input"><input type="radio" name="qual_occ_certificou" id="qual_occ_certificou_5" class="to-left" value="Outro">
			<span class="to-left">Outro</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Quantas não-conformidades foram registradas na última auditoria?</h1>
		<div class="box-radio to-left">
			<label for="qts_nao_conformidades_0" class="box-input"><input type="radio" name="qts_nao_conformidades" id="qts_nao_conformidades_0" class="to-left" value="1 a 3">
			<span class="to-left">1 a 3</span></label>

			<label for="qts_nao_conformidades_1" class="box-input"><input type="radio" name="qts_nao_conformidades" id="qts_nao_conformidades_1" class="to-left" value="4 a 6">
			<span class="to-left">4 a 6</span></label>

			<label for="qts_nao_conformidades_2" class="box-input"><input type="radio" name="qts_nao_conformidades" id="qts_nao_conformidades_2" class="to-left" value="7 a 9">
			<span class="to-left">7 a 9</span></label>

			<label for="qts_nao_conformidades_3" class="box-input"><input type="radio" name="qts_nao_conformidades" id="qts_nao_conformidades_3" class="to-left" value="10 a 12">
			<span class="to-left">10 a 12</span></label>

			<label for="qts_nao_conformidades_4" class="box-input"><input type="radio" name="qts_nao_conformidades" id="qts_nao_conformidades_4" class="to-left" value="13 a 15">
			<span class="to-left">13 a 15</span></label>

			<label for="qts_nao_conformidades_5" class="box-input"><input type="radio" name="qts_nao_conformidades" id="qts_nao_conformidades_5" class="to-left" value="Acima de 15">
			<span class="to-left">Acima de 15</span></label>
		</div>
	</div>
</div>


<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Indique a quantidade de HDs (Homens/Dia) para realização da auditoria</h1>
		<div class="box-radio to-left">
			<label for="qtd_hds_0" class="box-input"><input type="radio" name="qtd_hds" id="qtd_hds_0" class="to-left" value="1 a 2">
			<span class="to-left">1 a 2</span></label>

			<label for="qtd_hds_1" class="box-input"><input type="radio" name="qtd_hds" id="qtd_hds_1" class="to-left" value="3 a 4">
			<span class="to-left">3 a 4</span></label>

			<label for="qtd_hds_2" class="box-input"><input type="radio" name="qtd_hds" id="qtd_hds_2" class="to-left" value="Acima de 4">
			<span class="to-left">Acima de 4</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Qual a quantidade de colaboradores diretamente envolvidos no processo que representa o escopo de certificação?</h1>
		<div class="box-radio to-left">
			<label for="qtd_colaboradores_envolvidos_0" class="box-input"><input type="radio" name="qt_colaboradores_envolvidos" id="qtd_colaboradores_envolvidos_0" class="to-left" value="0">
			<span class="to-left">1 a 49</span></label>

			<label for="qtd_colaboradores_envolvidos_1" class="box-input"><input type="radio" name="qt_colaboradores_envolvidos" id="qtd_colaboradores_envolvidos_1" class="to-left" value="1">
			<span class="to-left">55 a 99</span></label>

			<label for="qtd_colaboradores_envolvidos_2" class="box-input"><input type="radio" name="qt_colaboradores_envolvidos" id="qtd_colaboradores_envolvidos_2" class="to-left" value="2">
			<span class="to-left">100 a 200</span></label>

			<label for="qtd_colaboradores_envolvidos_3" class="box-input"><input type="radio" name="qt_colaboradores_envolvidos" id="qtd_colaboradores_envolvidos_3" class="to-left" value="3">
			<span class="to-left">Acima de 200</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Qual tipo de Auditoria deseja realizar?</h1>
		<div class="box-radio to-left">
			<label for="qual_auditoria_0" class="box-input"><input type="radio" name="form_orcamento_qual_auditoria" id="qual_auditoria_0" class="to-left" value="Adequação">
			<span class="to-left">Adequação</span></label>

			<label for="qual_auditoria_1" class="box-input"><input type="radio" name="form_orcamento_qual_auditoria" id="qual_auditoria_1" class="to-left" value="Conformidade">
			<span class="to-left">Conformidade</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Há quanto tempo a empresa está certificada neste Sistema de Gestão?</h1>
		<div class="box-radio to-left">
			<label for="qt_tempo_certificada_0" class="box-input"><input type="radio" name="qtd_tempo_certificada" id="qt_tempo_certificada_0" class="to-left" value="0">
			<span class="to-left">Menos de 1 Ano</span></label>

			<label for="qt_tempo_certificada_1" class="box-input"><input type="radio" name="qtd_tempo_certificada" id="qt_tempo_certificada_1" class="to-left" value="1">
			<span class="to-left">1 a 3 Anos</span></label>

			<label for="qt_tempo_certificada_2" class="box-input"><input type="radio" name="qtd_tempo_certificada" id="qt_tempo_certificada_2" class="to-left" value="2">
			<span class="to-left">Acima de 3 Anos</span></label>
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