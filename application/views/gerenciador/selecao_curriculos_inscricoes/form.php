<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

	  		<div class="input text">
	 			<label for="inscritos_id">Empresa</label>
	 			<br /><p><?php echo $registro->nome; ?></p>
			</div>

			<div class="input text">
	 			<label for="inscritos_id">Data</label>
	 			<br /><p><?php echo br_date($registro->data_inscricao); ?></p>
			</div>

			<div class="input text">
	 			<label for="inscritos_id">Pacote</label>
	 			<?php $total_curriculos = count(explode(',', $registro->curriculos_ids)); ?>
	 			<br /><p><?php echo $total_curriculos; ?> currículos</p>
			</div>

			<div class="input text">
	 			<label for="inscritos_id">Currículos do Pacote</label>
	 			<br />
	 			<?php foreach($curriculos as $curriculo): ?>
	 				<div class="input text" style="margin:3px;">
					<p><?php echo $curriculo->inscrito; ?>
					<?php echo anchor('multitools/curriculos/editar/'.$curriculo->inscritos_id, 'Editar', array('target' => '_blank'));?>
					<?php echo anchor('multitools/curriculos/visualizar/'.$curriculo->inscritos_id, 'Visualizar', array('target' => '_blank'));?></p>
					</div>
	 			<?php endforeach; ?>
			</div>

			<input name="id_inscricao" id="id_inscricao" type="hidden" value="<?php echo (isset($registro) ? $registro->id_inscricao : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>