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
		<p style="font-size:12px; margin:2; background:#EAEAEA; text-align:center; padding: 10px;"> Olá <b><?php echo $nome; ?></b>, Segue abaixo a publicação enviada pelo site da MB Consultoria.</b>. </p>

		<?php if($registro): ?>
			<div style="font-size:11px; margin:2; padding: 10px;">
				<p style="font-size:11px; margin:2; text-align:center; padding: 10px;"> <b style="font-size:12px;"><?php echo $registro->titulo; ?></b><br /> <?php echo $registro->texto; ?></p>
			</div>
		<?php endif; ?>

		<p style="font-size:12px; margin:2; background:#EAEAEA; text-align:center; padding: 10px;"> <a href="<?php echo site_url(); ?>">Visite o site da MB Consultoria</a> </p>
	</tr>


	</table>
</td>
</tr>
</table> </div> </body> </html>