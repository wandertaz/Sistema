<?php 
/*
header("Content-type: application/pdf");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=lista_chamada_".sanitize_title_with_dashes($pesquisa->titulo).".pdf");
header("Pragma: no-cache");*/

?>

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


                            <h2 class="titulo-autodiagnostico">Pesquisa: <b><?php echo utf8_encode($pesquisa->titulo); ?> - Gr&aacute;ficos</b></h2>

                            <div class="autodiagnostico-pontuacao">
                            <!--<span class="pontos"><font style="font-family:'alright_sans_boldregular'"></font> 1 ponto</span>
                            <span class="descricao">sdasdsa</span>-->
                            </div>

                            <hr>
                            <!--<h2>Gr&aacute;ficos</h2>-->
                            
                            <?php if($perguntas): ?>
		<?php foreach($perguntas as $pergunta): ?>

			<?php if($pergunta->tipo == 'RAD' || $pergunta->tipo == 'CHE'): ?>
 				<?php if(isset($pergunta->opcoes) && $pergunta->opcoes): ?>	 			
                                       <div class="autodiagnostico-progresso-titulo" style="color:black;"><?php echo utf8_encode($pergunta->pergunta); ?></div>     
	 				<?php foreach($pergunta->opcoes as $opcao): ?>
                                                
                                            <div class="autodiagnostico-resultados">
                                                    <div class="autodiagnostico-progresso">
                                                        <div class="autodiagnostico-progresso-current-grafico" style="width:<?php echo calcula_porcentagem($opcao->total_respostas, $total_respostas_contatos[0]->total).'%'; ?>;"></div>
                                                        <div class="autodiagnostico-progresso-current-numero" style="position:relative; left:<?php echo calcula_porcentagem($opcao->total_respostas, $total_respostas_contatos[0]->total).'%'; ?>;pading-top:3px;color:#333;"><?php echo calcula_porcentagem($opcao->total_respostas, $total_respostas_contatos[0]->total); ?>% - <?php echo utf8_encode($opcao->opcao); ?> | <?php echo $opcao->total_respostas.' resposta(s)'; ?></div>

                                                    </div>

                                            </div>                                                
	 				<?php endforeach; ?>
                                       <br>
	 			<?php endif; ?>
                                       
                                       
                                <?php elseif($pergunta->tipo == 'P05'): ?>
                                       
	 			<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>                                             
	 				<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
                                            <div class="autodiagnostico-progresso-titulo" style="color:black;"><?php echo utf8_encode($pergunta->pergunta).'- '.utf8_encode($subpergunta->pergunta); ?></div>
                                              
						<?php for($i = 1; $i <= 5; $i++): ?>
							<?php $total_opcao = respostas_por_valor($subpergunta->id_pesquisas_perguntas, $i); ?>
                                            
                                                        <div class="autodiagnostico-resultados">
                                                              <div class="autodiagnostico-progresso">
                                                                  <div class="autodiagnostico-progresso-current-grafico" style="width:<?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas).'%'; ?>;"></div>
                                                                  <div class="autodiagnostico-progresso-current-numero" style="position:relative; left:<?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas).'%'; ?>;pading-top:3px;color:#333;"><?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas); ?>% - <?php echo utf8_encode($i); ?> | <?php echo $total_opcao.' resposta(s)'; ?></div>

                                                              </div>

                                                      </div>
                                                        
						<?php endfor; ?><br>
                                                    
                                             
	 				<?php endforeach; ?>
                                            <br>
                                       <?php endif; ?>      
                                            
                                <?php elseif($pergunta->tipo == 'P10'): ?>
                                           
                                        <?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>

                                                <?php foreach($pergunta->sub_perguntas as $subpergunta): ?>

                                                        <div class="autodiagnostico-progresso-titulo" style="color:black;"><?php echo utf8_encode($pergunta->pergunta).'- '.utf8_encode($subpergunta->pergunta); ?></div>
                                                        <?php for($i = 1; $i <= 10; $i++): ?>
                                                                <?php $total_opcao = respostas_por_valor($subpergunta->id_pesquisas_perguntas, $i); ?>
                                                                <div class="autodiagnostico-resultados">
                                                                         <div class="autodiagnostico-progresso">
                                                                             <div class="autodiagnostico-progresso-current-grafico" style="width:<?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas).'%'; ?>;"></div>
                                                                             <div class="autodiagnostico-progresso-current-numero" style="position:relative; left:<?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas).'%'; ?>;pading-top:3px;color:#333;"><?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas); ?>% - <?php echo utf8_encode($i); ?> | <?php echo $total_opcao.' resposta(s)'; ?></div>

                                                                         </div>

                                                                 </div>
                                                        <?php endfor; ?><br>
                                                <?php endforeach; ?>
                                                        <br>
                                        <?php endif; ?>
                                          
                                                        
                                        <?php elseif($pergunta->tipo == 'CLA'): ?>
	 			<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>

	 				<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>

                                                <div class="autodiagnostico-progresso-titulo" style="color:black;"><?php echo utf8_encode($pergunta->pergunta).'- '.utf8_encode($subpergunta->pergunta); ?></div>
		 				<?php for($i = 1; $i <= $pergunta->total_sub_perguntas; $i++): ?>
							<?php $total_opcao = respostas_por_valor($subpergunta->id_pesquisas_perguntas, $i); ?>

                                                        <div class="autodiagnostico-resultados">
                                                                <div class="autodiagnostico-progresso">
                                                                    <div class="autodiagnostico-progresso-current-grafico" style="width:<?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas).'%'; ?>;"></div>
                                                                    <div class="autodiagnostico-progresso-current-numero" style="position:relative; left:<?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas).'%'; ?>;pading-top:3px;color:#333;"><?php echo calcula_porcentagem($total_opcao, $subpergunta->total_respostas); ?>% - <?php echo utf8_encode($i); ?> | <?php echo $total_opcao.' resposta(s)'; ?></div>

                                                                </div>

                                                        </div>
                                                        
                                                        
                                                        
						<?php endfor; ?>
	 				<?php endforeach; ?>
		 		<?php endif; ?>  
                                       
                            <?php endif; ?><hr>
                       <?php endforeach; ?>
                      <?php endif; ?>
                         
            </div>
            
        </div>
        
        
    </body>
</html>