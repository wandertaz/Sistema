<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Certificado MB Consultoria</title>
</head>
<body style="width:100%; height:auto; margin:0px; padding:0px;">
    
            <div id="geral" style="width:842px; height:595px; margin:90px auto; background:url(<?php echo base_url();?>assets/img/bg-certificado.jpg) no-repeat; border:1px solid #FFF;">
   
           
    
  <div class="conteudo" style="width:842px; height:180px; margin:auto;">
  
    <p style="font:21px Arial;  text-align:center;  margin:180px 0 0 0;">Conferimos a <?php echo $usuario;?></p>
    <!--<h1 style="font:30px Arial; text-align:center; margin:3px 0;"></h1>-->
    <p style="font:21px Arial;  text-align:center;  margin:7px 0;"> o certificado de participação no "<?php echo $curso;?>",</p> 
   
 <?php if ($tipo=="EL"): ?>
     <p style="font:21px Arial;  text-align:center;  margin:7px 0;">realizado na modalidade e-learning (à distância), </p>
    <p style="font:21px Arial;  text-align:center;  margin:7px 0;">através do Portal da MB Consultoria.</p> 
    
    <?php else: ?>   
    <p style="font:21px Arial;  text-align:center;  margin:7px 0;">completando a carga horária de <?php //echo $carga_horaria;?> horas,</p>
    <p style="font:21px Arial;  text-align:center;  margin:7px 0;">realizados entre os dias. <?php echo br_date($data_de_inicio);?> à <?php echo br_date($data_de_conclusao);?>.</p>    
    <?php endif; ?>

    <p style="font:21px Arial;  text-align:center;  margin:7px 0 0 0;"><?php echo br_date_time($data_de_conclusao); ?></p>
   
   </div>
  
  <div class="assinaturas" style="width:100%; height:auto;">
  
    <table width="600px" align="center" border="0" cellspacing="10">
      <tr>
        <td width="300px" align="center">
          <img src="<?php echo base_url();?>assets/img/assinaturas/exemplo-de-assinatura.jpg" alt="Nome" border="0" />
          <hr style="border: none; background: none; border-top: 1px #999 solid; width: 300px;" />
          <span style="font-family: Arial; font-size: 12px; margin: 0; padding: 0; text-align: center;">Instrutor(a)</span>
          <h2 style="font-family: Arial; font-size: 15px; margin: 0; padding: 0;"><?php //echo  "NomeDoCertificado1";?></h2>
          <span style="font-family: Arial; font-size: 12px; margin: 0; padding: 0; text-align: center;"><?php //echo "Cargo1";?></span><br />
          
        </td>
        <td width="300px" align="center">
          <img src="<?php echo base_url();?>assets/img/assinaturas/exemplo-de-assinatura.jpg" alt="Nome" border="0" />
          <hr style="border: none; background: none; border-top: 1px #999 solid; width: 300px;" />
          <span style="font-family: Arial; font-size: 12px; margin: 0; padding: 0; text-align: center;">Gestora de Treinamentos</span>
          <h2 style="font-family: Arial; font-size: 15px; margin: 0; padding: 0;"><?php // echo  "NomeDoCertificado1";?></h2>
          <span style="font-family: Arial; font-size: 12px; margin: 0; padding: 0; text-align: center;"><?php //echo  "Cargo2";?></span><br />
          
        </td>
      </tr>

    </table>
     <p style="font:21px Arial;  text-align:center;  margin:7px 0;">Av. Constantino Nery, 2789 – Salas 1006 a 1008 – B.Chapada – Manaus/AM</p>
     <p style="font:21px Arial;  text-align:center;  margin:7px 0;">Telefone:  +55 (92) 3656-2452 Site: www.netmb.com.br E:mail:mb@netmb.com.br</p> 
    <p style="font:11px Arial;  text-align:center;  margin:7px 0;">Código de autenticação: <?php echo "Codigo"; ?></p>
    
  </div>
  
</div>
</body>
</html>