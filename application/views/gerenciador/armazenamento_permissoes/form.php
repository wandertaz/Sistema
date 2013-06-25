<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">
	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar/'.$pasta['id_pasta'], array("id" => "form"));?>

	  	<fieldset>

			<div class="input text">
	 			<label for="id_pasta">Pasta<br /><i>Pasta Permissão.</i></label>
	 			             
                                <select name="id_pasta" class="required">
                                   <option value="<?php echo $categorias['id_pasta']?>"> <?php echo $categorias['nome'];?> </option>
                                </select>

			</div>
                  
                        <div class="input text">
	 			<label for="inscrito_nome">Nome Pessoa Física</label>	 			
                                <input name="" id="inscrito_nome_F" type="text" value="" class="ac_input required" />
                                <input name="id_inscritos" id="inscrito_id_F" type="hidden" value="" class="required" /><br>
                                <label> Novo cadastro <a target="_blank" href="<?php echo site_url('multitools/inscritos/adicionar/F');?>">Pessoa Física</a></label>
			</div>                        
			<div class="input text">
                            <input name="id_inscritos_empresa" type="hidden" value="<?php echo $empresa['id_inscritos_empresa'];?>">
			</div>      
			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>