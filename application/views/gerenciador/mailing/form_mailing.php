<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> Contato</h3>

	<?php echo form_open_multipart($controller.'/salvar_mailing', array("id" => "form"));?>

	  	<fieldset>	  		
                    <!--empresa--><input name="id" id="inscritos_id" type="hidden" value="<?php echo (isset($registro) ? $registro->id :''); ?>" />
                    
	
                    
                    
	 		<div class="input text obrigatorio">
	 			<label for="titulo">Título</label>
	 			<input name="titulo" id="titulo" type="text" value="<?php echo (isset($registro) ? $registro->titulo : ''); ?>" class="required" />
			</div>
                    
                    	<div class="input text obrigatorio">
	 			<label for="descricao">Descrição</label>
	 			<input name="descricao" id="descricao" type="text" value="<?php echo (isset($registro) ? $registro->descricao : ''); ?>" class="required" />
			</div> 
                    
                    
                        <div class="input text obrigatorio">
	 			<label for="texto">Conteúdo Mailing</label><br />
				<textarea name="texto" id="texto" class="required editor"><?php echo (isset($registro) ? $registro->texto : ''); ?></textarea>
			</div>



			<div class="input text obrigatorio">
	 			<label for="data_envio">Data de Envio</label>
	 			<input name="data_envio" id="data_envio" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_envio) : ''); ?>" class="datepicker2" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>    
                        
                       
		
			<div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>