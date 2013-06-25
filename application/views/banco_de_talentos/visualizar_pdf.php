<div class="content-interna" style="width:990px; background:white;">

	<div class="centerCursos equalH-meus-cursos" style="width:784px;">
		<h1 class="titulo-autodiagnostico">Curr&iacute;culo - <?php echo utf8_decode($registro->nome); ?></h1>

		<hr>


		<p>Dados Pessoais</p>

		<div>
			<p style="font-size:12px; margin:2;"> <b>Nome: </b> <?php echo $registro->nome; ?></p>
			<p style="font-size:12px; margin:2;"> <b>Data de Nascimento: </b> <?php echo br_date($registro->data_nascimento); ?></p>
			<p style="font-size:12px; margin:2;"> <b>Sexo: </b> <?php echo $registro->sexo == 'F' ? 'Feminino' : 'Masculino'; ?></p>
			<p style="font-size:12px; margin:2;"> <b>Estado Civil: </b> <?php echo utf8_decode($estados_civis[$registro->estadocivil]); ?></p>
			<p style="font-size:12px; margin:2;"> <b>Religi&atilde;o: </b> <?php echo utf8_decode($registro->religiao); ?></p>
		</div>

		<div>
			<p style="font-size:12px; margin:2;"> <b>CPF: </b> <?php echo $registro->cpf_cnpj; ?></p>
			<p style="font-size:12px; margin:2;"> <b>E-mail: </b> <?php echo $registro->email; ?></p>
			<p style="font-size:12px; margin:2;"> <b>Telefone: </b> <?php echo $registro->telefone; ?></p>
			<p style="font-size:12px; margin:2;"> <b>Celular: </b> <?php echo $registro->celular; ?></p>
			<p style="font-size:12px; margin:2;"> <b>CEP: </b> <?php echo $registro->cep; ?></p>
			<p style="font-size:12px; margin:2;"> <b>Endere&ccedil;o: </b> <?php echo utf8_decode($registro->endereco); ?> - <?php echo $registro->numero; ?> <?php echo $registro->complemento ? '/'.$registro->complemento : ''; ?></p>
			<p style="font-size:12px; margin:2;"> <b>Bairro: </b> <?php echo utf8_decode($registro->bairro); ?> - <?php echo utf8_decode($registro->cidade).'/'.$registro->estado; ?></p>
		</div>

		<div>
			<p style="font-size:12px; margin:2;"> <b>Filhos? </b> <?php echo $registro->filhos == 'S' ? 'Sim' : 'Não'; ?> <?php echo $registro->filhos == 'S' && $registro->qtd_filhos > 0 ? '('.$registro->qtd_filhos.')' : ''; ?></p>
			<p style="font-size:12px; margin:2;"> <b>Possui CNH? </b> <?php echo $registro->cnh == 'S' ? 'Sim' : 'Não'; ?> - <b>Possui Ve&iacute;culo? </b><?php echo $registro->veiculo == 'S' ? 'Sim' : 'Não'; ?></p>
			<p style="font-size:12px; margin:2;"> <b>Possui alguma necessidade especial? </b> <?php echo $registro->deficiencia == 'S' ? 'Sim' : 'Não'; ?> <?php echo $registro->deficiencia == 'S' && $registro->qual_deficiencia ? '('.utf8_decode($registro->qual_deficiencia).')' : ''; ?></p>
			<p style="font-size:12px; margin:2;"> <b>Facebook: </b> <?php echo $registro->link_facebook; ?></p>
			<p style="font-size:12px; margin:2;"> <b>Twitter: </b> <?php echo $registro->link_twitter; ?></p>
			<p style="font-size:12px; margin:2;"> <b>Linkedin: </b> <?php echo $registro->link_linkedin; ?></p>
		</div>

		<p>Forma&ccedil;&atilde;o Acad&ecirc;mica</p>

			<?php if($formacao_academica): ?>
			<?php foreach($formacao_academica as $formacao): ?>
				<div style="border:1px solid #E0E0E0;">
					<p style="font-size:12px; margin:2;"> <b>Grau de Formação: </b> <?php echo $formacao->grau_formacao ? utf8_decode($graus_formacao[$formacao->grau_formacao]) : ''; ?></p>
					<p style="font-size:12px; margin:2;"> <b>Status do Curso: </b> <?php echo $formacao->status ? $status_formacao[$formacao->status] : ''; ?></p>
					<p style="font-size:12px; margin:2;"> <b>Nome do Curso: </b> <?php echo utf8_decode($formacao->nome_curso); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Institui&ccedil;&atilde;o: </b> <?php echo utf8_decode($formacao->instituicao); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Data de In&iacute;cio: </b> <?php echo ($formacao->data_inicio); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Data de Conclus&atilde;o: </b> <?php echo ($formacao->data_conclusao); ?></p>
				</div>
			<?php endforeach; ?>
			<?php endif; ?>


			<p>Idiomas</p>

			<?php foreach($idiomas as $idioma): ?>
				<div style="border:1px solid #E0E0E0;">
					<p style="font-size:12px; margin:2;"> <b><?php echo utf8_decode($idioma->nome_idioma); ?></b><br />
					 Leitura: <?php echo isset($niveis_idiomas[$idioma->nivel_leitura]) ? utf8_decode($niveis_idiomas[$idioma->nivel_leitura]) : ''; ?>
					 Escrita: <?php echo isset($niveis_idiomas[$idioma->nivel_escrita]) ? utf8_decode($niveis_idiomas[$idioma->nivel_escrita]) : ''; ?>
					 Conversa&ccedil;&atilde;o: <?php echo isset($niveis_idiomas[$idioma->nivel_conversacao]) ? utf8_decode($niveis_idiomas[$idioma->nivel_conversacao]) : ''; ?>
					</p>
				</div>
			<?php endforeach; ?>


			<p>Cursos Complementares</p>

			<?php foreach($cursos_complementares as $curso): ?>
				<div style="border:1px solid #E0E0E0;">
					<p style="font-size:12px; margin:2;"> <b>Nome do Curso: </b> <?php echo utf8_decode($curso->nome_curso); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Carga Hor&aacute;ria: </b> <?php echo $curso->carga_horaria; ?></p>
					<p style="font-size:12px; margin:2;"> <b>Cidade/Pa&oacute;s: </b> <?php echo utf8_decode($curso->cidade_pais); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Institui&ccedil;&atilde;o: </b> <?php echo utf8_decode($curso->instituicao); ?></p>
					<p style="font-size:12px; margin:2;"> <b>In&iacute;cio: </b> <?php echo ($curso->data_inicio); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Conclus&atilde;o: </b> <?php echo ($curso->data_fim); ?></p>
				</div>
			<?php endforeach; ?>


			<p>Hist&oacute;rico Profissional</p>

			<?php foreach($historico_profissional as $historico): ?>
				<div style="border:1px solid #E0E0E0;">
					<p style="font-size:12px; margin:2;"> <b>Empresa: </b> <?php echo utf8_decode($historico->empresa); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Cargos: </b> <br />
					<?php if($historico->cargos): ?>
					<?php foreach($historico->cargos as $cargo): ?>
						<?php echo utf8_decode($cargo->cargo); ?><br />
					<?php endforeach; ?>
					<?php endif; ?></p>
					<p style="font-size:12px; margin:2;"> <b>Entrada: </b> <?php echo br_date($historico->data_inicial); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Sa&iacute;da: </b> <?php echo br_date($historico->data_saida); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Motivo do Desligamento: </b> <?php echo utf8_decode($historico->motivo_desligamento); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Sal&aacute;rio: </b> <?php echo utf8_decode($historico->salario); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Benef&iacute;cios: </b> <?php echo utf8_decode($historico->beneficios); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Superior Imediato: </b> <?php echo utf8_decode($historico->superior_imediato); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Cargo do Superior Imediato: </b> <?php echo utf8_decode($historico->cargo_superior_imediato); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Principais Atribui&ccedil;&otilde;es: </b> <?php echo utf8_decode($historico->principais_atribuicoes); ?></p>

				</div>
			<?php endforeach; ?>


			<p>Refer&ecirc;ncias Profissionais</p>

			<?php foreach($referencias_profissionais as $referencia): ?>
				<div style="border:1px solid #E0E0E0;">
					<p style="font-size:12px; margin:2;"> <b>Empresa: </b> <?php echo utf8_decode($referencia->empresa); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Superior Imediato: </b> <?php echo utf8_decode($referencia->nome_superior_imediato); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Cargo: </b> <?php echo utf8_decode($referencia->cargo); ?></p>
					<p style="font-size:12px; margin:2;"> <b>Telefone: </b> <?php echo utf8_decode($referencia->telefone_comercial); ?></p>
					<p style="font-size:12px; margin:2;"> <b>E-mail: </b> <?php echo utf8_decode($referencia->email); ?></p>
				</div>
			<?php endforeach; ?>


			<p>Objetivos Profissionais</p>
			<div style="border:1px solid #E0E0E0;">
				<p style="font-size:12px; margin:2;"> <b>Objetivos: </b> <?php echo utf8_decode($registro->objetivosprofissionais); ?></p>
				<p style="font-size:12px; margin:2;"> <b>N&iacute;vel de Atua&ccedil;&atilde;o: </b> <?php echo $registro->niveis_de_atuacao_id_nivel ? utf8_decode($niveis_atuacao[$registro->niveis_de_atuacao_id_nivel]) : ''; ?></p>
				<p style="font-size:12px; margin:2;"> <b>Áreas de Atuação: </b><br />
				<?php foreach($areas_atuacao as $area): ?>
					<?php echo utf8_decode($area->nome_area); ?><br />
				<?php endforeach; ?></p>
				<p style="font-size:12px; margin:2;"> <b>Segmento de Atua&ccedil;&atilde;o: </b> <?php echo $segmento_atuacao ? utf8_decode($segmento_atuacao->segmentodeatuacao_nome) : ''; ?></p>
				<p style="font-size:12px; margin:2;"> <b>Disponibilidade de Hor&aacute;rio: </b> <?php echo $disponibilidade_horario ? utf8_decode($disponibilidade_horario->disponibilidadehorario_nome) : ''; ?></p>
				<p style="font-size:12px; margin:2;"> <b>Pretens&atilde;o Salarial: </b> <?php echo $pretensao_salarial ? utf8_decode($pretensao_salarial->pretencaosalarial_nome) : ''; ?></p>

			</div>

	</div>

</div>