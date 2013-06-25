<h3 style="margin-bottom: 15px;">Treinamento</h3>

<div class="formulario-orcamento-online">
<form action="<? echo site_url('orcamento_online/salvar_orcamento/TR/'.$id_orcamento_online);?>" id="form_orcamento_online_tr" method="post">
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
		<h1 class="to-left">Tipo de Curso</h1>
		<div class="box-radio to-left">
			<label for="tipo_curso_0" class="box-input"><input type="radio" name="tipo_curso" id="tipo_curso_0" class="to-left" value="Palestra">
			<span class="to-left">Palestra</span></label>

			<label for="tipo_curso_1" class="box-input"><input type="radio" name="tipo_curso" id="tipo_curso_1" class="to-left" value="Workshop">
			<span class="to-left">Workshop</span></label>

			<label for="tipo_curso_2" class="box-input"><input type="radio" name="tipo_curso" id="tipo_curso_2" class="to-left" value="Curso">
			<span class="to-left">Curso</span></label>

			<label for="tipo_curso_3" class="box-input"><input type="radio" name="tipo_curso" id="tipo_curso_3" class="to-left" value="Seminário">
			<span class="to-left">Seminário</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-full-col left-col to-left">
		<h1 class="to-left">Nome do Curso:</h1>
		<div class="box-textarea to-left">
			<textarea name="nome_do_curso" id=""></textarea>										
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Área do Curso</h1>
		<div class="box-radio to-left">
                    <label for="area_curso_0" class="box-input"><input type="radio" name="area_curso" id="area_curso_0" class="to-left" value="Gestao">
			<span class="to-left">Gestão (Liderança, Marketing, Comunicação, Feedback, Finanças, etc)</span></label>

                    <label for="area_curso_1" class="box-input"><input type="radio" name="area_curso" id="area_curso_1" class="to-left" value="Tecnico">
			<span class="to-left">Técnico (Normas ISO, Auditorias, CEP, 5S, Lean Manufacturing, etc)</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Quantidade de Participantes</h1>
		<div class="box-radio to-left">
			<label for="qt_participantes_0" class="box-input"><input type="radio" name="qt_participantes" id="qt_participantes_0" class="to-left" value="0">
			<span class="to-left">Até 10 pessoas</span></label>

			<label for="qt_participantes_1" class="box-input"><input type="radio" name="qt_participantes" id="qt_participantes_1" class="to-left" value="1">
			<span class="to-left">11 a 20 pessoas</span></label>

			<label for="qt_participantes_2" class="box-input"><input type="radio" name="qt_participantes" id="qt_participantes_2" class="to-left" value="2">
			<span class="to-left">21 a 40 pessoas</span></label>

			<label for="qt_participantes_3" class="box-input"><input type="radio" name="qt_participantes" id="qt_participantes_3" class="to-left" value="3">
			<span class="to-left">41 a 60 pessoas</span></label>

			<label for="qt_participantes_3" class="box-input"><input type="radio" name="qt_participantes" id="qt_participantes_3" class="to-left" value="4">
			<span class="to-left">61 a 150 pessoas</span></label>

			<label for="qt_participantes_3" class="box-input"><input type="radio" name="qt_participantes" id="qt_participantes_3" class="to-left" value="5">
			<span class="to-left">151 a 300 pessoas</span></label>

			<label for="qt_participantes_3" class="box-input"><input type="radio" name="qt_participantes" id="qt_participantes_3" class="to-left" value="6">
			<span class="to-left">Acima de 300 pessoas</span></label>
		</div>
	</div>
</div>


<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Objetivo do Curso </h1>
		<div class="box-radio to-left">
			<label for="objetivo_curso_0" class="box-input"><input type="checkbox" name="objetivo_curso[]" id="objetivo_curso_0" class="to-left" value="CAPACITAÇÃO INICIAL">
			<span class="to-left"> CAPACITAÇÃO INICIAL (os participantes não conhecem ou não tem experiência no assunto)</span></label>

			<label for="objetivo_curso_1" class="box-input"><input type="checkbox" name="objetivo_curso[]" id="objetivo_curso_1" class="to-left" value="ATUALIZAÇÃO DO APRENDIZADO">
			<span class="to-left">ATUALIZAÇÃO DO APRENDIZADO (os participantes conhecem o assunto, mas precisam de um reforço ou atualização)</span></label>
	
			<label for="objetivo_curso_2" class="box-input"><input type="checkbox" name="objetivo_curso[]" id="objetivo_curso_2" class="to-left" value="MUDANÇA ORGANIZACIONAL">
			<span class="to-left">MUDANÇA ORGANIZACIONAL (a empresa deseja reforçar novas atitudes e comportamentos relacionados ao seu interesse)</span></label>
	
			<label for="objetivo_curso_3" class="box-input"><input type="checkbox" name="objetivo_curso[]" id="objetivo_curso_3" class="to-left" value="CUMPRIMENTO DE META E PLANO DE TREINAMENTO">
			<span class="to-left">CUMPRIMENTO DE META E PLANO DE TREINAMENTO (a empresa precisa cumprir o LNT_Levantamento de Necessidades de Treinamento ou orçamento do ano)</span></label>

			<label for="objetivo_curso_4" class="box-input"><input type="checkbox" name="objetivo_curso[]" id="objetivo_curso_4" class="to-left" value="Outro Objetivo">
			<span class="to-left">Outro Objetivo</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Carga Horária</h1>
		<div class="box-radio to-left">
			<label for="carga_horaria_0" class="box-input"><input type="radio" name="carga_horaria" id="carga_horaria_0" class="to-left" value="0">
			<span class="to-left">2 Horas</span></label>

			<label for="carga_horaria_1" class="box-input"><input type="radio" name="carga_horaria" id="carga_horaria_1" class="to-left" value="1">
			<span class="to-left">4 Horas</span></label>

			<label for="carga_horaria_2" class="box-input"><input type="radio" name="carga_horaria" id="carga_horaria_2" class="to-left" value="2">
			<span class="to-left">8 a 10 Horas</span></label>

			<label for="carga_horaria_3" class="box-input"><input type="radio" name="carga_horaria" id="carga_horaria_3" class="to-left" value="3">
			<span class="to-left">12 a 16 Horas</span></label>

			<label for="carga_horaria_4" class="box-input"><input type="radio" name="carga_horaria" id="carga_horaria_4" class="to-left" value="4">
			<span class="to-left">16 a 20 Horas</span></label>

			<label for="carga_horaria_5" class="box-input"><input type="radio" name="carga_horaria" id="carga_horaria_5" class="to-left" value="5">
			<span class="to-left">Acima de 20 Horas</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Público Alvo</h1>
		<div class="box-radio to-left">
			<label for="publico_alvo_0" class="box-input"><input type="checkbox" name="publico_alvo[]" id="publico_alvo_0" class="to-left" value="Diretoria">
			<span class="to-left">Diretoria</span></label>

			<label for="publico_alvo_1" class="box-input"><input type="checkbox" name="publico_alvo[]" id="publico_alvo_1" class="to-left" value="Gerência">
			<span class="to-left">Gerência</span></label>
	
			<label for="publico_alvo_2" class="box-input"><input type="checkbox" name="publico_alvo[]" id="publico_alvo_2" class="to-left" value="Supervisão / Coordenação">
			<span class="to-left">Supervisão / Coordenação</span></label>
	
			<label for="publico_alvo_3" class="box-input"><input type="checkbox" name="publico_alvo[]" id="publico_alvo_3" class="to-left" value="Analistas/ Técnicos">
			<span class="to-left">Analistas/ Técnicos</span></label>

			<label for="publico_alvo_4" class="box-input"><input type="checkbox" name="publico_alvo[]" id="publico_alvo_4" class="to-left" value="Operacional">
			<span class="to-left">Operacional</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-full-col left-col to-left">
		<h1 class="to-left">Resultado Esperado:</h1>
		<div class="box-textarea to-left">
			<textarea name="resultado_esperado" id=""></textarea>										
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Local de Realização:</h1>
		<div class="box-radio to-left">
			<label for="local_realizacao_0" class="box-input"><input type="radio" name="local_realizacao" id="local_realizacao_0" class="to-left" value="In Company">
			<span class="to-left">In Company (Na empresa contratante)</span></label>

			<label for="local_realizacao_1" class="box-input"><input type="radio" name="local_realizacao" id="local_realizacao_1" class="to-left" value="Sala ou Espaco">
			<span class="to-left">Sala ou Espaço físico alugado (hotel, centro de convenções, etc)</span></label>

                    <label for="local_realizacao_2" class="box-input"><input type="radio" name="local_realizacao" id="local_realizacao_2" class="to-left" value="Auditorio da MB">
			<span class="to-left">Auditório da MB Consultoria</span></label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">A Empresa possui em sua infra-estrutura:</h1>
		<div class="box-radio to-left">
			<label for="possui_em_sua_infraestrutura_0" class="box-input"><input type="checkbox" name="possui_em_sua_infraestrutura[]" id="possui_em_sua_infraestrutura_0" class="to-left" value="Sala de Treinamento">
			<span class="to-left">Sala de Treinamento</span></label>

			<label for="possui_em_sua_infraestrutura_1" class="box-input"><input type="checkbox" name="possui_em_sua_infraestrutura[]" id="possui_em_sua_infraestrutura_1" class="to-left" value="Data Show">
			<span class="to-left">Data Show</span></label>

			<label for="possui_em_sua_infraestrutura_2" class="box-input"><input type="checkbox" name="possui_em_sua_infraestrutura[]" id="possui_em_sua_infraestrutura_2" class="to-left" value="Flip Chart">
			<span class="to-left">Flip Chart</span></label>

			<label for="possui_em_sua_infraestrutura_3" class="box-input"><input type="checkbox" name="possui_em_sua_infraestrutura[]" id="possui_em_sua_infraestrutura_3" class="to-left" value="TV/ DVD">
			<span class="to-left">TV/ DVD</span></label>

			<label for="possui_em_sua_infraestrutura_4" class="box-input"><input type="checkbox" name="possui_em_sua_infraestrutura[]" id="possui_em_sua_infraestrutura_3" class="to-left" value="Outros">
			<span class="to-left">Outros</span></label>
		</div>
	</div>
</div>

<div class="bloco-formulario">
	<div class="bloco-formulario-col left-col to-left">
		<h1 class="to-left">Data Prevista</h1>
		<div class="box-radio to-left">
			<label for="form_orcamento_data_inicio" class="box-input" style="margin-bottom: 30px;">
				<span class="to-left label-txt-label-width">Início:</span>
				<input type="text" name="data_inicio" id="form_orcamento_data_inicio" class="to-left data_nascimento" >
			</label>

			<label for="form_orcamento_data_fim" class="box-input">
				<span class="to-left label-txt-label-width">Término:</span>
				<input type="text" name="data_fim" id="form_orcamento_data_fim" class="to-left data_nascimento" >
			</label>
		</div>
	</div>

	<div class="bloco-formulario-col right-col to-right">
		<h1 class="to-left">Horário Previsto</h1>
		<div class="box-radio to-left">
                    <label for="horario_previsto_0" class="box-input"><input type="radio" name="horario_previsto" id="horario_previsto_0" class="to-left" value="Manha">
			<span class="to-left">Manhã</span></label>

			<label for="horario_previsto_1" class="box-input"><input type="radio" name="horario_previsto" id="horario_previsto_1" class="to-left" value="Tarde">
			<span class="to-left">Tarde</span></label>

			<label for="horario_previsto_2" class="box-input"><input type="radio" name="horario_previsto" id="horario_previsto_2" class="to-left" value="Noite">
			<span class="to-left">Noite</span></label>

			<label for="horario_previsto_3" class="box-input"><input type="radio" name="horario_previsto" id="horario_previsto_3" class="to-left" value="Fim de Semana">
			<span class="to-left">Fim de Semana (Sábado, Domingo, Feriado)</span></label>
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