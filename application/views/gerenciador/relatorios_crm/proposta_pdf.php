<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
        .autodiagnostico-progresso {
        height: 25px;
        background-color: #e4e4e4;
        width: 500px;
        display: inline-block;
        /*margin:0 0 2px 0;*/
        }
        .autodiagnostico-progresso-current-grafico {
        background-color: #f7931e;
        height: 25px;
        }
        .autodiagnostico-progresso-current-numero {
        color: white;
        position: relative;
        top: -21px;
        display: inline-block;
        }
        .autodiagnostico-progresso-titulo {
        text-transform: uppercase;
        color: #c6c6c6;
        font-size: 13px;
        display: block;
        position: relative;
        }
        .autodiagnostico-pontuacao .pontos {
        color: #f7931e;
        width: 50px;
        display: inline-block;
        text-align: center;
        font-size: 15px;
        border-right: thin solid #a4a4a4;
        padding-right: 8px;
        }
        .autodiagnostico-pontuacao .descricao {
        font-size: 13px;
        color: #2c2b2b;
        text-transform: uppercase;
        width: 700px;
        display: inline-block;
        margin-left: 10px;
        }
        hr {
        display: block;
        height: 1px;
        border: 0;
        border-top: 1px solid #ccc;
        margin: 1em 0;
        padding: 0;
        }
        .autodiagnostico-resultados{padding-bottom:4px;}
        </style>
    </head>
    <body>
	
        <div style="width:990px; height:100%; background:#fff; border:0; padding:0;">

            <div id="logo" style="padding:20px"><img src="<?php echo site_url('assets/img/logo-black.png');?>">
                
            </div>

            <div id="corpo" style="color:#333; padding:10px; font-size:14px; letter-spacing:1px;">
        
	<?php if(count($registros)): ?>
	<table cellpadding="0" cellspacing="0" border="1">
		<tr>
			<th>Numero Proposta</th>
                        <th>Empresa</th>
                        <th>Nome Proposta</th>
			<th>Tipo</th>
			<th>Classifica&ccedil;&atilde;o</th>
                        <th>Data da Solicita&ccedil;&atilde;o</th>
                        <th>Data da Apresenta&ccedil;&atilde;o</th>
                        <th>Respons&aacute;vel pelo Diagn&oacute;stico</th>
                        <th>Respons&aacute;vel pela Apresenta&ccedil;&atilde;o</th>
			<th>Status</th>
			<th>Valor Inicial</th>
			<th>Valor Fechado</th>
		</tr>
                <?php 
                
                $classificacao[''] =  '';
                $status[''] =  '';
                $tipo[''] =  '';
                $colaborador_mb[''] =  '';
                
                ?>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<td><?php echo $row->id;?></td>
                                <td><?php echo $row->razao_social;?></td>
                                <td><?php echo $row->nome;?></td>
                                <td><?php echo isset($tipo[$row->tipo]) ? $tipo[$row->tipo] : '';?></td>
				<td><?php echo isset($classificacao[$row->classificacao]) ? $classificacao[$row->classificacao] : '';?></td>
				<td><?php echo br_date($row->data_solicitacao);?></td>
                                <td><?php echo (($row->data_apresentacao!= '0000-00-00') ? br_date($row->data_apresentacao) : '') ;?></td>
                                <td><?php echo isset($colaborador[$row->id_usuario_responsavel_diagnostico]) ? $colaborador[$row->id_usuario_responsavel_diagnostico] : '';?></td>
                                <td><?php echo isset($colaborador[$row->id_usuario_responsavel_apresentacao]) ? $colaborador[$row->id_usuario_responsavel_apresentacao] : '';?></td>
				<td><?php echo isset($status[$row->status]) ? $status[$row->status] : '';?></td>
                                <td><?php echo (isset($row->valor_inicial) ? (($row->valor_inicial>0) ? 'R$ '.number_format($row->valor_inicial, 2, ',', '.') : '') : '');?></td>
                                <td><?php echo (isset($row->valor_fechado) ? (($row->valor_fechado>0) ? 'R$ '.number_format($row->valor_fechado, 2, ',', '.') : '') : '');?></td>
			</tr>
                        
		<?php endforeach;?>
	</table>

	<?php endif; ?></div>
            
        </div>
        
        
    </body>
</html>