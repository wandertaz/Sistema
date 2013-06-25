<html>
<body style="background:#F6F6F6; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; margin:0; padding:0;">
<div style="background:#F6F6F6; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; margin:0; padding:0;">
<?php 
//print_r($lembretes);

?>
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
		<h1 style="font-size:22px; font-weight:normal; line-height:22px; margin:0 0 11px 0; color:#F7931E; text-transform:uppercase">Ol&aacute;, MB Consultoria <?php //echo utf8_decode($usuario); ?></h1>
		
                <p style="font-size:12px; line-height:16px; margin:0;">Aten&ccedil;&atilde;o para um  novo lembrete           
                            
                    foi gerado no dia (<?php echo date('d/m/Y'); ?>) com 7 dias de anteced&ecirc;ncia a rela&ccedil;&atilde;o de  anivers&aacuterios e datas especias.<br /></p>
			
                <table bgcolor="#FFFFFF" cellspacing="0" cellpadding="10" border="1" width="630" style="border:2px solid #E0E0E0;">
                          <tr>
                             <th style="font-size:12px; line-height:16px; margin:0;">Data</th>
                             <th style="font-size:12px; line-height:16px; margin:0;">Ação</th>
                            <th style="font-size:12px; line-height:16px; margin:0;">Descrição</th>
                            <th style="font-size:12px; line-height:16px; margin:0;">Responsável MB</th>
                            <th style="font-size:12px; line-height:16px; margin:0;">Empresa</th>
                            <th style="font-size:12px; line-height:16px; margin:0;">Contato</th>
                          </tr>
                          
                     <?php foreach ($lembretes as $itens):?>     
                           <tr>
                                <td style="font-size:12px; line-height:16px; margin:0;"><?php echo br_date($itens->data);?></td>
                                <td style="font-size:12px; line-height:16px; margin:0;"><?php echo $itens->tipo;?></td>
                                <td style="font-size:12px; line-height:16px; margin:0;"><?php echo $itens->descricao;?></td>
                                <td style="font-size:12px; line-height:16px; margin:0;"><?php echo $itens->MB;?></td>
                                <td style="font-size:12px; line-height:16px; margin:0;"><?php echo $itens->empresa;?></td>
                                <td style="font-size:12px; line-height:16px; margin:0;"><?php echo $itens->contato;?></td>
                          </tr>
                    <?php endforeach;?>
                          
               </table>
	</tr>          

	<tr>
		<td valign="top">
                    <p style="font-size:12px; line-height:16px; margin:0;"> Este e-mail e enviado apenas para lembra -los de alguns eventos importantes</p>
			
	</tr>

	</table>
</td>
</tr>
</table> </div> </body> </html>