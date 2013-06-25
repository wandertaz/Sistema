<h3 style="margin-bottom: 15px;">Sistema de Gestão da Responsabilidade Social</h3>

<div class="formulario-orcamento-online">
<form action="<? echo site_url('orcamento_online/salvar_orcamento/GS/'.$id_orcamento_online);?>" id="form_orcamento_online_gs" method="post">
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
		<h1 class="to-left">Utiliza algum programa de integração ao mercado de trabalho?</h1>
		<div class="box-radio to-left">
			<label for="program_integracao_ao_mtrabalho_0" class="box-input"><input type="radio" name="program_integracao_ao_mtrabalho" id="program_integracao_ao_mtrabalho_0" class="to-left" value="Não">
			<span class="to-left">Não</span></label>

			<label for="program_integracao_ao_mtrabalho_1" class="box-input"><input type="radio" name="program_integracao_ao_mtrabalho" id="program_integracao_ao_mtrabalho_1" class="to-left" value="Estágio">
			<span class="to-left">Estágio</span></label>

			<label for="program_integracao_ao_mtrabalho_2" class="box-input"><input type="radio" name="program_integracao_ao_mtrabalho" id="program_integracao_ao_mtrabalho_2" class="to-left" value="Menor aprendiz">
			<span class="to-left">Menor aprendiz</span></label>

			<label for="program_integracao_ao_mtrabalho_3" class="box-input"><input type="radio" name="program_integracao_ao_mtrabalho" id="program_integracao_ao_mtrabalho_3" class="to-left" value="Jovem trabalhador">
			<span class="to-left">Jovem trabalhador</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Qual o regime de remuneração dos trabalhadores?</h1>
		<div class="box-radio to-left">
			<label for="regime_remu_0" class="box-input"><input type="radio" name="regime_remuneracao" id="regime_remu_0" class="to-left" value="CLT">
			<span class="to-left">CLT</span></label>

			<label for="regime_remu_1" class="box-input"><input type="radio" name="regime_remuneracao" id="regime_remu_1" class="to-left" value="Comissão">
			<span class="to-left">Comissão</span></label>

			<label for="regime_remu_2" class="box-input"><input type="radio" name="regime_remuneracao" id="regime_remu_2" class="to-left" value="Programa de Remuneração Variável">
			<span class="to-left">Programa de Remuneração Variável</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Existem colaboradores que trabalham em domicílio?</h1>
		<div class="box-radio to-left">
			<label for="trabalho_homeoffice_0" class="box-input"><input type="radio" name="trabalho_homeoffice" id="trabalho_homeoffice_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="trabalho_homeoffice_1" class="box-input"><input type="radio" name="trabalho_homeoffice" id="trabalho_homeoffice_1" class="to-left" value="Não">
			<span class="to-left">Não</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Possui Código de Conduta ou Ética implantado na empresa?</h1>
		<div class="box-radio to-left">
			<label for="cod_conduta_0" class="box-input"><input type="radio" name="cod_conduta" id="cod_conduta_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="cod_conduta_1" class="box-input"><input type="radio" name="cod_conduta" id="cod_conduta_1" class="to-left" value="Não">
			<span class="to-left">Não</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Possui Sistema de Gestão Ambiental (ISO 14001) já implantado?</h1>
		<div class="box-radio to-left">
			<label for="iso14001_0" class="box-input"><input type="radio" name="form_orcamento_iso14001" id="iso14001_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="iso14001_1" class="box-input"><input type="radio" name="form_orcamento_iso14001" id="iso14001_1" class="to-left" value="Nao">
			<span class="to-left">Não</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Possui Sistema de Gestão da Qualidade (ISO 9001) já implantado?</h1>
		<div class="box-radio to-left">
			<label for="iso9001_0" class="box-input"><input type="radio" name="form_orcamento_iso9001" id="iso9001_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="iso9001_1" class="box-input"><input type="radio" name="form_orcamento_iso9001" id="iso9001_1" class="to-left" value="Nao">
			<span class="to-left">Não</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Possui Sistema de Gestão de Saúde e Segurança (OHSAS 18001) já implantado?</h1>
		<div class="box-radio to-left">
			<label for="ohsas18001_0" class="box-input"><input type="radio" name="form_orcamento_ohsas18001" id="ohsas18001_0" class="to-left" value="Sim">
			<span class="to-left">Sim</span></label>

			<label for="ohsas18001_1" class="box-input"><input type="radio" name="form_orcamento_ohsas18001" id="ohsas18001_1" class="to-left" value="Nao">
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