<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

		<!--	<div class="input text">
	 			<label for="tipo_curso">Tipo de Curso</label>
	 			<?php echo form_dropdown("tipo_curso", $tipos_cursos, set_value("tipo_curso", (isset($registro) ? $registro->tipo_curso : "")), "id=\"tipo_curso\" class=\"required\" onchange=\" atualizaSelectRelacional(this.id, '".site_url("multitools/home/retorna_cursos_por_tipo/")."', 'curso_id'); \" "); ?>
			</div>
			-->

			<input type="hidden" name="tipo_curso" id="tipo_curso" value="<?php echo $tipo;  ?>" />

			<div class="input text">
	 			<label for="curso_id">Curso</label>
	 			<?php echo form_dropdown("curso_id", $cursos, set_value("curso_id", (isset($registro) ? $registro->curso_id : "")), "id=\"curso_id\" class=\"required\" "); ?>
			</div>

	 		<div class="input text obrigatorio">
	 			<label for="data_inicial">Data Inicial</label>
	 			<input name="data_inicial" id="data_inicial" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_inicial) : ''); ?>" class="required datepicker" readonly="readonly" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_final">Data Final</label>
	 			<input name="data_final" id="data_final" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_final) : ''); ?>" class="required datepicker" readonly="readonly" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="horario">Horário</label>
	 			<input name="horario" id="horario" type="text" value="<?php echo (isset($registro) ? $registro->horario : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_limite">Data Limite para inscrições</label>
	 			<input name="data_limite" id="data_limite" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_limite) : ''); ?>" class="required datepicker" readonly="readonly" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="numero_vagas">Número de Vagas</label>
	 			<input name="numero_vagas" id="numero_vagas" type="text" value="<?php echo (isset($registro) ? $registro->numero_vagas : ''); ?>" class="required" />
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>