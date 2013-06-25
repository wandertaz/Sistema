<div id="tabela">

	<div id="cima">

		<div class="adicionar">
			<p>Consulta de Currículos</p>
		</div><!--/adicionar -->

		<div id="tabela">

			<?php echo form_open_multipart($controller.'/busca_consulta', array("id" => "form"));?>

				<fieldset>


					<div class="input text">
			 			<label for="nome">Nome</label>
			 			<input name="nome" id="nome" type="text" value="" />
					</div>

					<div class="input text">
			 			<label for="cpf">CPF</label>
			 			<input name="cpf" id="cpf" type="text" value="" class="required" onkeypress="mascaraCpf(event, this);" maxlength="14" />
					</div>

					<div class="input text">
			 			<label for="idade_de">Faixa Etária</label><br />
			 			<input type="text" name="idade_de" class="busca-input" id="idade_de" value="" onkeypress="return apenasNumeros(event);" maxlength="2" size="2" style="width:30px; float: none;" />
						até
						<input type="text" name="idade_ate" class="busca-input" id="idade_ate" value="" onkeypress="return apenasNumeros(event);" maxlength="2" size="2" style="width:30px; float: none;"/>
					</div>

					<div class="input text">
						<label for="estado_civil">Estado Civil</label>
						<?php echo form_dropdown("estado_civil", array('' => '--Selecione--') + $estados_civis, set_value("estado_civil", ""), "id=\"estado_civil\""); ?>
					</div>

					<div class="input text">
			 			<label for="cidade">Cidade</label>
			 			<input name="cidade" id="cidade" type="text" value=""/>
					</div>

					<div class="input text">
			 			<label for="portador_necessidade">Portador de Necessidades?</label>
			 			<?php echo form_dropdown("portador_necessidade", array('' => '--Selecione--', 'S' => 'Sim', 'N' => 'Não'), set_value("portador_necessidade", ""), "id=\"portador_necessidade\""); ?>
					</div>

					<div class="input text">
			 			<label for="necessidade">Qual Necessidade?</label>
						<input name="necessidade" id="necessidade" type="text" value="" />
					</div>

					<div class="input text">
						<label for="grau_formacao">Grau de Formação</label>
						<?php echo form_dropdown("grau_formacao", array('' => 'Selecione') + $graus_formacao, set_value("grau_formacao", ""), "id=\"grau_formacao\""); ?>
					</div>

					<div class="input text">
			 			<label for="curso_formacao">Curso de Formação</label>
						<input name="curso_formacao" id="curso_formacao" type="text" value="" />
					</div>

					<div class="input text">
						<label for="nivel_atuacao">Níveis de Atuação</label>
						<?php echo form_dropdown("nivel_atuacao", $niveis_atuacao, set_value("nivel_atuacao", ""), "id=\"nivel_atuacao\""); ?>
					</div>

					<div class="input text obrigatorio">
			 			<label for="areas_atuacao">Áreas de Atuação</label>
			 			<?php foreach($areas_atuacao as $id_area => $area_atuacao): ?>
			 				<div class="input text">
							<input style="width: 3px;" type="checkbox" name="areas_atuacao[]" id="areas_atuacao" value="<?php echo $id_area ?>"> <p style="float:left; padding: 0 5px;"><?php echo $area_atuacao; ?></p>
			 				</div>
						<?php endforeach; ?>
					</div>

					<div class="input text">
						<label for="pretensao_salarial">Pretensão Salarial</label>
						<?php echo form_dropdown("pretensao_salarial", $pretensoes_salariais, set_value("pretensao_salarial", ""), "id=\"pretensao_salarial\""); ?>
					</div>

					<div class="submit">
						<input type="submit" value="Buscar" />
					</div>
				</fieldset>
			<?php echo form_close();?>

		</div>

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

</div><!--/tabela -->