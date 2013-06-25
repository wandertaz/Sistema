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
		<h1 style="font-size:22px; font-weight:normal; line-height:22px; margin:0 0 11px 0;"">Nova Solicita&ccedil;&atilde;o de Proposta Comercial</h1>
		<p style="font-size:12px; line-height:16px; margin:0;"> Seguem abaixo os dados referentes &agrave; solicita&ccedil;&atilde;o: </p>
	</tr>

	<tr>
		<td valign="top">
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Nome Fantasia: </b> <?php echo $post['nome-fantasia']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Raz&atilde;o Social: </b> <?php echo $post['razao-social']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">CNPJ: </b> <?php echo $post['cnpj']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Segmento: </b> <?php echo $post['segmento']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Tipo do Curso: </b> <?php echo $post['tipoCurso']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Nome do Curso: </b> <?php echo $post['nomeCurso']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">&Aacute;rea do Curso: </b> <?php echo $post['areaCurso']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Quantidade de Participantes: </b> <?php echo $post['qtdParticipantes']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Objetivo do Curso: </b>
			<?php foreach($post['objetivo'] as $objetivo): ?>
				<?php echo $objetivo; ?><br />
			<?php endforeach; ?>

			<?php if($post['outroObjetivo']): ?>
				<?php echo 'Outro: '.$post['outroObjetivo']; ?>
			<?php endif; ?>
		</p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Carga Hor&aacute;ria: </b> <?php echo $post['cargaHoraria']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">P&uacute;blico Alvo: </b>
		 	<?php foreach($post['publicoAlvo'] as $publico): ?>
				<?php echo $publico; ?><br />
			<?php endforeach; ?>
		 </p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Resultado Esperado: </b> <?php echo $post['resultadoEsperado']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Local de Realiza&ccedil;&atilde;o: </b> <?php echo $post['local']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">A empresa possui infra-estrutura: </b> 
                       
                    <?php foreach($post['infra'] as $infra): ?>
				<?php echo $infra; ?><br />
			<?php endforeach; ?>
			<?php if($post['outraInfra']): ?>
				<?php echo 'Outro: '.$post['outraInfra']; ?>
			<?php endif; ?>                        
		</p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Data Prevista: </b> <?php echo $post['dataInicio']; ?> <b>at&eacute;</b> <?php echo $post['dataTermino']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Hora Prevista: </b>
		<?php foreach($post['horaPrevista'] as $hora): ?>
				<?php echo $hora; ?><br />
			<?php endforeach; ?>
		</p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Contato: </b> <b>Tel</b>: <?php echo $post['tel']; ?> <b>Cel:</b> <?php echo $post['cel']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">E-mail: </b> <?php echo $post['email']; ?></p>
		<p style="font-size:12px; margin:2;"> <b style="text-transform:uppercase; color:#F7931E;">Mensagem: </b> <?php echo $post['mensagem']; ?></p>
	</tr>
	</table>
</td>
</tr>
</table> </div> </body> </html>