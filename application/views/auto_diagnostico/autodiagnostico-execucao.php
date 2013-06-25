<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>

<script type="text/javascript">
	function envia_questionario(acao){
		if(acao == 'salvar'){
			$('#acao').val('salvar');
			$('.opcao').removeClass("required");
			$('#form_questionario').submit();
		}
		else{
			$("#form_questionario").validate();
			$('#acao').val('enviar');
			if($("#form_questionario").valid() == false){
				alert('Você precisa responder todas as perguntas para enviar e finalizar o questionário.');
			}
			else{
				$('#form_questionario').submit();
			}
		}
	}
</script>
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

				 <h1 class="titulo-autodiagnostico"><?php echo $autodiagnostico->nome; ?></h1>
				<div class="instrucoes-autodiagnostico">
					<span class="alert-black">Marque apenas uma das quatro opções abaixo, que acredite refletir a
					realidade de sua organização:</span>
					<br/>
					<div style="margin-left:36px; margin-top:-10px;">
						<span class="legenda-autodianostico">
						<font class="nota">4</font>
						<font class="instrucoes">Totalmente aplicado / executado e documentado</font>
						</span>

						<span class="legenda-autodianostico" style="background-color:#0a9f03;">
						<font class="nota">3</font>
						<font class="instrucoes">Parcialmente aplicado / executado e documentado</font>
						</span>

						<span class="legenda-autodianostico" style="background-color:#f7a31e;">
						<font class="nota">2</font>
						<font class="instrucoes">Executado na prática, mas não é documentado</font>
						</span>

						<span class="legenda-autodianostico" style="background-color:#ff3600;">
						<font class="nota">1</font>
						<font class="instrucoes">Não é documentado, nem aplicado / executado</font>
						</span>
					</div>
				</div>
				<br/><br/>
				<span class="seta-left-autodiagnostico"></span>
				<span class="seta-right-autodiagnostico"></span>

			<div id="abas-pai" style="overflow:hidden;">
				<?php if($grupos): ?>
					<ul id="abas">
						<?php foreach($grupos as $grupo): ?>
							<?php if($grupo->perguntas): ?>
								<li><a href="#" name="#abas<?php echo $grupo->id_grupo_pergunta; ?>"><?php echo $grupo->nome_grupo; ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>


			<form action="<?php echo site_url('area_restrita_autodiagnosticos/salvar_questionario/'.$inscricao_id.'/'.$acesso['tipoacesso']); ?>" method="POST" id="form_questionario">
			  <div id="content">

			 <?php foreach($grupos as $grupo): ?>
			 	<?php if($grupo->perguntas): ?>
				 <div id="abas<?php echo $grupo->id_grupo_pergunta; ?>">
					<table class="tabela-execucao-autodiagnostico">
						<?php $cont = 1; ?>
						<?php foreach($grupo->perguntas as $pergunta): ?>
							<tr>
								<td class="numeracao-pergunta"><?php echo retorna_numero_romano($cont); ?></td>
								<td class="pergunta"><?php echo $pergunta->pergunta; ?>
								<?php if($pergunta->nota): ?>
									<span class="dica-pergunta">Nota: <?php echo $pergunta->nota; ?></span>
								<?php endif; ?>
								</td>
								<td class="nota">
								<span class="resposta_4">4</span><span class="seta-azul"></span><input type="radio" name="<?php echo $pergunta->id_pergunta; ?>" value="<?php echo $pergunta->peso4; ?>" class="opcao required" <?php if(isset($respostas) && array_key_exists($pergunta->id_pergunta, $respostas) && $respostas[$pergunta->id_pergunta] == $pergunta->peso4): ?> checked="checked" <?php endif; ?>>
								<span class="resposta_3">3</span><span class="seta-verde"></span><input type="radio" name="<?php echo $pergunta->id_pergunta; ?>" value="<?php echo $pergunta->peso3; ?>" class="opcao required" <?php if(isset($respostas) && array_key_exists($pergunta->id_pergunta, $respostas) && $respostas[$pergunta->id_pergunta] == $pergunta->peso3): ?> checked="checked" <?php endif; ?>>
								<span class="resposta_2">2</span><span class="seta-laranja"></span><input type="radio" name="<?php echo $pergunta->id_pergunta; ?>" value="<?php echo $pergunta->peso2; ?>" class="opcao required" <?php if(isset($respostas) && array_key_exists($pergunta->id_pergunta, $respostas) && $respostas[$pergunta->id_pergunta] == $pergunta->peso2): ?> checked="checked" <?php endif; ?>>
								<span class="resposta_1">1</span><span class="seta-vermelha"></span><input type="radio" name="<?php echo $pergunta->id_pergunta; ?>" value="<?php echo $pergunta->peso1; ?>" class="opcao required" <?php if(isset($respostas) && array_key_exists($pergunta->id_pergunta, $respostas) && $respostas[$pergunta->id_pergunta] == $pergunta->peso1): ?> checked="checked" <?php endif; ?>>
								</td>
							</tr>
							<?php $cont++; ?>
						<?php endforeach; ?>
					</table>
				</div>
				<?php endif; ?>
			 <?php endforeach; ?>

				</div>
                            
                           
				<input type="hidden" name="acao" id="acao" value="">
			</form>

				<div class="botao-autodiagnostico-salvar">
				<h1><a href="javascript:" onclick="envia_questionario('salvar');" >Salvar</a></h1>
				<h2>e continuar depois</h2>
				<span class="ponta-botao-laranja-autodiagnostico"></span>
				<span class="ponta-botao-laranja-autodiagnostico-left"></span>
				</div>

				<div class="botao-autodiagnostico-finalizar">
				<h1><a href="javascript:" onclick="envia_questionario('enviar');" >Enviar</a></h1>
				<h2>o questionário</h2>
				<span class="ponta-botao-vermelho-autodiagnostico"></span>
				</div>

            </div>

              </div>


            </div>

<?php
	//include("includes/rodape.php");
?>

<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
?>