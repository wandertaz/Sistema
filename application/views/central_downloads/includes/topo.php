<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php
	$base_url = base_url();
?>
    <head>
        <meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $title; ?> - MB CONSULTORIA</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/normalize.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/main.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/template.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/template-interna.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/estilos.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/beto.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/estilos-interna.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/fontes.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/accordion.core.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.fancybox.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/area-restrita.css">
        <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="bg2">
            <header>
                <div class="header-1">
                    <ul class="idioma">
                        <?php if (preg_match('/english/', $_SERVER['REQUEST_URI'])): ?>
                            <li><a href="<?php echo site_url('portugues'); ?>">portugu&ecirc;s</a></li>
                            <li><a class="lang" href="<?php echo site_url('english'); ?>">english</a></li>
                        <?php else: ?>
                            <li><a class="lang" href="<?php echo site_url('portugues'); ?>">portugu&ecirc;s</a></li>
                            <li><a href="<?php echo site_url('english'); ?>">english</a></li>
                        <?php endif ?>
                    </ul>
                    <ul class="menuTop">
                        <li><a href="faq">FAQ</a></li>
                        <li><a class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>contato">Contato</a></li>
                    </ul>
                    <div class="login">
                        <form name="search" action="" method="">
                           <input type="text" onBlur="if (this.value == '') {this.value = 'pesquisar...';}" onFocus="if (this.value == 'pesquisar...') {this.value = '';}" name="pesquisar" value="pesquisar...">
                            <input type="submit" value="" />
                        </form>
                     	<div id="login">
                         <form action="<?php echo site_url() ;?>loginlogout/login" method="post" style="position:relative; left:-40px;">
                             <input id="usuario-login" type="text" onBlur="if (this.value == '') {this.value = 'Usuário';}" onFocus="if (this.value == 'Usuário') {this.value = '';}" name="usuario" value="Usuário">
                             <input id="usuario-senha" type="password" onBlur="if (this.value == '') {this.value = 'Senha';}" onFocus="if (this.value == 'Senha') {this.value = '';}" name="senha" value="Senha"  style="width:110px;">
                             <input type="submit" class="entrar" name="Entrar" value="Entrar" />
                             <a href="<?php echo site_url('loginlogout/recuperar_senha');?>" class="lightRecovery" data-fancybox-type="iframe">Recuperar Senha </a>
                         </form>
						</div>
                    </div>
                    <ul class="redeSocial">
                        <li><a href="<?php //echo $link_facebook; ?>" class="face"><span>facebook</span></a></li>
                        <li><a href="<?php //echo $link_twitter; ?>" class="twitter"><span>twitter</span></a></li>
                        <li><a href="<?php //echo $link_youtube; ?>" class="youtube"><span>youtube</span></a></li>
                        <li><a href="<?php //echo $link_linkedin; ?>" class="linkedin"><span>linkedin</span></a></li>
                    </ul>
                </div>
               <a class="brand" href="<?php echo site_url(); ?>"><img src="<?php echo $base_url; ?>assets/img/logo.png" alt="w3resource logo" /></a>

                <?php if ($this->session->userdata('SessionIdAluno')>0):?>

                    <div class="logado">Olá <?php echo $this->session->userdata('SessionNomeAluno');?>, bem vindo! Acesse sua área restrita clicando <a href="<?php echo site_url();?>menu_interno">aqui</a> ou realize <a href="<?php echo site_url();?>loginlogout/logout">logoff</a>.</div>
               <?php elseif ($this->session->userdata('SessionIdEmpresa')>0):?>

                    <div class="logado">Olá <?php echo $this->session->userdata('SessionNomeEmpresa');?>, bem vindo! Acesse sua área restrita clicando <a href="<?php echo site_url();?>menu_interno">aqui</a> ou realize <a href="<?php echo site_url();?>loginlogout/logout">logoff</a>.</div>
                 <?php else:?>
                    <?php if (isset($msg['msg'])):?>

                        <?php if ($msg['msg']==1):?>
                           <script>
                               alert('Login ou senha Inválidos');
                           </script>
                       <?php elseif($msg['msg']==2): ?>
                       		<script>
                               alert('E-mail não encontrado.');
                           </script>
                       <?php elseif($msg['msg']==3): ?>
                       		<script>
                                    alert('Você deve estar logado para acessar a vaga!');
                           </script>
                       <?php endif;?>
                   <?php endif;?>
               <?php endif;?>
                <?php
						  include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu.php';
					?>

            </header>