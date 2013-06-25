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


                            <h2 class="titulo-autodiagnostico">Pesquisa: <?php echo utf8_encode($pesquisa->titulo); ?> - Perguntas Abertas</h2>

                            <div class="autodiagnostico-pontuacao">
                            </div>

                            <hr>
							<?php if (isset($perguntas_respostas)) :?>
                            <?php foreach($perguntas_respostas as $perguntas): ?>
                           
                                   <div class="autodiagnostico-progresso-titulo" style="color:black;"><?php echo utf8_encode($perguntas['pergunta']); ?></div>
                                   <?php foreach($perguntas['respostas'] as $resposta): ?>
                                   <div class="autodiagnostico-resultados">
                                           <div class="autodiagnostico-progresso">
                                                       <?php echo utf8_encode($resposta['resposta']); ?>

                                           </div>
                                           
                                           <br/>
                                   </div>
                                   <?php endforeach; ?>
                            <?php endforeach; ?>
							<?php else: ?>
							<div class="autodiagnostico-progresso-titulo" style="color:black;">Nenhuma pergunta aberta cadastrada</div>
                            <?php endif; ?>
                            
              <div style="font-size:13px; color:#333;">
                <br /><br /><br />
                
                <b>MB Consultoria</b> - Av. Constantino Nery , <?php echo utf8_encode('nº');?> 2789 , sala 1006 a 1008 - Ed. Empire Center - CEP 69050-002 - Chapada / Manaus / Amazonas - Tel: +55 (92) 3656-2452 - Telefax: +55 (92) 3656-5184 - E-mail: mb@netmb.com.br</div>
                              
            </div>
        </div>
    </body>
</html>