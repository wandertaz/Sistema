<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Exercício - Gerenciamento de Projetos</title>

<style>
body { font-family:Arial, Helvetica, sans-serif; font-size:12px; color:black; }
h1{ font-size:16px; font-weight:bold; color:black;}
.btn-salvar{ width:100px; background-color:#F7931E; padding:8px; color:black; float:left;}
.btn-proximo{ width:100px; background-color:#F7931E; padding:8px; color:black; float:right;}
</style>

</head>
<?php 
$exercicio=$parametros['id_exercicio'];
$curso=$parametros['curso_id'];
$tipo_curso=$parametros['tipo_curso'];
//print_r($parametros);
//exit();

?>
<body>
<?php if($fimexercicio==false): ?>
<h1>Exercício - Questão <?php echo $perguntasrespondidas+1;?></h1>

<?php echo $pergunta[0]->pergunta;?>
<p>&nbsp;</p>
<form action="<?php echo site_url();?>saladeaula/fazerexercicio/<?php echo $exercicio;?>/<?php echo $curso;?>/<?php echo $tipo_curso;?>" method="post" name="form">
<table width="100%">
   <?php foreach ($alternativas as $item):?>
    <tr>
      <td>
          <label>
              <input type="radio" name="alternativa" value="<?php echo $item->id ;?>" id="RadioGroup1_0" />
              <?php echo $item->resposta ;?>
          </label></td>
    </tr>
  <?php endforeach; ?>
  
</table>
    <input type="hidden" name="id_exercicio" value="<?php echo $pergunta[0]->exercicio_id ;?>" id="RadioGroup1_0" />
<p>&nbsp; </p>

<div id="opcoes">
   <!-- <a href="<?php echo site_url();?>" class="btn-salvar">Salvar</a>
<a href="<?php echo site_url();?>saladeaula/fazerexercicio/<?php echo $pergunta[0]->exercicio_id;?>" class="btn-proximo">Próximo</a>
-->
   
    <input type="submit" name="Proximo" value="Próximo" class="btn-proximo">
</form>
</div>
<?php else: ?>
<h1>Exercício - Resultado </h1>
<?php 
 //print_r($finalizando);

?>
<p>Parabéns! Você concluiu o exercício com sucesso. A pontuação obtida foi <b><?php echo $finalizando['nota'];?>/<?php echo $finalizando['valor'];?></b>.</p>
<div id="opcoes">
  
  <a href="javascript:parent.jQuery.fancybox.close();" class="btn-proximo">Fechar</a>
</div>
    
    
</form>
</div>
<?php endif; ?>
</body>
</html>
