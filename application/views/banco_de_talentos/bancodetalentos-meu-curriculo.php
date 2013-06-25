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
      <li class="selected"><a href="#">Banco de Talentos</a></li>
      <li><a href="#">Auto Diagnóstico</a></li>

      <li><a href="#">Central de Downloads</a></li>
      <li><a href="#">Gerenciamento de Usuários</a></li>
      <li><a href="#">Armazenamento na Nuvem</a></li>

    </ul>-->
        <?php
            include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
        ?>
    </div>


    <?php include('includes/busca-topo-bancodetalentos.php'); ?>

    <div class="content-interna" style="width:990px; background:white;">

    <!-- Left Sidebar -->
     <div class="left-cursos equalH-meus-cursos">
        <div class="miolo-interna">
         <?php include("includes/banco_de_talentos/menu_left.php"); ?>
       </div>
     </div>

     <form id="form_cadastro_curriculo" method="post" action="">
     <?php if($registro): ?>
	     <div class="centerCursos equalH-meus-cursos bancodetalentos_content">

	        <div class="topo-meu-curriculo">
	          <div class="pessoa-infos to-left" style="">
	            <h1><?php echo $registro->nome; ?></h1>
	            <strong><?php echo $registro->email; ?></strong>
	          </div>
	          <div class="pessoa-infos to-left" style="">
	            <p>
	              <?php echo $estados_civis[$registro->estadocivil]; ?><br />
	              <?php echo br_date($registro->data_nascimento); ?> - <?php echo calculaidade(br_date($registro->data_nascimento)); ?> Anos
	            </p>
	          </div>
	          <div class="pessoa-infos to-right" style="text-align:right;">
	            <a href="<?php echo $registro->link_facebook; ?>" class="icons-meu-curriculos fb">FB</a>
	            <a href="<?php echo $registro->link_twitter; ?>" class="icons-meu-curriculos tw">TW</a>
	            <a href="<?php echo $registro->link_linkedin; ?>" class="icons-meu-curriculos in">IN</a>
	          </div>
	        </div>

	        <div class="topo-meu-curriculo">
	          <div class="pessoa-infos to-left border-right" style="height: 110px;">
	            <strong>Filhos:</strong><span><?php echo $registro->filhos == 'S' ? 'Sim' : 'Não'; ?></span><br />
	            <strong>Portador de Deficiência:</strong><span><?php echo $registro->deficiencia == 'S' ? 'Sim' : 'Não'; ?></span><br />
	            <strong>Religião:</strong><span><?php echo $registro->religiao; ?></span><br />
	            <strong>CNH:</strong><span><?php echo $registro->cnh == 'S' ? 'Sim' : 'Não'; ?></span><br />
	            <strong>Veículo:</strong><span><?php echo $registro->veiculo == 'S' ? 'Sim' : 'Não'; ?></span>
	          </div>
	          <div class="pessoa-infos to-left border-right" style="height: 110px;">
	            <strong>Celular:</strong><span><?php echo $registro->celular; ?></span><br />
	            <strong>Telefone:</strong><span><?php echo $registro->telefone; ?></span><br />
	          </div>
	          <div class="pessoa-infos to-right" style="height: 110px;">
	            <p>
	              <?php echo $registro->endereco; ?>, <?php echo $registro->numero; ?>
	              <?php if($registro->complemento): ?>
				  , <?php echo $registro->complemento; ?>
				  <?php endif; ?>
				   - <?php echo $registro->bairro; ?>, <?php echo $registro->cidade; ?> / <?php echo $registro->estado; ?>  - CEP: <?php echo $registro->cep; ?>
	            </p>
	          </div>
	        </div>

	        <div class="content-meu-curriculo">

	        	<?php if($formacao_academica): ?>
		          <h2>Formação Acadêmica</h2>

		          	<?php foreach($formacao_academica as $formacao): ?>
			          <strong>GRAU DE FORMAÇÃO:</strong>  <span><?php echo $formacao->grau_formacao ? $graus_formacao[$formacao->grau_formacao] : ''; ?></span><br />
			          <strong>CURSO DE FORMAÇÃO:</strong><span><?php echo $formacao->nome_curso; ?>  em</span> <strong><?php echo $formacao->instituicao; ?></strong><br />
			          <strong style="margin-left:10px;">início:</strong>  <span><?php echo ($formacao->data_inicio); ?></span> <br />
			          <strong style="margin-left:10px;">conclusão:</strong>  <span><?php echo ($formacao->data_conclusao); ?></span><br />
			  			<br />
					<?php endforeach; ?>
			  	<?php endif; ?>

			  	<?php if($idiomas): ?>
			  		<strong> idiomas: </strong><br />
			  		<?php foreach($idiomas as $idioma): ?>
			          <strong style="margin-left:10px;"><?php echo $idioma->nome_idioma; ?></strong> <span>- Leitura: <?php echo isset($niveis_idiomas[$idioma->nivel_leitura]) ? $niveis_idiomas[$idioma->nivel_leitura] : ''; ?>
			           - Escrita: <?php echo isset($niveis_idiomas[$idioma->nivel_escrita]) ? $niveis_idiomas[$idioma->nivel_escrita] : ''; ?>
			           - Conversação: <?php echo isset($niveis_idiomas[$idioma->nivel_conversacao]) ? $niveis_idiomas[$idioma->nivel_conversacao] : ''; ?>;</span> <br />
			      <?php endforeach; ?>
			      <br />
			  	<?php endif; ?>

          		<?php if($cursos_complementares): ?>
          			<strong>cursos complementares:</strong><br />
	          		<?php foreach($cursos_complementares as $curso): ?>
			          <strong style="margin-left:10px;"><?php echo $curso->nome_curso; ?> - <?php echo $curso->instituicao; ?></strong><br />
			          <span style="margin-left:10px;"><?php echo ($curso->data_inicio); ?> até <?php echo ($curso->data_fim); ?> - Carga Horária: <?php echo $curso->carga_horaria; ?></span><br />
			          <span style="margin-left:10px;"><?php echo $curso->cidade_pais; ?></span>
			      	  <br />
					<?php endforeach; ?>
			   	<?php endif; ?>

			</div>


	        <div class="content-meu-curriculo">
	          <h2>Objetivos Profissionais</h2>
	          <strong>faixa pretensão salarial:</strong> <span><?php echo $pretensao_salarial ? $pretensao_salarial->pretencaosalarial_nome : ''; ?></span><br />
	          <strong>NÍVEL DE ATUAÇÃO:</strong>  <span><?php echo $registro->niveis_de_atuacao_id_nivel ? $niveis_atuacao[$registro->niveis_de_atuacao_id_nivel] : ''; ?></span><br />
	          <strong>ÁREA DE ATUAÇÃO:</strong>
	          	<span>
          			<?php foreach($areas_atuacao as $area): ?>
						<?php echo $area->nome_area; ?> -
					<?php endforeach; ?>
				</span><br />
	          <strong>Segmento DE ATUAÇÃO:</strong>  <span><?php echo $segmento_atuacao ? $segmento_atuacao->segmentodeatuacao_nome : ''; ?></span><br />

	          <strong>DISPONIBILIDADE DE HORÁRIO:</strong>  <span><?php echo $disponibilidade_horario ? $disponibilidade_horario->disponibilidadehorario_nome : ''; ?></span><br />
	          <strong>Disponibilidade de trabalhar em outra cidade:</strong>  <span><?php echo $registro->trabalhar_outra_cidade == 'S' ? 'Sim' : 'Não'; ?></span><br />

	          <p style="top:10px !important"><?php echo $registro->objetivosprofissionais; ?></p>
	        </div>

			<?php if($historico_profissional): ?>
		        <div class="content-meu-curriculo">
		          <h2>Histórico Profissional</h2>

		          <?php foreach($historico_profissional as $historico): ?>
					  <div class="exp-profissional">
			            <div class="coluna-esq">
			              <strong><?php echo $historico->empresa; ?></strong><br />
			              <span><?php echo br_date($historico->data_inicial); ?> - <?php echo br_date($historico->data_saida); ?></span><br />
			              <?php if($historico->cargos): ?>
			              	<?php foreach($historico->cargos as $cargo): ?>
								<span><?php echo $cargo->cargo; ?></span><br />
							<?php endforeach; ?>
						  <?php endif; ?>
			              <span><?php echo $historico->salario; ?></span>
			            </div>
			            <div class="coluna-dir border-left">
			              <strong>PRINCIPAIS ATRIBUIÇÕES:</strong><br />
			              <p><?php echo $historico->principais_atribuicoes; ?></p>
			              <br />
			              <strong>SUPERIOR IMEDIATO: </strong>
			              <p><?php echo $historico->superior_imediato; ?>/<?php echo $historico->cargo_superior_imediato; ?></p>
			            </div>
			          </div>
			      <?php endforeach; ?>
		        </div>
	        <?php endif; ?>

			<?php if($referencias_profissionais): ?>
		        <div class="content-meu-curriculo">
		          <h2>Referências Profissionais</h2>
		          	<?php foreach($referencias_profissionais as $referencia): ?>
					  <span><?php echo $referencia->empresa; ?>:</span><br />
			          <strong style="margin-left:5px;"><?php echo $referencia->nome_superior_imediato; ?></strong><br />
			          <i style="margin-left:5px;"><?php echo $referencia->cargo; ?></i><br />
			          <span><?php echo $referencia->telefone_comercial; ?> / <?php echo $referencia->email; ?></span><br /><br />
					<?php endforeach; ?>
		        </div>
		    <?php endif; ?>

	        <div class="content-meu-curriculo">
	          <h2 class="to-left">PERFIL ACESSÍVEL?</h2>
	          <strong style="margin-left:5px;" class="to-left"><?php echo $registro->perfil_acessivel == 'S' ? 'Sim' : 'Não'; ?></strong><br />

	        </div>


	     </div>
	 <?php else: ?>
		Currículo não encontrado
     <?php endif; ?>
      </form>

     <!-- Right Sidebar -->
     <div class="rightMeusCursos">
         <?php include("includes/banco_de_talentos/menu_right.php"); ?>
     </div>

   </div>


 </div>

            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
            ?>