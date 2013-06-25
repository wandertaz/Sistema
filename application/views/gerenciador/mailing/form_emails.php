<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>

 <style>
             input[type="text"],input[type="submit"],select.busca-input-2  {                 
                  /* width:14%; */
                   margin:10px 0px 0px 10px;                     
                   display: inline-block;
                  /* float: none !important;*/
                    
                }
                
                .busca2{
                    width:45%;                   
                    /*background:red;*/
                    float: left !important;
                    margin:10px 0px 0px 10px;  
              
                    
                }
                
 </style>


<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?> E-mails</h3>

	<?php //echo form_open_multipart($controller.'/salvar_mailing', array("id" => "form"));?>

	  	<fieldset>	  		
                    
                    
	
                    
                        <div class="busca2" >
                            <span class="buscar-span" ><b>Buscar Filtro Empresa</b></span><br>	
                                <?php echo form_open($controller.'/buscar_email', array('id' => 'UserIndexForm', 'method' => 'get'));?>
                                                <input name="tipo_filtro" id="tipo_filtro" type="hidden" value="E">                                              
                                                <!--empresa--><input name="id_mailing" id="id_mailing" type="hidden" value="<?php echo $id_mailing; ?>" />

                                                <?php echo form_dropdown("segmento_empresa", array('' => 'Segmento Empresa','Indústria' => 'Indústria', 'Comércio' => 'Comércio','Serviços'=>'Serviços','Construção Civil'=>'Construção Civil','Gestão Pública'=>'Gestão Pública'),( ! isset($_GET['segmento_empresa'])) ? '' : $_GET['segmento_empresa'], "id=\"segmento_empresa\" class=\"busca-input-2\" "); ?>


                                                <?php echo form_dropdown("atuacao_empresa",$ramo_atividade,( ! isset($_GET['atuacao_empresa'])) ? '' : $_GET['atuacao_empresa'], "id=\"atuacao_empresa\" class=\"busca-input-2\" "); ?>

                                                <?php echo form_dropdown("cidade",$cidades ,( ! isset($_GET['cidade'])) ? '' : $_GET['cidade'], "id=\"cidade\" class=\"busca-input-2\" "); ?>
                                                <?php echo form_dropdown("categoria", array('' => 'Categoria','C'=>'Cliente','P'=>'Prospect'),( ! isset($_GET['categoria'])) ? '' : $_GET['categoria'], "id=\"categoria\" class=\"busca-input-2\" "); ?>
                                                <?php echo form_dropdown("id_usuario_consultor_responsavel",$usuario,( ! isset($_GET['id_usuario_consultor_responsavel'])) ? '' : $_GET['id_usuario_consultor_responsavel'], "id=\"id_usuario_consultor_responsavel\" class=\"busca-input-2\" "); ?>
                                                <?php echo form_dropdown("tipo", array('' => 'Tipo do projeto','GP'=>'Gestão Pessoas','GC'=>'Gov Corporativa','Pr'=>'Processos','ES'=>'Estrategia','EC'=>'Educ Corporativa'),( ! isset($_GET['tipo'])) ? '' : $_GET['tipo'], "id=\"tipo\" class=\"busca-input-2\" "); ?>
                                                <?php echo form_dropdown("classificacao", array('' => 'Classificação','A'=>'A','B'=>'B','C'=>'C'),( ! isset($_GET['classificao'])) ? '' : $_GET['classificao'], "id=\"classificao\" class=\"busca-input-2\" "); ?>
                                                <div class="input text obrigatorio">
                                                    <label for="nome" style="padding-left:10px">Nome Empresa</label>
                                                    <input name="nome" id="nome" type="text" value="" class="required" >
                                                </div>
                                                
                                                
                                                <div class="submit">                
                                                <input type="submit" value="Buscar"  />
                                                </div>
                                <?php echo form_close();?>

                        </div>
                    
                                            
                        <div class="busca2" >
                            <span class="buscar-span" ><b>Buscar Filtro Contato</b></span><br>	
                                <?php echo form_open($controller.'/buscar_email', array('id' => 'UserIndexForm', 'method' => 'get'));?>
                                                <input name="tipo_filtro" id="tipo_filtro" type="hidden" value="C">  
                                                <!--empresa--><input name="id_mailing" id="id_mailing" type="hidden" value="<?php echo $id_mailing; ?>" />

                                                
                                                <?php echo form_dropdown("inscritos_id",$empresa ,( ! isset($_GET['empresa'])) ? '' : $_GET['empresa'], "id=\"inscritos_id\" class=\"busca-input-2\" "); ?>
                                                <?php echo form_dropdown("sexo", array('' => 'Sexo Contato','F' => 'Feminino', 'M' => 'Masculino'),( ! isset($_GET['sexo'])) ? '' : $_GET['sexo'], "id=\"sexo\" class=\"busca-input-2\" "); ?>
                                                
                                                <?php //echo form_dropdown("forma_de_tratamento", array('' => 'Forma de Tratamento','Sr' => 'Senhor', 'Srª' => 'Senhora','V.'=>'Você'),( ! isset($_GET['forma_de_tratamento'])) ? '' : $_GET['forma_de_tratamento'], "id=\"forma_de_tratamento\" class=\"busca-input-2\" "); ?>

                                                <?php echo form_dropdown("contato_principal",array('' => 'Contato Principal','T' => 'Telefone', 'C' => 'Celular','E'=>'Email'),( ! isset($_GET['contato_principal'])) ? '' : $_GET['contato_principal'], "id=\"contato_principal\" class=\"busca-input-2\" "); ?>

                                                <?php echo form_dropdown("cargo",$cargo ,( ! isset($_GET['cargo'])) ? '' : $_GET['cargo'], "id=\"cargo\" class=\"busca-input-2\" "); ?>
                                                
                                                <?php echo form_dropdown("area",$area ,( ! isset($_GET['area'])) ? '' : $_GET['area'], "id=\"area\" class=\"busca-input-2\" "); ?>
                                                <div class="input text obrigatorio">
                                                    <label for="data_nascimento" style="padding-left:10px">Data de Aniversário</label>
                                                    <input name="data_nascimento" id="data_nascimento" type="text" value="" class="required datepickersemano" onkeypress="mascaraData(event, this);" maxlength="10">
                                                </div>
                                                <div class="submit">                
                                                <input type="submit" value="Buscar"  />
                                                </div>
                                <?php echo form_close();?>

                        </div>
                    
                    
                    
                    
                    
	 		
                    
                    
                   
			
		</fieldset>

	<?php //echo form_close();?>

</div>