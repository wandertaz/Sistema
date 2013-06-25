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
    <!--<ul>
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
     <div class="centerCursos equalH-meus-cursos bancodetalentos_content">
      	<?php if($vaga && $curriculos): ?>

			<h1>Sua vaga para <?php echo $vaga->titulo_cargo; ?> recebeu <?php echo $vaga->total_candidaturas; ?> curriculo(s)</h1>

			<?php foreach($curriculos as $curriculo): ?>
		      <!-- Pra cada candidato, inserir a linha abaixo -->
		      <div class="lista-candidatura">
			      <div class="conteudo-listagem">
			      <h1><?php echo $curriculo->inscrito; ?></h1>
			      <h2>
			      	<?php if(isset($curriculo->areas_atuacao) && $curriculo->areas_atuacao): ?>
					  	<?php foreach($curriculo->areas_atuacao as $area_atuacao): ?>
					  		<?php echo $area_atuacao->nome_area.' . '; ?>
					  	<?php endforeach; ?>
					  <?php endif; ?>
				  </h2>

				  <?php if(isset($curriculo->formacao_academica) && $curriculo->formacao_academica): ?>
			      	<h3><?php echo $graus_formacao[$curriculo->formacao_academica->grau_formacao]; ?></h3>
			      <?php endif; ?>

			      <p><?php echo $curriculo->objetivosprofissionais; ?></p>
				  </div>

				<?php if($curriculo->nome_nivel): ?>
					<div class="nivel">
					Nível:<h1><?php echo $curriculo->nome_nivel; ?></h1>
					</div>
				<?php endif; ?>

				<?php if(isset($curriculo->faixa_salarial) && $curriculo->faixa_salarial): ?>
					<div class="nivel">
					Faixa Salarial:<h1><?php echo $curriculo->faixa_salarial->pretencaosalarial_nome; ?></h1>
					</div>
				<?php endif; ?>

				  <div class="clear"></div>

				  <div class="acoes"><a href="<?php echo site_url('/bancodetalentos_empresa/ver_curriculo/'.$curriculo->id_curriculo); ?>"><img src="<?php echo base_url(); ?>assets/img/eye-min-black.png"> Ver detalhes do curriculo</a></div>
				  <div class="acoes"><a href="<?php echo site_url('/bancodetalentos_empresa/visualizar/'.$curriculo->inscritos_id) ?>"><img src="<?php echo base_url(); ?>assets/img/icon-download.png"> Fazer Download</a></div>

				  <!--<a href="#"><img src="<?php echo base_url(); ?>assets/img/btn-selecionar-curso.png" class="botao"/></a>-->

		      </div>
		      <!-- Pra cada candidato, inserir a linha acima -->

			<?php endforeach; ?>

		<?php else: ?>
			<h1>Sua vaga para <?php echo $vaga->titulo_cargo; ?> ainda não recebeu curriculos.</h1>
		<?php endif; ?>
     </div>
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