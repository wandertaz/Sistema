<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> Brinde</h3>

	<?php echo form_open_multipart($controller.'/salvar_brinde', array("id" => "form"));?>

	  	<fieldset>	  		
                    <!--brinde--><input name="id" id="id" type="hidden" value="<?php echo (isset($id) ? $id :''); ?>" />
                   <!--empresa--> <input name="contato_empresa_idcontato_empresa" id="contato_empresa_idcontato_empresa" type="hidden" value="<?php echo (isset($registro) ? $registro->contato_empresa_idcontato_empresa : $id_empresa); ?>" />
                    <?php if (isset($registro)): ?><!--id projeto--><input name="id" id="id" type="hidden" value="<?php echo (isset($registro) ? $registro->id : ''); ?>" /><?php endif; ?>
			
                    
	 		 <div class="input text">
	 			<label for="descricao">Descrição</label>
	 			<textarea name="descricao" id="descricao" class=""><?php echo (isset($registro) ? $registro->descricao : ''); ?></textarea>
			</div>
			<div class="input text obrigatorio">
	 			<label for="data_envio">Data de envio</label>
	 			<input name="data_envio" id="data_envio" type="text" value="<?php echo (isset($registro) ? br_date($registro->data_envio) : ''); ?>" class="required datepicker2" onkeypress="mascaraData(event, this);" maxlength="10" />
			</div>  

		
			<div class="input text obrigatorio">
	 			<label for="ocasiao">Ocasião</label>
	 			<?php  echo form_dropdown("ocasiao", array('AN' => 'Aniversário', 'PM' => 'Promotor', 'PP' => 'Proposta', 'HO' => 'Homenagem', 'OU' => 'Outro'), set_value("ocasiao", (isset($registro) ? $registro->ocasiao : "")), "id=\"ocasiao\" class=\"required\" "); ?>
			</div>             
                
                        
                    
                       <div class="submit">
				<input type="submit" value="Enviar" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>