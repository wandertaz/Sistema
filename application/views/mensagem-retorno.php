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
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/estilos.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fontes.css">
        <script src="<?php echo base_url(); ?>assets/js/vendor/modernizr-2.6.2.min.js"></script>



    </head>
    <body>
        <h3><?php echo $titulo ?></h3>


        <?php echo $msg ?>

        <?php if ($sucesso == 1): ?>
            <!--<a href="javascript:self.jQuery.fancybox.prev();">Voltar</a>-->
            <?php if ($titulo != 'CANDIDATURA\VAGA'): ?>
                <script>

                    var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
                    console.log(is_chrome);

                    if(is_chrome == false){
                        document.write("<a href='javascript:parent.history.back(-1);' id='#voltar'>Voltar</a>");
                    }else{

                        document.write("<a href='javascript:parent.jQuery.fancybox.prev();' id='#voltar'>Voltar</a>");

                    }
                </script>
            <?php endif; ?>

        <?php endif; ?>

        <a href="javascript:parent.jQuery.fancybox.close();">Fechar</a>