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
		<h1 style="font-size:22px; font-weight:normal; line-height:22px; margin:0 0 11px 0; color:#F7931E; text-transform:uppercase">Ol&aacute;, <?php echo utf8_decode($usuario); ?></h1>
		<?php if($dados['tipo'] == 'novo'): ?>
			<p style="font-size:12px; line-height:16px; margin:0;"> Um novo arquivo foi cadastrado na sua &aacute;rea restrita - Armazenamento em Nuvem: <br /><b><?php echo $dados['registro']->titulo; ?></b> - Vers&atilde;o 1.<?php echo $dados['registro']->numero_versao; ?> (<?php echo br_date($dados['registro']->created); ?>)</p>
			<p style="font-size:12px; line-height:16px; margin:0;">Descri&ccedil;&atilde;o: <?php echo $dados['registro']->descricao_armazenamento; ?></p>
		<?php else: ?>
			<p style="font-size:12px; line-height:16px; margin:0;"> Um arquivo foi atualizado na sua &aacute;rea restrita - Armazenamento em Nuvem: <br /> <b><?php echo $dados['registro']->titulo; ?></b> - Vers&atilde;o 1.<?php echo $dados['registro']->numero_versao; ?> (<?php echo br_date($dados['registro']->created); ?>)</p>
			<p style="font-size:12px; line-height:16px; margin:0;">Descri&ccedil;&atilde;o: <?php echo $dados['registro']->descricao_armazenamento; ?></p>
		<?php endif; ?>
	</tr>

	<tr>
		<td valign="top">
			<p style="font-size:12px; line-height:16px; margin:0;"> Voc&ecirc; pode fazer o download do arquivo na sua &aacute;rea restrita no site da MB Consultoria, ou pelo link abaixo: </p>
			<p style="font-size:12px; margin:2; background:#EAEAEA; padding: 10px;"><a href="<?php echo site_url('armazenamento_nas_nuvens/functionUp_/'.$dados['registro']->id_armazenamento.'/'.$dados['registro']->chave); ?>">Download</a></p>
	</tr>

	</table>
</td>
</tr>
</table> </div> </body> </html>