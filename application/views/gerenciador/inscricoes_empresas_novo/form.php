<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>

			<input type="hidden" name="tipo_curso" id="tipo_curso" value="<?php echo $tipo;  ?>" />
			<?php $disable = (isset($registro->id) ? 'disabled' : ''); ?>

			<div class="input text">
	 			<label for="curso_id">Curso</label>
	 			<?php echo form_dropdown("curso_id", $cursos, set_value("curso_id", (isset($registro) ? $registro->curso_id : "")), "id=\"curso_id\" class=\"required\" ".$disable); ?>
			</div>

			<?php if(!isset($registro)):?>
                        <div class="input text">
	 			<label for="inscrito_nome">Nome cliente/Razão social</label>	 			
                                <input name="inscrito_nome" id="inscrito_nome" type="text" value="" class="ac_input required" />
                                <input name="inscrito_empresa_id" id="inscrito_id" type="hidden" value="<?php echo isset($registro) ? $registro->inscrito_empresa_id : "";?>" class="required" /><br>
                                &nbsp;&nbsp;&nbsp;Novo cadastro <a target="_blank" href="<?php echo site_url('multitools/inscritos/adicionar/F');?>">Pessoa Física</a> <a target="_blank" href="<?php echo site_url('multitools/inscritos/adicionar/J');?>">Pessoa Juridica</a>
			</div>
                         <?php else:?>
                            <div class="input text">
                                    <label for="inscrito_nome">Nome cliente/Razão social</label>	 			
                                    <input name="inscrito_nome" id="inscrito_nome" readonly="readonly" type="text" value="<?php echo isset($registro) ? $inscritos[0]->nome : "";?>"    class="ac_input required" />
                                    <input name="inscrito_empresa_id" id="inscrito_id"  readonly="readonly"    type="hidden" value="<?php echo isset($registro) ? $registro->inscrito_empresa_id : "";?>" class="required" /><br>
                                    &nbsp;&nbsp;&nbsp;Novo cadastro<!-- <a target="_blank" href="<?php echo site_url('multitools/inscritos/adicionar/F');?>">Pessoa Física</a>--> <a target="_blank" href="<?php echo site_url('multitools/inscritos/adicionar/J');?>">Pessoa Juridica</a>
                            </div>
                        <?php endif;?>                       
                       <div class="input text">
	 			<label for="numero_iscritos">Numero Inscritos</label>
                                <input name="numero_iscritos" id="numero_iscritos" type="text" value="<?php echo isset($registro) ? $registro->numero_iscritos :'';?>" class="required" />	 			
			</div>

			<div class="input text">
	 			<label for="status">Status</label>
	 			<?php echo form_dropdown("status", $status, set_value("status", (isset($registro) ? $registro->status : "")), "id=\"status\" class=\"required\" "); ?>
			</div>
       
			<div class="input text obrigatorio">
	 			<label for="data_aquisicao">Data de Aquisição</label>
	 			<input name="data_aquisicao" id="data_aquisicao" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_aquisicao) : ''); ?>" class="required datepicker" readonly="readonly" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_conclusao">Data de Conlusão</label>
	 			<input name="data_conclusao" id="data_conclusao" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_conclusao) : ''); ?>" class="required datepicker" readonly="readonly" />
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>