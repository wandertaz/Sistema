<html>
    <head>
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
                <!--<h1><b>MB Consultoria</b></h1>-->
            </div>

            <div id="corpo" style="color:#333; padding:10px; font-size:14px; letter-spacing:1px;">


                            <h2 class="titulo-autodiagnostico">Resultado <?php echo (retorna_tipos_autodiagnosticos($autodiagnostico->tipos_autodiagnosticos_id_tipo_autodiagnostico));?> - <?php echo $autodiagnostico->nome;?></h2>

                            <div class="autodiagnostico-pontuacao">
                            <span class="pontos"><font style="font-family:'alright_sans_boldregular'"><?php echo $pontuacao_obtida; ?></font> <?php echo $pontuacao_obtida>1?'pontos':'ponto'; ?></span>
                            <span class="descricao"><?php echo ($resultado_obtido); ?></span>
                            </div>

                            <hr>

                            <h2>Gr&aacute;fico</h2>

                            <?php foreach($grupos as $grupo): ?>
                            <!--  Repetir esse bloco abaixo para cada resultado -->
                            <?php
                                $left = $grupo->porcentagem - 7;
                                if($left < 0){
                                    $left = 0;
                                }
                            ?>

                            <div class="autodiagnostico-progresso-titulo" style="color:black;"><?php echo ($grupo->nome_grupo); ?></div>
                            <div class="autodiagnostico-resultados">
                                    <div class="autodiagnostico-progresso">
                                        <div class="autodiagnostico-progresso-current-grafico" style="width:<?php echo $grupo->porcentagem.'%';?>;"></div>
                                        <div class="autodiagnostico-progresso-current-numero" style="position:relative; left:<?php echo $left.'%';?>;pading-top:3px;color:#333;"><?php echo $grupo->porcentagem.'%';?></div>
                                        
                                    </div>
                                    <br/>
                                    <br/>
                            </div>
                            <?php endforeach; ?>
                            
              <div style="font-size:13px; color:#333;">
                <br /><br /><br />
                O resultado do autodiagnóstico também ficará disponível na sua área restrita. Se você tiver qualquer dúvida, fique à vontade para nos enviar um email.<br /><br />
                <b>MB Consultoria</b> - Av. Constantino Nery , <?php echo ('nº');?> 2789 , sala 1006 a 1008 - Ed. Empire Center - CEP 69050-002 - Chapada / Manaus / Amazonas - Tel: +55 (92) 3656-2452 - Telefax: +55 (92) 3656-5184 - E-mail: mb@netmb.com.br</div>
                              
            </div>
        </div>
    </body>
</html>