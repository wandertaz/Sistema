<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>MB Consultoria - Imprimir Mensagem</title>

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.printpage.js"></script>
<script>
	$(document).ready(function() {
    	$('span.print').printPage();
	});
</script>

<style>
	body{
		font-size:12px;
		font-family:Arial, Helvetica, sans-serif;	
	}
	
	h1{ font-size:12px; width:100%; border-bottom:thin solid #ccc;}
	
	.msgCorpo { font-size:12px; color:#111; }
	
	#mensagem { border-bottom:thin solid #999; padding:10px; margin-top:10px; display:block; }
	
	.print a{ font-size:12px; color:black; font-weight:bold; margin-left:10px; margin-bottom:0px;  }
</style>

</head>

<body>
<span class="print">Imprimir</span>
<?php $cadastrador=$mensagens[0]->tipo_remetente=='A'? $mensagens[0]->inscritos:$mensagens[0]->usuario?>
<div id="mensagem">
    <?php if($mensagens[0]->tipo_remetente=='A'):?>
        <h1>De: Aluno <?php echo$cadastrador;?> - <?php echo br_date($mensagens[0]->created);?></h1>
     <?php else:?>
        <h1>De: Professor <?php echo$cadastrador;?> - <?php echo br_date($mensagens[0]->created);?></h1>
     <?php endif;?>
    <div class="msgCorpo">
        <?php echo$mensagens[0]->texto;?>
    </div>

</div>

<?php foreach ($mensagem_resposta as $item2): ?>
    <div id="mensagem">
        <?php if($item2->tipo_remetente=='A'):?>
            <h1>De: Aluno <?php echo$item2->inscritos ;?> - <?php echo br_date_time($item2->created) ;?></h1>
        <?php else:?>
            <h1>De: Professor <?php echo$item2->usuario ;?> - <?php echo br_date_time($item2->created)?></h1>
        <?php endif;?>

        <div class="msgCorpo">
            <?php echo $item2->texto?>
        </div>

    </div>
<?php endforeach;?>


</body>
</html>