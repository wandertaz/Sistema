<html>
<body style="background:#F6F6F6; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; margin:0; padding:0;">
<div style="background:#F6F6F6; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; margin:0; padding:0;">
<?php 
//print_r($orcamento);

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
		
                <p style="font-size:12px; line-height:16px; margin:0;"> Um novo or&ccedil;amento (                     
                            
                            <?php
                            
                             if($orcamento[0]->tipo_orcamento=='AI'):
                                            echo'Auditoria Interna';
                                        elseif($orcamento[0]->tipo_orcamento=='PB'):
                                            echo'Orcamento On Line PBQP-h';
                                        elseif($orcamento[0]->tipo_orcamento=='GA'):
                                            echo 'Sistema Gestão Ambiental ISO 14001';
                                        elseif($orcamento[0]->tipo_orcamento=='SQ'):
                                            echo 'Sistema Gestão da Qualidade ISO 9001';
                                       elseif($orcamento[0]->tipo_orcamento=='GS'):
                                           echo'Sistema Gestão Responsabilidade Social';
                                       elseif($orcamento[0]->tipo_orcamento=='SS'):
                                           echo 'Sistema Saúde e Segurança';
                                       elseif($orcamento[0]->tipo_orcamento=='TR'):
                                           echo'Treinamento';
                                        elseif($orcamento[0]->tipo_orcamento=='OP'):
                                           echo'Orçamento Personalizado';
                                       endif;
                                
                            
                            
                            
                            ?>) foi gerado no dia (<?php echo br_date($orcamento[0]->created); ?>) e esta presente na sua &aacute;rea restrita<br /></p>
			
                        <p style="font-size:12px; line-height:16px; margin:0;">Empresa: <?php echo($orcamento[0]->nome_empresa)?></p>
                        <p style="font-size:12px; line-height:16px; margin:0;">Respons&aacute;vel: <?php echo($orcamento[0]->nome_responsavel)?></p>
                       <p style="font-size:12px; line-height:16px; margin:0;">Email: <?php echo($orcamento[0]->email_resposta)?></p>
                         <p style="font-size:12px; line-height:16px; margin:0;">Valor: R$ <?php echo($orcamento[0]->valor_orcamento)?></p>
	</tr>          

	<tr>
		<td valign="top">
                    <p style="font-size:12px; line-height:16px; margin:0;"> Voc&ecirc; pode avaliar o or&ccedil;amento na sua &aacute;rea restrita no site da MB Consultoria</p>
			
	</tr>

	</table>
</td>
</tr>
</table> </div> </body> </html>