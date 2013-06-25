<?php
if(isset($_REQUEST['email']) && $_REQUEST['email'] != ''):

else:
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>MB CONSULTORIA - comentário</title>
        <meta name="description" content="">
        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/estilos.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fontes.css">
        <script src="<?php echo base_url();?>assets/js/validation.js"></script>
        <script src="<?php echo base_url();?>assets/js/vendor/modernizr-2.6.2.min.js"></script>

        <style>
            /******* FORM *******/
        html{
            overflow: hidden;
        }
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
        </style>

    </head>
    <body>
<form action="<?php echo $action ?>" id="form-contato" method="post">
	<h2><?php echo htmlentities(utf8_decode($titulo))?></h2>

	<div>
		<p><?php echo htmlentities(utf8_decode($msg))?></p>

		<label for="nome">Nome *</label><input type="text" id="nome" name="nome" />
		<label for="sobrenome">Sobrenome *</label><input type="text" id="sobrenome" name="sobrenome" />
		<label for="email">E-mail *</label><input type="email" id="email" name="email" />
		<label for="mensagem">Mensagem *</label><textarea class="text-comentarios" id="mensagem" name="mensagem"></textarea>

                <input type="hidden" name="AreaComentada" value="<?php echo $area ?>"/>
                <input type="hidden" name="id" value="<?php echo $id ?>"/>
                <input type="hidden" name="tituloarea" value="<?php echo $tituloarea?>"/>

                <input type="submit" value="<?php echo htmlentities($nomebotao)?>" />
	</div>
</form>
<?php endif; ?>