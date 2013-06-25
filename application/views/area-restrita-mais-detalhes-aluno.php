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

        <style>
            /******* FORM *******/
        #form-contato{
                padding: 0 10px 10px;
        }

        #form-contato input.error{
                background: #f8dbdb;
                border-color: #e77776;
        }

        #form-contato div{
                margin-bottom: 15px;
        }
        #form-contato div span{
                margin-left: 10px;
                color: #b1b1b1;
                font-size: 11px;
                font-style: italic;
        }
        #form-contato div span.error{
                color: #e46c6e;
        }

        #error{
                margin-bottom: 20px;
                border: 1px solid #efefef;
        }
        #error ul{
                list-style: square;
                padding: 5px;
                font-size: 11px;
        }
        #error ul li{
                list-style-position: inside;
                line-height: 1.6em;
        }
        #error ul li strong{
                color: #e46c6d;
        }
        #error.valid ul li strong{
                color: #93d72e;
        }
        /******* /FORM *******/
        .this_body{
            padding:14px;
        }
        .this_body h2{
            color: #E6891C;            
        }
        .label_desc{
            width: 365px;
            display: block;
            float: left;
            padding-right: 13px;
            color: #E6891C;
            text-align: left;
            margin-bottom: 10px;
            padding:5px 10px;
        }
        .detalhe{
            font-weight: bold;
            color:#333;
            text-align: right;
            font-size:14px;
        }
        .to-left{
            float:left;
        }
        .label_in{
            width:120px;
            display: block;
            float:left;
        }
        .odd{
            background:#FAE8D1;
        }
        u{
            color:#333;
            margin:5px 0 0 0;
            display:block;
        }
        </style>
    </head>
    <body class="this_body">

	<center>
        <h2>DETALHES DO ALUNO:<br /><u><?php echo$detalhes_aluno[0]->nome;?></u></h2>
    </center>
 
 <div class="to-left">		
    <span class="label_desc"><span class="label_in">Cargo</span><span class="detalhe"><?php echo$detalhes_aluno[0]->profissao;?></span></span><br>
    <span class="label_desc odd"><span class="label_in">E-mail</span> <span class="detalhe"><?php echo$detalhes_aluno[0]->email;?></span></span><br>
    <span class="label_desc"><span class="label_in">Nascimento</span> <span class="detalhe"><?php echo br_date($detalhes_aluno[0]->data_nascimento);?></span></span><br>
    <span class="label_desc odd"><span class="label_in">Telefone</span> <span class="detalhe"><?php echo $detalhes_aluno[0]->telefone==''?'-':$detalhes_aluno[0]->telefone;?></span></span><br>
    <span class="label_desc"><span class="label_in">Celular</span> <span class="detalhe"><?php echo $detalhes_aluno[0]->celular==''?'-':$detalhes_aluno[0]->celular;?></span></span><br>
    <span class="label_desc odd"><span class="label_in">Sexo</span> <span class="detalhe"><?php echo $detalhes_aluno[0]->sexo=='F'?'Feminino':'Masculino';?></span></span><br>
 </div>

    <div class="to-left">
    <span class="label_desc"><span class="label_in">CEP</span><span class="detalhe"><?php echo$detalhes_aluno[0]->cep;?></span></span><br>
    <span class="label_desc odd"><span class="label_in">Uf</span> <span class="detalhe"><?php echo$detalhes_aluno[0]->estado;?></span></span><br>	
    <span class="label_desc"><span class="label_in">Cidade</span> <span class="detalhe"><?php echo$detalhes_aluno[0]->cidade;?></span></span><br>
    <span class="label_desc odd"><span class="label_in">Bairro</span> <span class="detalhe"><?php echo$detalhes_aluno[0]->bairro;?></span></span><br>
    <span class="label_desc"><span class="label_in">Endereço</span> <span class="detalhe"><?php echo$detalhes_aluno[0]->endereco.', '.$detalhes_aluno[0]->numero;?></span></span><br>
    <span class="label_desc odd"><span class="label_in">Complemento</span> <span class="detalhe"><?php echo$detalhes_aluno[0]->complemento;?></span></span><br>
    </div>

	</body>
</html>


