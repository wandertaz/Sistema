<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>

<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>


          <?php //include("includes/banner-interna.php"); ?>

            <div class="content">

            <div class="menuAreaRestrita">
            <h1>Área Restrita</h1>
           <!-- <ul>
            	<li><a href="#">Cursos</a></li>
                <li class="selected"><a href="#">Auto Diagnóstico</a></li>
                <li><a href="#">Banco de Talentos</a></li>
                <li><a href="#">Central de Downloads</a></li>
                <li><a href="#">Gerenciamento de Usuários</a></li>
                <li><a href="#">Armazenamento na Nuvem</a></li>
            </ul>-->
                <?php
                    include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
                ?>
            </div>

              <div class="content-interna" style="width:990px; background:white;">

                <div class="left-cursos equalH-meus-cursos">
                  <div class="miolo-interna">

                 <?php include("includes/auto_diagnostico/menu_left.php"); ?>
                      
                  </div>
                </div>                
				<div class="centerCursos equalH-meus-cursos" style="width:784px;">
					<?php if(isset($pontuacao_obtida) && isset($resultado_obtido) && $grupos): ?>
                                    <h1 class="titulo-autodiagnostico">Resultado <?php echo retorna_tipos_autodiagnosticos($autodiagnostico->tipos_autodiagnosticos_id_tipo_autodiagnostico);?> - <?php echo $autodiagnostico->nome;?></h1>

						<div class="autodiagnostico-pontuacao">
						<span class="pontos"><font style="font-family:'alright_sans_boldregular'"><?php echo $pontuacao_obtida; ?></font> pontos</span>
						<span class="descricao"><?php echo $resultado_obtido; ?></span>
						</div>

						<hr>

                 		<h1>Gráfico</h1>

		                 <?php foreach($grupos as $grupo): ?>
							<!--  Repetir esse bloco abaixo para cada resultado -->
							<div class="autodiagnostico-resultados">
								<!--<h1>4.1</h1>-->
								<div class="autodiagnostico-progresso">
									<div class="autodiagnostico-progresso-current-grafico" style="width:<?php echo $grupo->porcentagem.'%';?>;"></div>
									<div class="autodiagnostico-progresso-current-numero" style="position:relative; left:<?php echo $grupo->porcentagem.'%';?>;"><?php echo $grupo->porcentagem.'%';?></div>
									<div class="autodiagnostico-progresso-titulo"><?php echo $grupo->nome_grupo; ?></div>
								</div>
							</div>
						<?php endforeach; ?>
                 		<hr>

		                 <h1>Opções</h1>
		                 <div class="autodiagnostico-resultado-opcao">
		                 <img src="<?php echo base_url(); ?>assets/img/icone-imprimir.png">Você pode imprimir esse resultado.
		                 <a href="<?php echo site_url('area_restrita_autodiagnosticos/ver_resultado/'.$inscricao_id.'/'.$acesso['tipoacesso'].'/true'); ?>"><span class="botao-laranja-autodiagnostico">Imprimir Resultado</span><span class="ponta-botao-laranja"></span></a>
		                 </div>

		                 <div class="autodiagnostico-resultado-opcao">
		                 <img src="<?php echo base_url(); ?>assets/img/icone-gerar-pdf.png">
		                 Você pode gerar um pdf do resultado.
		                 <a href="<?php echo site_url('area_restrita_autodiagnosticos/ver_resultado/'.$inscricao_id.'/'.$acesso['tipoacesso'].'/true'); ?>"><span class="botao-laranja-autodiagnostico">Gerar PDF</span><span class="ponta-botao-laranja"></span></a>
		                 </div>

		                 <div class="autodiagnostico-resultado-opcao">
		                 <img src="<?php echo base_url(); ?>assets/img/icone-enviar-email.png">
		                 Você pode enviar o resultado por email.
		                 <a href="<?php echo site_url('area_restrita_autodiagnosticos/envio_email_resultado/'.$inscricao_id.'/'.$acesso['tipoacesso']); ?>"><span class="botao-laranja-autodiagnostico">Enviar por email</span><span class="ponta-botao-laranja"></span></a>
		                 </div>

					<?php else: ?>
						Não foi possível exibir o resultado.
					<?php endif; ?>
                </div>


              </div>


            </div>

<?php
	//include("includes/rodape.php");
?>

<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
?>