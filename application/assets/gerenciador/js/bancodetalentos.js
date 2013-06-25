jQuery(function(){

	jQuery('.btn_add_modulo').on('click',function(e){ e.preventDefault(); });

	//Clona campos - Formação Acadêmica
	jQuery("#btn_add_formacao_academica").click(function () {
		novoCampo = jQuery("div.formacao_academica_origin:last").clone();
		novoCampo.find(".grau_formacao").val("").attr('id', novoCampo.find(".grau_formacao").attr('id') + '1');
		novoCampo.find(".status").val("").attr('id', novoCampo.find(".status").attr('id') + '1');
		novoCampo.find(".nome_curso").val("").attr('id', novoCampo.find(".nome_curso").attr('id') + '1');
		novoCampo.find(".instituicao").val("").attr('id', novoCampo.find(".instituicao").attr('id') + '1');
		novoCampo.find(".data_inicio").val("").attr('id', novoCampo.find(".data_inicio").attr('id') + '1');
		novoCampo.find(".data_conclusao").val("").attr('id', novoCampo.find(".data_conclusao").attr('id') + '1');
		novoCampo.attr('id', novoCampo.attr('id') + '1');
		novoCampo.insertAfter("div.formacao_academica_origin:last");
	});

	//Clona campos - Cursos Complementares
	jQuery("#btn_add_formacao_academica_complementar").click(function () {
		novoCampo = jQuery("div.formacao_academica_origin_complementar:last").clone();
		novoCampo.find(".nome_curso_complementar").val("").attr('id', novoCampo.find(".nome_curso_complementar").attr('id') + '1');
		novoCampo.find(".carga_horaria").val("").attr('id', novoCampo.find(".carga_horaria").attr('id') + '1');
		novoCampo.find(".cidade_pais").val("").attr('id', novoCampo.find(".cidade_pais").attr('id') + '1');
		novoCampo.find(".instituicao_complementar").val("").attr('id', novoCampo.find(".instituicao_complementar").attr('id') + '1');
		novoCampo.find(".data_inicio_complementar").val("").attr('id', novoCampo.find(".data_inicio_complementar").attr('id') + '1');
		novoCampo.find(".data_fim").val("").attr('id', novoCampo.find(".data_fim").attr('id') + '1');
		novoCampo.attr('id', novoCampo.attr('id') + '1');
		novoCampo.insertAfter("div.formacao_academica_origin_complementar:last");
	});

	//Clona campos - Historico Profissional
    jQuery('.add_set').live('click',function(e){

    	var numItens = jQuery('.historico_profissional').length + 1;
    	jQuery(this).prev('.historico_x').val(numItens);
    	jQuery('#num_itens_historico').val(numItens);

      e.preventDefault();
      var html  = '<div id="historico_profissional" class="historico_profissional holder_cadastro_curriculo container_page_cadastro_curriculo">';
          html += '<div class="input text"><label for="empresa">Empresa</label><input name="empresa_'+numItens+'" class="empresa" id="empresa" type="text" value="" /></div>';
          html += '<div id="cargo_origin" class="cargo_origin"><div class="input text"><label for="cargo">Cargo</label><input name="cargo_'+numItens+'[]" id="cargo" class="cargo_profissao" type="text" value="" /></div></div>';
          html += '<div class="input text"><div class="add_fields"></div><a id="btn_add_cargo" class="btn_add_cargo btn_add_modulo add_campo" href="">+ Incluir outro Cargo</a></div>';
          html += '<div class="input text"><label for="data_inicial">Entrada</label><input name="data_inicial_'+numItens+'" class="data_inicial" id="data_inicial" type="text" value="" class="datepicker" onkeypress="mascaraData(event, this);" maxlength="10"/></div>';
          html += '<div class="input text"><label for="data_saida">Saída</label><input name="data_saida_'+numItens+'" class="data_saida" id="data_saida" type="text" value="" class="datepicker" onkeypress="mascaraData(event, this);" maxlength="10"/></div>';
          html += '<div class="input text"><label for="motivo_desligamento">Motivo de Desligamento</label><input name="motivo_desligamento_'+numItens+'" class="motivo_desligamento" id="motivo_desligamento" type="text" value=""/></div>';
          html += '<div class="input text"><label for="salario">Salário</label><input name="salario_'+numItens+'" class="salario" id="salario" type="text" value="" /></div>';
          html += '<div class="input text"><label for="beneficios">Benefícios</label><input name="beneficios_'+numItens+'" class="beneficios" id="beneficios" type="text" value="" /></div>';
          html += '<div class="input text"><label for="superior_imediato">Superior Imediato</label><input name="superior_imediato_'+numItens+'" class="superior_imediato" id="superior_imediato" type="text" value="" /></div>';
          html += '<div class="input text"><label for="cargo_superior_imediato">Cargo do Superior Imediato</label><input name="cargo_superior_imediato_'+numItens+'" class="cargo_superior_imediato" id="cargo_superior_imediato" type="text" value="" /></div>';
          html += '<div class="input text"><label for="principais_atribuicoes">Principais Atribuições</label><input name="principais_atribuicoes_'+numItens+'" class="principais_atribuicoes" id="principais_atribuicoes" type="text" value="" /></div>';
          html += '<input type="hidden" name="historico_x" id="historico_x" class="historico_x" value="'+numItens+'" ><div class="input text"><hr /></div>';
          html += '</div>';
          jQuery(".add_sets").append(html);
    });

	//Clona campos - Cargo
    jQuery('.add_campo').live('click',function(e){

		var item = jQuery(this).parent().parent().parent().find('.historico_x').val();

		e.preventDefault();
		var html  = '<div class="input text"><label for="cargo">Cargo</label><input name="cargo_'+item+'[]" id="cargo1" class="cargo_profissao" type="text" value="" /></div>';
		jQuery(this).prev(".add_fields").append(html);
    });

    //Clona campos - Referências
	jQuery("#btn_add_referencia_profissional").click(function () {
		novoCampo = jQuery("div.referencia_profissional_origin_origin:last").clone();
		novoCampo.find(".empresa_referencia").val("").attr('id', novoCampo.find(".empresa_referencia").attr('id') + '1');
		novoCampo.find(".nome_superior_imediato").val("").attr('id', novoCampo.find(".nome_superior_imediato").attr('id') + '1');
		novoCampo.find(".cargo_referencia").val("").attr('id', novoCampo.find(".cargo_referencia").attr('id') + '1');
		novoCampo.find(".telefone_comercial").val("").attr('id', novoCampo.find(".telefone_comercial").attr('id') + '1');
		novoCampo.find(".email_referencia").val("").attr('id', novoCampo.find(".email_referencia").attr('id') + '1');
		novoCampo.attr('id', novoCampo.attr('id') + '1');
		novoCampo.insertAfter("div.referencia_profissional_origin_origin:last");
	});

});