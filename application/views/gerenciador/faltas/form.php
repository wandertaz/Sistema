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

			<?php if($tipo == 'AB'): ?>

				<div class="input text">
		 			<label for="curso_id">Curso</label>
		 			<?php echo form_dropdown("curso_id", $cursos, set_value("curso_id", (isset($registro) ? $registro->curso_id : "")), "id=\"curso_id\" class=\"required\" onchange=\" atualizaSelectRelacional(this.id, '".site_url("multitools/inscricoes/retorna_turmas_por_curso/".$tipo)."', 'turma_id'); \" "); ?>
				</div>

				<div class="input text">
		 			<label for="turma_id">Turma</label>
		 			<?php echo form_dropdown("turma_id", $turmas, set_value("turma_id", (isset($registro) ? $registro->turma_id : "")), "id=\"turma_id\" class=\"required\" onchange=\" atualizaSelectRelacional(this.id, '".site_url("multitools/faltas/retorna_inscritos_por_turma/".$tipo)."', 'inscrito_id'); \" "); ?>
				</div>

				<div class="input text">
		 			<label for="curso_id">Inscrito</label>
		 			<?php echo form_dropdown("inscrito_id", $inscritos, set_value("inscrito_id", (isset($registro) ? $registro->inscrito_id : "")), "id=\"inscrito_id\" class=\"required\" "); ?>
				</div>

			<?php else: ?>

				<div class="input text">
		 			<label for="curso_id">Curso</label>
		 			<?php echo form_dropdown("curso_id", $cursos, set_value("curso_id", (isset($registro) ? $registro->curso_id : "")), "id=\"curso_id\" class=\"required\" onchange=\" atualizaSelectRelacional(this.id, '".site_url("multitools/faltas/retorna_inscritos_por_curso/".$tipo)."', 'inscrito_id'); \""); ?>
				</div>

				<div class="input text">
		 			<label for="curso_id">Inscrito</label>
		 			<?php echo form_dropdown("inscrito_id", $inscritos, set_value("inscrito_id", (isset($registro) ? $registro->inscrito_id : "")), "id=\"inscrito_id\" class=\"required\" "); ?>
				</div>

			<?php endif; ?>

	 		<div class="input text obrigatorio">
	 			<label for="data">Data</label>
	 			<input name="data" id="data" type="text" value="<?php echo (isset($registro) ? br_date($registro->data) : ''); ?>" class="required datepicker" readonly="readonly" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="titulo">Motivo</label>
	 			<input name="titulo" id="titulo" type="text" value="<?php echo (isset($registro) ? $registro->titulo : ''); ?>" class="" />
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>