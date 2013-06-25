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
	 			<label for="idioma_id">Idioma</label>
	 			<?php echo form_dropdown("idioma_id", $idiomas, set_value("idioma_id", (isset($registro) ? $registro->idioma_id : "")), "id=\"idioma_id\" class=\"required\""); ?>
			</div>

			
                         <?php if(!isset($registro)):?> 
                        <div class="input text">
	 			<label for="instrutor_nome">Instrutor</label>	 			
                                <input name="instrutor_nome" id="instrutor_nome" type="text" value="" class="ac_input required" />
                                <input name="instrutor_id" id="instrutor_id" type="hidden" value="<?php echo isset($registro) ? $registro->instrutor_id : "";?>" class="required" /><br>
                                &nbsp;&nbsp;&nbsp;Cadastrar Novo <a target="_blank" href="<?php echo site_url('multitools/usuarios/adicionar');?>">Instrutor</a>
			</div>
                         <?php else:?>
                            <div class="input text">
                                    <label for="instrutor_nome">Instrutor</label>	 			
                                    <input name="instrutor_nome" id="instrutor_nome" readonly="readonly" type="text" value="<?php echo isset($registro) ? $instrutor->nome : "";?>"    class="ac_input required" />
                                    <input name="instrutor_id" id="instrutor_id"  readonly="readonly"    type="hidden" value="<?php echo isset($registro) ? $registro->instrutor_id : "";?>" class="required" /><br>
                                     &nbsp;&nbsp;&nbsp;Cadastrar Novo <a target="_blank" href="<?php echo site_url('multitools/usuarios/adicionar');?>">Instrutor</a>
                            </div>
                        <?php endif;?>
                    

	 		<div class="input text obrigatorio">
	 			<label for="titulo">Título</label>
	 			<input name="titulo" id="titulo" type="text" value="<?php echo (isset($registro) ? $registro->titulo : ''); ?>" class="required" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="descricao">Descrição</label>
				<textarea name="descricao" id="descricao" class="required"><?php echo (isset($registro) ? $registro->descricao : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="imagem">Imagem </label>
	 			<input id="imagem" type="file" name="imagem" size="47">
	 			<span> (102/160px)</span>
			</div>

			<?php if(isset($registro->imagem) && $registro->imagem): ?>
				<div class="input text obrigatorio">
					<label for="imagem">Imagem Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $registro->imagem; ?>" target="_blank">Ver Imagem</a>
				</div>
			<?php endif; ?>

			<div class="input text obrigatorio">
	 			<label for="folder">Folder </label>
	 			<input id="folder" type="file" name="folder" size="47">
	 			<span> (00x00)</span>
			</div>

			<?php if(isset($registro->folder) && $registro->folder): ?>
				<div class="input text obrigatorio">
					<label for="imagem">Folder Atual:</label><br />
					<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $registro->folder; ?>" target="_blank">Ver Imagem</a>
				</div>
			<?php endif; ?>

			<div class="input text obrigatorio">
	 			<label for="texto">Texto</label><br />
				<textarea name="texto" id="texto" class="editor"><?php echo (isset($registro) ? $registro->texto : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="objetivos">Objetivos</label><br />
				<textarea name="objetivos" id="objetivos" class="editor"><?php echo (isset($registro) ? $registro->objetivos : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="publico_alvo">Conteúdo</label><br />
				<textarea name="publico_alvo" id="publico_alvo" class="editor"><?php echo (isset($registro) ? $registro->publico_alvo : ''); ?></textarea>
			</div>


                     <!--   <div class="input text obrigatorio">
                                    <label for="data">Data Início</label>
                                    <input name="data_inicio" id="data" type="text" value="<?php //echo (isset($registro) ? br_date($registro->data_inicio) : ''); ?>" class="required datepicker" readonly="readonly" />
                       </div>
                       <div class="input text obrigatorio">
                                    <label for="data">Data Conclusão</label>
                                    <input name="data_conclusao" id="data" type="text" value="<?php //echo (isset($registro) ? br_date($registro->data_conclusao) : ''); ?>" class="required datepicker" readonly="readonly" />
                      </div>-->


<!--
			<div class="input text obrigatorio">
	 			<label for="requisitos">Pré-Requisitos</label><br />
				<textarea name="requisitos" id="requisitos" class="editor"><?php //echo (isset($registro) ? $registro->requisitos : ''); ?></textarea>
			</div>-->

			<div class="input text obrigatorio">
	 			<label for="carga_horaria">Carga Horária</label>
	 			<input name="carga_horaria" id="carga_horaria" type="text" value="<?php echo (isset($registro) ? $registro->carga_horaria : ''); ?>"  />
			</div>

			<div class="input text obrigatorio">
	 			<label for="contrato">Contrato</label>
				<textarea name="contrato" id="contrato" class="required"><?php echo (isset($registro) ? $registro->contrato : ''); ?></textarea>
			</div>

			<div class="input text obrigatorio">
	 			<label for="numero_aulas">Número total de aulas</label>
	 			<input name="numero_aulas" id="numero_aulas" type="text" value="<?php echo (isset($registro) ? $registro->numero_aulas : ''); ?>" />
			</div>

			<div class="input text">
	 			<label for="ativo">Ativo?</label>
	 			<?php echo form_dropdown("ativo", array('S' => 'Sim', 'N' => 'Não'), set_value("ativo", (isset($registro) ? $registro->ativo : "")), "class=\"required\""); ?>
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" class="" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>