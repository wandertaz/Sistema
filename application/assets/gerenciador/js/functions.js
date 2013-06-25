function confima_exclusao(str)
{
	if(confirm('Tem certeza que deseja excluir o(a) ' + str + '?') == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}


function confima_desativa(str)
{
	if(confirm('Tem certeza que deseja desativar o(a) ' + str + '?') == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}


/**
 * call
 *
 * Faz a chamada via XMLHttp (usada para abstrair as funções do jquery)
 *
 */
function call(params){

    //Seta o tipo padrão para POST
    params["type"] = params["type"] ? params["type"] : "POST";

    //O tipo de retorno será sempre JSON
    params["dataType"] = "json";

    //Busca o elemento de retorno
    params["ret"] = (params["ret"] ? params["ret"] : "#conteudo_principal");

    //Busca o elemento a ser bloqueado
    params["elemBlock"] = (params["elemBlock"] ? params["elemBlock"] : "#tudo");

    //Verifica se existe o parâmetro success
    if(!params["success"]) {

        //Exibe o HTML de retorno no local definido
        params["success"] =
            function(retorno){
                //Verifica se existe HTML de retorno
                if(retorno.html)
                    //Exibe o HTML de retorno
                    $(params["ret"]).empty().html(retorno.html);
            }
    }

    //Executa a chamada
    $.ajax(params);

    //Verifica a necessidade de exibir um preload
    if(!params["noPreload"]) {

        //Bloqueia o elemento passado
        $(params["elemBlock"]).block({

            message: "Carregando...",
            css: {
                border: '3px solid #000',
                width: '200px',
                height: '25px',
                color: '#000'
            }

        });

        //Em caso de sucesso, remove o bloqueio
        $(params["elemBlock"]).ajaxSuccess(
            function(){
                //Desbloqueia e remove as propriedades 'ajax' do elemento
                $(this).unblock();
                $(this).unbind();
            }
        );
    }

    //Não permite o envio, pois este é feito pelo XMLHttp
    return false;
}

/**
* atualizaSelectRelacional
*
* Atualiza um select que tem relação de pai-filho
*

*/
function atualizaSelectRelacional(selectPai,url,selectFilho, idSelectFilho){

    //Declaração de variaveis
    var success;//callback
    var PaiId;//val do select pai
    var id;//id a ser utilizado no for in da resposta
    var opcao;//onde o elemento option será criado

    selectFilho = '#' + selectFilho;

    //Armazena o valor do id do select pai na variavel PaiId
    if(isNaN(selectPai))
        //Se for passado o seletor do pai, pegar o valor selecionado
        PaiId = $('#' + selectPai + ' option:selected').val();
    else
        //Se foi passado um inteiro, pegar o valor diretamente
        PaiId = selectPai;

    //Monta a url com o id do pai
    url = url+'/'+PaiId;

    //Desabilita o filho enquanto não receber os dados
    $(selectFilho).attr("disabled","disabled");

    //Mostra mensagem no select enquanto esta desabilitado
    $(selectFilho).children('option').text("Carregando");

    //Monta a função de retorno
    success = function(sucesso) {

        //Verifica se houve retorno
        if(sucesso){

            //Limpa o select filho
            $(selectFilho).html('');

            //Cria as opcoes para o selectFilho
            for(id in sucesso){

                //Cria o elemento option
                opcao = document.createElement('option');

                //Seta o valor e o text da opcao
                opcao.value = id;
                opcao.appendChild(document.createTextNode(sucesso[id]));

                //Adiciona à lista
                $(selectFilho).append(opcao);
            }

            //Caso o parametro for passado, selecionar o valor do select filho
            if(idSelectFilho)
                $(selectFilho+" option[value="+idSelectFilho+"]").attr("selected","selected");

            //Habilita o select filho novamente
            $(selectFilho).attr("disabled",false);
        }
        else
            //Exibe mensagem de erro
            $(selectFilho).children('option').text("Não há categorias atreladas!!");
    };

    //Executa o call
    call({'url' : url, 'type' : 'GET', 'success' : success, 'noPreload' : true});
}

/**
 * apenasNumeros
 *
 * Exige que somente números sejam digitados no campo passado como referência
 *
 */
function apenasNumeros(event) {

    var cod = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

    if((cod >= 48 && cod <= 57) || (cod == 8) || (cod == 13) || (cod == 9))
        return true;
    else
        return false;

}

/**
 * mascaraCpf
 *
 * Formata o CPF
 *
 **/
function mascaraCpf(event, objeto) {

    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

    if (keyCode >= 48 && keyCode <= 57) {
        with(objeto) {
            if (value.length == 3)
                value = value + ".";
            else if (value.length == 7)
                value = value + ".";
            else if (value.length == 11)
                value = value + "-";
        }
    } else if((keyCode == 8) || (keyCode == 13) || (keyCode == 9)){
        return true;
    } else {
        keyCode=0;
        return false;
    }
}

/**
 * mascaraTelefone
 *
 * Insere a máscara de telefone
 *
 * @return void
 */
function mascaraTelefone(event, objeto) {

    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

    if (keyCode >= 48 && keyCode <= 57) {
        with(objeto) {
            if (value.length == 0)
                value = value + "(";
            else if (value.length == 3)
                value = value + ")";
            else if (value.length == 8)
                value = value + "-";
        }
    } else if((keyCode == 8) || (keyCode == 13) || (keyCode == 9)){
        return true;
    } else {
        keyCode=0;
        return false;
    }
}

/**
 * mascaraData
 *
 * Formata a data
 *
 * @return  boolean
 **/
function mascaraData(event, objeto) {

    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

    if (keyCode >= 48 && keyCode <= 57) {
        with(objeto) {
            if (value.length == 2)
                value = value + "/";
            else if (value.length == 5)
                value = value + "/";
        }
    } else if((keyCode == 8) || (keyCode == 13) || (keyCode == 9)){
        return true;
    } else {
        keyCode=0;
        return false;
    }
}


/**
 * mascaraHora
 *
 * Formata a hora
 *
 * @return  boolean
 **/
function mascaraHora(event, objeto) {

    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

    if (keyCode >= 48 && keyCode <= 57) {
        with(objeto) {
            if (value.length == 2)
                value = value + ":";
            
        }
    } else if((keyCode == 8) || (keyCode == 13) || (keyCode == 9)){
        return true;
    } else {
        keyCode=0;
        return false;
    }
}





/**
 * mascaraCep
 *
 * Formata o CEP
 *
 **/
function mascaraCep(event, objeto) {

    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

    if (keyCode >= 48 && keyCode <= 57) {
        with(objeto) {
            if (value.length == 5)
                value = value + "-";
        }
    } else if((keyCode == 8) || (keyCode == 13) || (keyCode == 9)){
        return true;
    } else {
        keyCode=0;
        return false;
    }
}

/**
 * formataMoeda
 *
 * Máscara de valores monetarios
 *
 */
function formataMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){

    //Declara variaveis da função
    var maxLength = $(objTextBox).attr('maxlength');
    var strCheck = '0123456789';
    var whichCode = (typeof(e.which) == "undefined") ? e.keyCode : e.which;
    var sep = i = j = len = len2 = 0;
    var key = aux = aux2 = '';

    //13=enter, 8=backspace as demais retornam 0(zero)
    //Se WhichCode==0 faz com que seja possivel usar todas as teclas como delete, setas, etc.
    if ((whichCode == 13) || (whichCode == 0) || (whichCode == 8))
        return true;

    //Valor para o código da Chave
    key = String.fromCharCode(whichCode);

    //Chave inválida
    if (strCheck.indexOf(key) == -1)
        return false;

    len = objTextBox.value.length;

    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal))
            break;

    aux = '';

    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1)
            aux += objTextBox.value.charAt(i);

    aux += key;
    len = aux.length;

    //Limita a digitação de acordo com o maxlength do input
    if (objTextBox.value.length >= maxLength)
        return false
    if (len == 0)
        objTextBox.value = '';
    if (len == 1)
        objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2)
        objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;

        for (i = len2 - 1; i >= 0; i--)
            objTextBox.value += aux2.charAt(i);

        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}

/**
 * mascara_cnpj
 *
 * Formata o CNPJ
 *
 * @param  object
 * @return boolean
 */
function mascara_cnpj(event, objeto) {

    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

    if (keyCode >= 48 && keyCode <= 57) {
        with(objeto) {
            if (value.length == 2)
                value = value + ".";
            else if (value.length == 6)
                value = value + ".";
            else if (value.length == 10)
                value = value + "/";
            else if (value.length == 15)
                value = value + "-";
        }
    } else if((keyCode == 8) || (keyCode == 13) || (keyCode == 9)){
        return true;
    } else {
        keyCode=0;
        return false;
    }
}