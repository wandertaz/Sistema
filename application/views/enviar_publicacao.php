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
        </style>
    </head>
    <body>
        <form action="<?php echo site_url();?>gerenciamento_email/enviar_publicacao" id="form-contato" method="post">
	<h2><?php echo isset($titulo) && $titulo ? htmlentities(utf8_decode($titulo)) : 'Enviar por e-mail'; ?></h2>

	<div>
		<!--<p>Desde de já agradecemos seu contato. Por favor preencha os campos abaixo, responderemos assim que possível. Campos com * são de preenchimento obrigatório.</p>-->

                <p><?php echo isset($msg) && $msg ? htmlentities(utf8_decode($msg)) : '';?> </p>

            <?php if(isset($registro) && $registro): ?>
				<label for="nome">Nome *</label><input type="text" id="nome" name="nome" />
				<label for="email">E-mail *</label><input type="email" id="email" name="email" /><span id="emailInfo"></span>

				<input type="hidden"  name="registro_id" value="<?php echo $registro['registro_id'];?>"/>
		        <input type="hidden"  name="tipo" value="<?php echo $registro['tipo'];?>" />
				<input type="submit" value="Enviar" />
			<?php endif; ?>

</form>