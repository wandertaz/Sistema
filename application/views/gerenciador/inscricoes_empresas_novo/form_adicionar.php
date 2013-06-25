<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar_aluno', array("id" => "form"));?>

	  	<fieldset>

			

			
                        <div class="input text">
	 			<label for="inscrito_nome">Nome cliente/Razão social</label>	 			
                                <input name="inscrito_nome" id="inscrito_nome" type="text" value="" class="ac_input required" />
                                <input name="inscrito_id" id="inscrito_id" type="hidden" value="<?php echo isset($registro) ? $registro->inscrito_empresa_id : "";?>" class="required" /><br>
                                &nbsp;&nbsp;&nbsp;Novo cadastro <a target="_blank" href="<?php echo site_url('multitools/inscritos/adicionar/F');?>">Pessoa Física</a> <a target="_blank" href="<?php echo site_url('multitools/inscritos/adicionar/J');?>">Pessoa Juridica</a>
			</div>
                    <div class="input text obrigatorio">            
                        <input type="hidden" name="status" value='AP'>
                        </div>   
                        

       
			<div class="input text obrigatorio">
	 			<label for="data_aquisicao">Data de Aquisição</label>
	 			<input name="data_aquisicao" id="data_aquisicao" type="text" value="" class="required datepicker" readonly="readonly" />
			</div>

			<div class="input text obrigatorio">
	 			<label for="data_conclusao">Data de Conclusão</label>
	 			<input name="data_conclusao" id="data_conclusao" type="text" value="" class="required datepicker" readonly="readonly" />
			</div>

			<input name="id" id="id" type="hidden" value="<?php echo (isset($id_inscricoes_empresa) ? $id_inscricoes_empresa : ''); ?>" />

			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>