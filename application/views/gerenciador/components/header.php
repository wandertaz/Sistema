<!doctype html>
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <title>Multitools - MB Consultoria - <?php echo $title;?></title>
    <meta name="robots" content="noindex,nofollow" />
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="<?php echo base_url();?>assets/multitools/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo base_url();?>assets/multitools/apple-touch-icon.png">

	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/colors.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/jquery.tipsy.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/jquery.wysiwyg.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/jquery.datatables.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/jquery.nyromodal.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/jquery.datepicker.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/jquery.fileinput.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/jquery.fullcalendar.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/jquery.visualize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/overcast/jquery-ui-1.8.16.custom.css" type="text/css" media="screen" />

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/multitools/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/multitools/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/multitools/js/functions.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/multitools/js/jquery.maskedinput-1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/multitools/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/multitools/js/jquery.ui.datepicker-pt-BR.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/fancybox/jquery.fancybox.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/fancybox/jquery.fancybox.css" media="screen" />
	<script type="text/javascript">
	function showElement(layer){
		var myLayer = document.getElementById(layer);
		if(myLayer.style.display=="none"){
			myLayer.style.display="block";
			myLayer.backgroundPosition="top";
		} else {
			myLayer.style.display="none";
		}
	}
	</script>

	<script type="text/javascript" src="<?php echo base_url();?>tinymce_pt/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>tinymce_pt/jscripts/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
	<script type="text/javascript">
		tinyMCE.init({
			// General options
	    language : "pt",
			mode : "specific_textareas",
	         editor_selector : "editor",
			theme : "advanced",
			plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

			// Theme options
	theme_advanced_buttons1:
	"code,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,cleanup,link,unlink,image,table,formatselect,fontselect,fontsizeselect,forecolor,backcolor,fullscreen",

			// Theme options
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_buttons4 : "",


			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
		 content_css : "css/content.css",
		 relative_urls : false,

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",
	    file_browser_callback : "tinyBrowser",
			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	</script>


	<link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>

	<script src="<?php echo base_url();?>assets/multitools/js/libs/modernizr-1.7.min.js"></script>




        <script src="<?php echo base_url();?>assets/js/jquery.autocomplete.js"></script>
        <link href="<?php echo base_url();?>assets/css/jquery.autocomplete.css" type="text/css" rel="stylesheet">

        <script type="text/javascript" language="javascript">

            $(document).ready(function(){

               //autocomplete inscritos ativos
               $("#inscrito_nome").blur(function(){
                    if($("#inscrito_nome").val()==''||$("#inscrito_id").val()==''){
                        $("#inscrito_nome").val('');
                        $("#inscrito_id").val('');
                    }
                    });

                $("#inscrito_nome").change().autocomplete("<?php echo site_url();?>autocomplete.php?tipo=1&nome="+$("#inscrito_nome").val(),{
                          minChars:1 //Número mínimo de caracteres para aparecer a lista
                        , matchContains: true //Aparecer somente os que tem relação ao valor digitado
                        , scrollHeight: 300 //Altura da lista dos nomes
                        , selectFirst: false //Vim o primeiro da lista selecionado
                        , mustMatch: true //Caso não existir na lista, remover o valor
                        , delay: 2 //Tempo para aparecer a lista para 0, por padrão vem 200

                    });


                   //Quando selecionar valor pegar retorno. O retorno nesse caso são: Nome|Código
                   $("#inscrito_nome").result(function(event, retorno) {
                       if (retorno==undefined)
                           $("#inscrito_id").val("");
                       else
                           $("#inscrito_id").val(retorno[1]);
                   });
                   //autocomplete inscritos ativos
                   
                   
                   
                   
                   
             //autocomplete inscritos ativos Pessoa fisica
               $("#inscrito_nome_F").blur(function(){
                    if($("#inscrito_nome_F").val()==''||$("#inscrito_id_F").val()==''){
                        $("#inscrito_nome_F").val('');
                        $("#inscrito_id_F").val('');
                    }
                    });

                $("#inscrito_nome_F").change().autocomplete("<?php echo site_url();?>autocomplete.php?tipo=3&nome="+$("#inscrito_nome_F").val(),{
                          minChars:1 //Número mínimo de caracteres para aparecer a lista
                        , matchContains: true //Aparecer somente os que tem relação ao valor digitado
                        , scrollHeight: 300 //Altura da lista dos nomes
                        , selectFirst: false //Vim o primeiro da lista selecionado
                        , mustMatch: true //Caso não existir na lista, remover o valor
                        , delay: 2 //Tempo para aparecer a lista para 0, por padrão vem 200

                    });


                   //Quando selecionar valor pegar retorno. O retorno nesse caso são: Nome|Código
                   $("#inscrito_nome_F").result(function(event, retorno) {
                       if (retorno==undefined)
                           $("#inscrito_id_F").val("");
                       else
                           $("#inscrito_id_F").val(retorno[1]);
                   });
                   //autocomplete inscritos ativos Pessoa fisica
                  
                  
                         
             //autocomplete inscritos ativos Pessoa Juridica
               $("#inscrito_nome_J").blur(function(){
                    if($("#inscrito_nome_J").val()==''||$("#inscrito_id_J").val()==''){
                        $("#inscrito_nome_J").val('');
                        $("#inscrito_id_J").val('');
                    }
                    });

                $("#inscrito_nome_J").change().autocomplete("<?php echo site_url();?>autocomplete.php?tipo=4&nome="+$("#inscrito_nome_J").val(),{
                          minChars:1 //Número mínimo de caracteres para aparecer a lista
                        , matchContains: true //Aparecer somente os que tem relação ao valor digitado
                        , scrollHeight: 300 //Altura da lista dos nomes
                        , selectFirst: false //Vim o primeiro da lista selecionado
                        , mustMatch: true //Caso não existir na lista, remover o valor
                        , delay: 2 //Tempo para aparecer a lista para 0, por padrão vem 200

                    });


                   //Quando selecionar valor pegar retorno. O retorno nesse caso são: Nome|Código
                   $("#inscrito_nome_J").result(function(event, retorno) {
                       if (retorno==undefined)
                           $("#inscrito_id_J").val("");
                       else
                           $("#inscrito_id_J").val(retorno[1]);
                   });
                   //autocomplete inscritos ativos Pessoa Juridica
            
                   
                   



               //autocomplete usuários MB ativos
               $("#instrutor_nome").blur(function(){
                    if($("#instrutor_nome").val()==''||$("#instrutor_id").val()==''){
                        $("#instrutor_nome").val('');
                        $("#instrutor_id").val('');
                    }
                    });

                $("#instrutor_nome").change().autocomplete("<?php echo site_url();?>autocomplete.php?tipo=2&nome="+$("#instrutor_nome").val(),{
                          minChars:1 //Número mínimo de caracteres para aparecer a lista
                        , matchContains: true //Aparecer somente os que tem relação ao valor digitado
                        , scrollHeight: 300 //Altura da lista dos nomes
                        , selectFirst: false //Vim o primeiro da lista selecionado
                        , mustMatch: true //Caso não existir na lista, remover o valor
                        , delay: 2 //Tempo para aparecer a lista para 0, por padrão vem 200

                    });


                   //Quando selecionar valor pegar retorno. O retorno nesse caso são: Nome|Código
                   $("#instrutor_nome").result(function(event, retorno) {
                       if (retorno==undefined)
                           $("#instrutor_id").val("");
                       else
                           $("#instrutor_id").val(retorno[1]);
                   });
                   //autocomplete usuaários MB ativos







             });

        </script>




</head>

<body>

	<div class="fixed-wraper">

	<section role="navigation">
		<header>
			<a href="<?php echo base_url();?>multitools/" title="Back to Homepage">Logo</a>
		</header>
		<section id="user-info">
			<img src="<?php echo base_url();?>assets/multitools/img/sample_user.png" alt="Sample User Avatar">
			<div>
				<a href="#" title="Account Settings and Profile Page"><?php echo $this->session->userdata('nome'); ?></a>
				<?php if($this->session->userdata('tipo')=='A'): ?>
                                    <em>Administrador</em>
                                <?php elseif($this->session->userdata('tipo')=='I'): ?>
                                    <em>Instrutor</em>
                                <?php elseif($this->session->userdata('tipo')=='C'): ?>
                                    <em>Colunista</em>
                                <?php endif; ?>
				<ul>
					<li><a class="button-link" href="<?php echo base_url();?>" title="Ir para o site" target="blank" rel="tooltip">Ir para o site</a></li>
					<li><a class="button-link" href="<?php echo base_url();?>multitools/login/sair" title="Sair" rel="tooltip">Sair</a></li>
				</ul>
			</div>
		</section>