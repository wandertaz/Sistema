<?php

header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=lista_chamada_".sanitize_title_with_dashes($pesquisa->titulo).".xls");
header("Pragma: no-cache");

?>

<table border="solid">
	<tr>
		<td>Pesquisa: <b><?php echo utf8_decode($pesquisa->titulo); ?></b></td>
	</tr>
	<tr></tr>
</table>

<table border="solid">
	<?php if($perguntas): ?>
		<?php foreach($perguntas as $pergunta): ?>

			<?php if($pergunta->tipo == 'RAD' || $pergunta->tipo == 'CHE'): ?>
 				<?php if(isset($pergunta->opcoes) && $pergunta->opcoes): ?>
	 				<tr>
	 					<td><?php echo utf8_decode($pergunta->pergunta); ?></td>
	 					<td>Quantitativo</td>
	 					<td>Percentual</td>
	 				</tr>

	 				<?php foreach($pergunta->opcoes as $opcao): ?>
						<tr>
							<td><?php echo utf8_decode($opcao->opcao); ?></td>
							<td><?php echo $opcao->total_respostas; ?></td>
							<td><?php echo calcula_porcentagem($opcao->total_respostas, $total_respostas_contatos[0]->total); ?></td>
						</tr>
	 				<?php endforeach; ?>

	 			<?php endif; ?>
	 		<?php elseif($pergunta->tipo == 'P05'): ?>
	 			<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
 					<tr>
	 					<td><?php echo utf8_decode($pergunta->pergunta); ?></td>
	 				</tr>
	 				<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
						<tr>
		 					<td><?php echo utf8_decode($subpergunta->pergunta); ?></td>
		 					<td>Quantitativo</td>
		 					<td>Percentual</td>
		 				</tr>
						<?php for($i = 1; $i <= 5; $i++): ?>
							<?php $total_opcao = respostas_por_valor($subpergunta->id_pesquisas_perguntas, $i); ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $total_opcao; ?></td>
								<td><?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas); ?></td>
							</tr>
						<?php endfor; ?>
	 				<?php endforeach; ?>
		 		<?php endif; ?>
		 	<?php elseif($pergunta->tipo == 'P10'): ?>
	 			<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
 					<tr>
	 					<td><?php echo utf8_decode($pergunta->pergunta); ?></td>
	 				</tr>
	 				<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
						<tr>
		 					<td><?php echo utf8_decode($subpergunta->pergunta); ?></td>
		 					<td>Quantitativo</td>
		 					<td>Percentual</td>
		 				</tr>
						<?php for($i = 1; $i <= 10; $i++): ?>
							<?php $total_opcao = respostas_por_valor($subpergunta->id_pesquisas_perguntas, $i); ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $total_opcao; ?></td>
								<td><?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas); ?></td>
							</tr>
						<?php endfor; ?>
	 				<?php endforeach; ?>
		 		<?php endif; ?>
		 	<?php elseif($pergunta->tipo == 'CLA'): ?>
	 			<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
 					<tr>
	 					<td><?php echo utf8_decode($pergunta->pergunta); ?></td>
	 				</tr>
	 				<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
 						<tr>
		 					<td><?php echo utf8_decode($subpergunta->pergunta); ?></td>
		 					<td>Quantitativo</td>
		 					<td>Percentual</td>
		 				</tr>
		 				<?php for($i = 1; $i <= $pergunta->total_sub_perguntas; $i++): ?>
							<?php $total_opcao = respostas_por_valor($subpergunta->id_pesquisas_perguntas, $i); ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $total_opcao; ?></td>
								<td><?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas); ?></td>
							</tr>
						<?php endfor; ?>
	 				<?php endforeach; ?>
		 		<?php endif; ?>
	 		<?php endif; ?>
	 		<tr></tr>
		<?php endforeach; ?>
	<?php endif; ?>
</table>