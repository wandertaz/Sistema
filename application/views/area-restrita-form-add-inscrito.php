<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" style="overflow:hidden;"> <!--<![endif]-->
    <head>
        <meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>MB CONSULTORIA</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/estilos.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fontes.css">
        <script src="<?php echo base_url();?>assets/js/validation.js"></script>
        <script src="<?php echo base_url();?>assets/js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.maskedinput-1.3.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
        <script>
        jQuery(function(){
           jQuery("#data-nascimento").mask("99/99/9999");
           jQuery(".phone").mask("(99) 9999-9999");
           jQuery("#cep").mask("99999-999");
           jQuery("#cpf_add_inscrito").mask("999.999.999-99");

        jQuery("#formAddInscrito").validate({
            submitHandler:function(form) {
                SubmittingForm();
            },
            rules: {
                "nome_add_inscrito": "required",
                "cpf_add_inscrito": "required",
                "sexo_add_inscrito": "required",
                "sexo_add_inscrito": "required", 
                "data_add_inscrito": "required", 
                "tel_add_inscrito": "required", 
                "cep_add_inscrito": "required", 
                "uf_add_inscrito": "required", 
                "cidade_add_inscrito": "required", 
                "bairro_add_inscrito": "required", 
                "endereco_add_inscrito": "required",   
                "numero_add_inscrito": "required",            
                "email_add_inscrito": "required"
            }
        });

        });



        </script>

        <style>

        .big_inpt_txt_add_inscrito{
            width: 474px;

        }
        .small_inpt_txt_add_inscrito{
            width: 160px;
        }
        .small_label_add_inscrito{
            width: 160px;
        }

        #formAddInscrito{
            width: 700px;
        }
        #formAddInscrito label{
            display:block;
            margin: 3px 0;
            float:left;
        }
        #formAddInscrito label label.error{
            display:block;
            margin:4px 0 0 142px;
            position: absolute;
        }
        #formAddInscrito label span{
            display:block;
            float:left;
            text-align:right;
            width:130px;
            padding-right: 20px;
            color:#F7931E;
        }
        #formAddInscrito label input[type="text"]{
            display:block;
            float:left;
        }
        #formAddInscrito label input[type="radio"]{
            display:block;
            float:left;
            margin:5px 5px 0 0;
        }
        #formAddInscrito label input[type="submit"]{
            display:block;
            clear:both;
            float:right;
            margin-right:75px;
            border: 0;
            border: 0;
            color: #333;
            background: #F7931E;
            padding: 2px 8px;

        }
        .label_span{
            padding-right: 10px !important;
            width: 50px !important; 
            font-size:12px;
            margin-top:5px;
        }
        .to-left{
            float:left;
        }
        .to-right{
            float:right !important;
        }
        .clear{
            clear:both;
            overflow:hidden;
        }
        </style>
    </head>
    <body>
    <center>
        <h2>ADICIONAR NOVO DO ALUNO<br /></h2>
    </center>
    
      
    <p style="display: block;text-align: center;margin: 10px 0 0 0;text-transform: uppercase;color: red;overflow: hidden;height: 22px;"><?php echo($msg);?></p>
   
    <form action="<?  echo site_url();?>gerenciarinscritos/salvacadastro_inscrito" id="formAddInscrito" method="post">
        <label for="nome_add_inscrito"><span>Nome*</span><input type="text" name="nome_add_inscrito" class="inpt_txt_add_inscrito big_inpt_txt_add_inscrito" id="nome_add_inscrito"></label>
        <label for="cpf_add_inscrito"><span>CPF*</span><input type="text" name="cpf_add_inscrito" class="inpt_txt_add_inscrito big_inpt_txt_add_inscrito" id="cpf_add_inscrito"></label>
        <label for="cargo_add_inscrito"><span>Cargo</span><input type="text" name="cargo_add_inscrito" class="inpt_txt_add_inscrito big_inpt_txt_add_inscrito" id="cargo_add_inscrito"></label>
        <label for="email_add_inscrito"><span>E-mail*</span><input type="text" name="email_add_inscrito" class="inpt_txt_add_inscrito big_inpt_txt_add_inscrito" id="email_add_inscrito"></label>
        <label for="data_add_inscrito"><span>Nascimento</span><input type="text" name="data_add_inscrito" class="inpt_txt_add_inscrito small_inpt_txt_add_inscrito" id="data-nascimento"></label>
        
        <label for="masc" class="clear"><span>Sexo*</span><input type="radio" name="sexo_add_inscrito" value="M" class="inpt_radio_add_inscrito" id="masc"><span class="label_span">Masculino</span></label>
            <label for="fem"><input type="radio" name="sexo_add_inscrito" value="F" class="inpt_radio_add_inscrito" id="fem"><span class="label_span">Feminino</span></label>
        
        <label for="tel_add_inscrito" class="clear"><span>Telefone</span><input type="text" name="tel_add_inscrito" class="inpt_txt_add_inscrito small_inpt_txt_add_inscrito phone" id=""></label>
        <label for="cel_add_inscrito"><span>Celular</span><input type="text" name="cel_add_inscrito" class="inpt_txt_add_inscrito small_inpt_txt_add_inscrito phone" id=""></label>
        <label for="cep_add_inscrito" class=""><span>CEP</span><input type="text" name="cep_add_inscrito" class="inpt_txt_add_inscrito small_inpt_txt_add_inscrito" id="cep"></label>
        <label for="uf_add_inscrito" class=""><span>UF</span><input type="text" name="uf_add_inscrito" class="inpt_txt_add_inscrito small_inpt_txt_add_inscrito" id=""></label>
        <label for="cidade_add_inscrito" class=""><span>Cidade</span><input type="text" name="cidade_add_inscrito" class="inpt_txt_add_inscrito small_inpt_txt_add_inscrito" id=""></label>
        <label for="bairro_add_inscrito" class=""><span>Bairro</span><input type="text" name="bairro_add_inscrito" class="inpt_txt_add_inscrito small_inpt_txt_add_inscrito" id=""></label>
        <label for="endereco_add_inscrito"><span>Endereço</span><input type="text" name="endereco_add_inscrito" class="inpt_txt_add_inscrito big_inpt_txt_add_inscrito" id=""></label>
        <label for="numero_add_inscrito" class=""><span>Numero</span><input type="text" name="numero_add_inscrito" class="inpt_txt_add_inscrito small_inpt_txt_add_inscrito" id=""></label>
        <label for="complemento_add_inscrito"><span>Complemento</span><input type="text" name="complemento_add_inscrito" class="inpt_txt_add_inscrito small_inpt_txt_add_inscrito" id=""></label>
        
       
        <label for="" class="clear to-right"><input type="submit" name=""></label>
    </form>

	<!-- 
    Cargo
    Email
    Nascimento
    Telefone
    Celular
    Sexo
    CEP
    UF
    Cidade
    Bairro
    Endereço
    Complemento
     -->



	</body>
</html>


