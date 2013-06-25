<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>MB CONSULTORIA</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/template-interna.css">
        <link rel="stylesheet" href="css/estilos-interna.css">
        <link rel="stylesheet" href="css/fontes.css">
        <link rel="stylesheet" href="css/accordion.core.css">
        <link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />
	    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="bg2">
            <header>
                <div class="header-1">
                    <ul class="idioma">
                        <li><a href="<?php echo site_url('portugues'); ?>">portugu&ecirc;s</a></li>
                        <li><a href="<?php echo site_url('english'); ?>">english</a></li>
                    </ul>
                    <ul class="menuTop">
                        <li><a href="">FAQ</a></li>
                        <li><a href="">Carreira</a></li>
                        <li><a href="">Contato</a></li>
                    </ul>
                    <div class="login">
                        <form name="login" action="" method="post">
                           <input type="text" onBlur="if (this.value == '') {this.value = 'pesquisar...';}" onFocus="if (this.value == 'pesquisar...') {this.value = '';}" name="pesquisar" value="pesquisar...">
                            <input type="submit" value="" />
                        </form>
                     	<div id="login">
                         <form style="position:relative; left:-40px;"   >
                             <input type="text" onBlur="if (this.value == '') {this.value = 'Usuário';}" onFocus="if (this.value == 'Usuário') {this.value = '';}" name="usuario" value="Usuário">
                             <input type="text" onBlur="if (this.value == '') {this.value = 'Senha';}" onFocus="if (this.value == 'Senha') {this.value = '';}" name="senha" value="Senha"">
                             <input type="button" class="entrar" name="Entrar" value="Entrar" />
                         </form>
						</div>
                    </div>
                    <ul class="redeSocial">
                        <li><a href="#" class="face"><span>facebook</span></a></li>
                        <li><a href="#" class="twitter"><span>twitter</span></a></li>
                        <li><a href="#" class="youtube"><span>youtube</span></a></li>
                        <li><a href="#" class="linkeid"><span>linkeid</span></a></li>
                    </ul>
                </div>
                <a class="brand" href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="w3resource logo" /></a>
                <?php
						include("menu.php");
					?>

            </header>
