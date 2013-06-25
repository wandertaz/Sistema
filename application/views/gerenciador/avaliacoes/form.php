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
	 			<?php echo form_dropdown("curso_id", $cursos, set_value("curso_id", (isset($registro) ? $registro->curso_id : "")), "id=\"curso_id\" class=\"required\" disabled"); ?>
			</div>

			<div class="input text">
	 			<label for="curso_id">Inscrito</label>
	 			<?php echo form_dropdown("inscrito_id", $inscritos, set_value("inscrito_id", (isset($registro) ? $registro->inscrito_id : "")), "id=\"inscrito_id\" class=\"required\" disabled"); ?>
			</div>

			<div class="input text">
	 			<label for="pergunta_id">Pergunta</label>
	 			<?php echo form_dropdown("pergunta_id", $perguntas, set_value("pergunta_id", (isset($registro) ? $registro->pergunta_id : "")), "id=\"pergunta_id\" class=\"required\" disabled"); ?>

			</div>

			<div class="input text obrigatorio">
	 			<label for="nota">Nota</label>
	 			<input name="nota" id="nota" type="text" value="<?php echo (isset($registro) ? $registro->nota : ''); ?>" class="" readonly="readonly" />

			</div>

			<div class="input text obrigatorio">
	 			<label for="resposta">Resposta</label>
				<textarea name="resposta" id="resposta" class="" readonly="readonly"><?php echo (isset($registro) ? $registro->resposta : ''); ?></textarea>

			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<!--<div class="submit">
				<input type="submit" value="Enviar" />

			</div>-->

		</fieldset>

	<?php echo form_close();?>

</div>