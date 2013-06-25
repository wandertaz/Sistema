<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

<div id="tabela">
	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar_permissoes/', array("id" => "form"));?>

	  	<fieldset>

			<div class="input text">
	 			<label for="id_pasta">Empresa<br /><i>Permissão.</i></label>
	 			             
                                <select name="area_permissoes_concedidas_id_empresa" class="required">
                                   <option value="<?php echo $empresa->id; ?>"> <?php echo $empresa->nome;?> </option>
                                </select>

			</div>
                 <?php if(!isset($inscrito)): ?> 
                        <div class="input text">
	 			<label for="inscrito_nome">Nome Pessoa Física</label>	 			
                                <input name="" id="inscrito_nome_F" type="text" value="" class="ac_input required" />
                                <input name="inscritos_id" id="inscrito_id_F" type="hidden" value="" class="required" /><br>
                                <label> Novo cadastro <a target="_blank" href="<?php echo site_url('multitools/inscritos/adicionar/F');?>">Pessoa Física</a></label>
			</div> 
                <?php else: ?> 
			<div class="input text">
                            <input name="" id="aaa" type="text" value="<?php echo $inscrito->nome; ?>" readonly="" />
                            <input name="inscritos_id" type="hidden" value="<?php echo $inscrito->id;?>">
			</div> 
                <?php endif;?>  
                   
       
                       <?php foreach ($categorias as $itens): ?> 
                        <div class="input text">
                        <label for="area_permissoes_area_permissoes_id"><?php echo $itens->nome_area_permissoes;?></label>	
                         <?php echo form_checkbox('area_permissoes_area_permissoes_id[]',$itens->area_permissoes_id,isset($itens->area_permissoes_concedidas_id)?$itens->area_permissoes_concedidas_id>0?true:false:false);?>
                         </div>
                        <?php endforeach;?> 
                        
                        
                   
                    
                    
                   
			<div class="submit">
				<input type="submit" value="Enviar" />

			</div>

		</fieldset>

	<?php echo form_close();?>

</div>