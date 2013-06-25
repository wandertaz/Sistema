<?php

header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=Relatorio_Inscricoes_Autodiagnosticos_Pagas.xls");
header("Pragma: no-cache");

?>

<table border="solid">
	<tr>
		<td><?php echo utf8_decode('Relatório: <b>Inscrições Pagas</b>');?></td>
	</tr>
	<tr></tr>
        <tr></tr>
        <tr></tr>
</table>
<table cellpadding="0" cellspacing="0" border="solid">
		<tr>
			<!--<th class="marcado-th"><a href="#">Nome</a></th>
                        <th><?php //echo utf8_decode('Autodiagnóstico');?></th>
			<th><?php //echo utf8_decode('Data de Inscrição');?></th>
			<th>Status</th>   -->  
                    <th>Nome</th>
                    <th>Quantidade Vendas</th>
			
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<!--<td><?php //echo utf8_decode($row->inscrito);?></td>
				<td><?php //echo utf8_decode($row->autodiagnostico);?></td>
				<td><?php //echo br_date($row->data_inscricao);?></td>
				<td><?php //echo $status[$row->status];?>
				<?php //echo $row->status == 'F' ? ' : '.$row->resultado.' pontos' : '';?>
				</td>-->
                            <td><?php echo utf8_decode($row->nome);?></td>
                            <td><?php echo $row->qtd;?></td>
				
			</tr>
		<?php endforeach;?>
	</table>