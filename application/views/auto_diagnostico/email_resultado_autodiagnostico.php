<html>
<body style="background:#F6F6F6; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; margin:0; padding:0;">
<div style="background:#F6F6F6; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; margin:0; padding:0;">

<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
		<td align="center" valign="top" style="padding:20px 0 20px 0">
			<table bgcolor="#FFFFFF" cellspacing="0" cellpadding="10" border="0" width="650" style="border:1px solid #E0E0E0;">
				<!-- [ header starts here] -->
				<tr>
					<td valign="top"><a href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo-black.png" alt="" style="margin-bottom:10px;" border="0"/></a></td>
				</tr>

	<!-- [ middle starts here] -->
	<tr>
		<td valign="top">
		<h1 style="font-size:22px; font-weight:normal; line-height:22px; margin:0 0 11px 0; color:#F7931E; text-transform:uppercase"><?php echo utf8_decode($autodiagnostico->nome); ?></h1>
		<p style="font-size:12px; line-height:16px; margin:0;"> Segue abaixo o resultado do autodiagn&oacute;stico.</p>
	</tr>

	<tr>
		<td valign="top">
		<p style="font-size:12px; margin:2; background:#EAEAEA; text-align:center; padding: 10px;"> <b style="text-transform:uppercase; color:#F7931E; font-size:22px;"><?php echo $pontuacao_obtida; ?> pontos</b> <b style="font-size:16px;"> - <?php echo utf8_decode($resultado_obtido); ?></b></p>
	</tr>

	<tr>
		<td valign="top">
		<p style="font-size:12px; line-height:16px; margin:0;">O resultado do autodiagn&oacute;stico tamb&eacute;m ficar&aacute; dispon&iacute;vel na sua &aacute;rea restrita. Se voc&ecirc; tiver qualquer d&uacute;vida, fique &agrave; vontade para nos enviar um email.</p>
	</tr>

	</table>
</td>
</tr>
</table> </div> </body> </html>