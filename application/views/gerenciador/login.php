
					<!doctype html>
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex,nofollow" />
	<title>Multiweb - Criação de sites, web design centrado no usuário - +55 31 2551.5183</title>
	<meta name="description" content="Multitools - Gerenciador de conteúdo">
	<meta name="author" content="Multiweb Agência Digital">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="<?php echo base_url();?>assets/multitools/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo base_url();?>assets/multitools/apple-touch-icon.png">

	<!-- CSS Styles -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/colors.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/jquery.tipsy.css">

	<!-- Google WebFonts -->
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>

	<script src="<?php echo base_url();?>assets/multitools/js/libs/modernizr-1.7.min.js"></script>
</head>
<body class="login">
	<section role="main">

		<!-- Login box -->
		<article id="login-box">

			<div class="article-container">
				<img src="http://multiwebphp.com.br/mb_consultoria/assets/img/logo.png" style="background-color:transparent;">
				<?php if($this->session->flashdata('msg') != ""):?>
				<!-- Notification -->
				<div class="notification error">
					<a href="#" class="close-notification" title="Hide Notification" rel="tooltip">x</a>
					<p><strong><?php echo $this->session->flashdata('msg');?></strong> </p>
				</div>
				<!-- /Notification -->
				<?php endif;?>


				<?php echo form_open('multitools/login/entrar');?>
					<fieldset>
						<dl>
							<dt>
								<label>Login</label>
							</dt>
							<dd>
								<input name="login" type="text" id="login" value="" />
							</dd>
							<dt>
								<label>Senha</label>
							</dt>
							<dd>
								<input name="senha" type="password" maxlength="20" id="senha" />
							</dd>
						</dl>
					</fieldset>
					<button type="submit" class="right">Entrar</button>
				<?php echo form_close();?>

			</div>

		</article>
		<!-- /Login box -->

	</section>

	<!-- JS Libs at the end for faster loading -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
	<script src="<?php echo base_url();?>assets/multitools/js/libs/selectivizr.js"></script>
	<script src="<?php echo base_url();?>assets/multitools/js/jquery/jquery.tipsy.js"></script>
	<script src="<?php echo base_url();?>assets/multitools/js/login.js"></script>
	<script>
		var _gaq=[['_setAccount','UA-XXXXXX'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
</body>
</html>