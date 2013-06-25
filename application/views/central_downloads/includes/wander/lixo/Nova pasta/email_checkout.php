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
		<h1 style="font-size:22px; font-weight:normal; line-height:22px; margin:0 0 11px 0;"">Ol&aacute;, <?php echo $nome ; ?> </h1>
		<p style="font-size:12px; line-height:16px; margin:0;"> Obrigado por comprar na MB Consultoria. Se voc&ecirc; tiver qualquer d&uacute;vida, fique &agrave; vontade para nos enviar um email. </p>
		<p style="font-size:12px; line-height:16px; margin:0;">Esta &eacute; uma confirma&ccedil;&atilde;o do seu pedido. Agradecemos a confian&ccedil;a.</p>
	</tr>

	<?php if($carrinho && !empty($carrinho)): ?>
		<tr>
			<td>
			<h2 style="font-size:18px; font-weight:normal; margin:0;">Seu pedido</h2>
			</td>
		</tr>

		<tr>
		<td>
				<table cellspacing="0" cellpadding="10">
		      <thead style=" border-bottom:1px solid #3e3f3f; float:left;">
		          <tr>
		            <th width="608" align="left">DESCRIÇÃO DOS PRODUTOS</th>
		            <th width="100">Pre&ccedil;o</th>
		          </tr>
		      </thead>
		      <tbody style="float:left;">
		      <?php $total = 0; ?>
		      <?php foreach($carrinho as $item): ?>
			      <tr>
				        <td width="608"><b style="text-transform:uppercase; font-size:12px; color:#F7931E;"><?php echo utf8_decode($item['titulo']); ?></b>
				        <?php if($item['turma_id']): ?>
				        	<p style="font-size:11px; color:#F7931E;">Turma: <?php echo br_date($item['turma_data']); ?></p>
				        <?php endif; ?>
				        </td>
				        <td width="100" align="center">R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?></td>
				  </tr>
				  <?php $total += $item['valor']; ?>
				<?php endforeach; ?>

				<tr>
					<td width="100"><b style="text-transform:uppercase; font-size:14px; color:#F7931E;">TOTAL</b></td>
					<td width="100"><b style="text-transform:uppercase; font-size:14px;">R$ <?php echo number_format($total, 2, ',', '.'); ?></b></td>
				  </tr>
		      </tbody>
			</table>

		</td>

		</tr>
	<?php endif; ?>

	<tr>
		<td bgcolor="#EAEAEA" align="center" style="background:#EAEAEA; text-align:center;"><center><p style="font-size:12px; margin:0;">Obrigado! <strong></strong></p></center></td>
	</tr>
	</table>
</td>
</tr>
</table> </div> </body> </html>