<?php
include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>


<?php include("includes/banner-interna.php"); ?>

<div class="content">

    <div class="menuAreaRestrita">
    <h1>Área Restrita</h1>
    <ul>
      <li><a href="#">Cursos</a></li>
      <li class="selected"><a href="#">Banco de Talentos</a></li>
      <li><a href="#">Auto Diagnóstico</a></li>
      <!--
      <li><a href="#">Central de Downloads</a></li>
      <li><a href="#">Gerenciamento de Usuários</a></li>
      <li><a href="#">Armazenamento na Nuvem</a></li>
      -->
    </ul>
    </div>


    <?php include('includes/busca-topo-bancodetalentos.php'); ?>

    <div class="content-interna" style="width:990px; background:white;">

    <!-- Left Sidebar -->
     <div class="left-cursos equalH-meus-cursos">
        <div class="miolo-interna">
         <?php include("includes/banco_de_talentos/menu_left.php"); ?>
       </div>
     </div>

     <form id="form_cadastro_de_vagas" method="post" action="">
     <div class="centerCursos equalH-meus-cursos bancodetalentos_content">
      <h1>Currículos Contratados</h1>

      <?php if($curriculos): ?>
		<?php foreach($curriculos as $curriculo): ?>
		      <div class="vaga">
		        <h2 class="cargo-vaga"><?php echo $curriculo->inscrito; ?></h2>
		        <h3 class="atuacao-vaga">
	        		<?php if(isset($curriculo->areas_atuacao) && $curriculo->areas_atuacao): ?>
				  	<?php foreach($curriculo->areas_atuacao as $area_atuacao): ?>
				  		<?php echo $area_atuacao->nome_area.' . '; ?>
				  	<?php endforeach; ?>
				  <?php endif; ?>

					<?php if(isset($curriculo->formacao_academica) && $curriculo->formacao_academica): ?>
						<span> <?php echo $graus_formacao[$curriculo->formacao_academica->grau_formacao]; ?></span>
					<?php endif; ?>
				</h3>
		        <p class="desc-vaga"><?php echo $curriculo->objetivosprofissionais; ?></p>
		        <ul class="detalhes-vaga">
		          <?php if($curriculo->nome_nivel): ?>
					  <li>
			            <span class="detalhe-title-vaga">Nível</span>
			            <br>
			            <span><?php echo $curriculo->nome_nivel; ?></span>
			          </li>
			      <?php endif; ?>

			      <?php if(isset($curriculo->faixa_salarial) && $curriculo->faixa_salarial): ?>
			          <li>
			            <span class="detalhe-title-vaga">Prentensão Salarial</span>
			            <br>
			            <span><?php echo $curriculo->faixa_salarial->pretencaosalarial_nome; ?></span>
			          </li>
			      <?php endif; ?>

		        </ul>
		        <ul class="menu-vaga">
		          <li><a class="ver-vaga" href="<?php echo site_url('/bancodetalentos_empresa/ver_curriculo/'.$curriculo->id_curriculo); ?>">Detalhes deste currículo</a></li>
		          <!--<li class="no-margin"><a class="print-vaga" href="">Imprimir</a></li>-->
		          <!--<li><a class="select-curriculo" href=""><img src="<?php echo base_url(); ?>assets/img/select-curriculo.png" alt=""></a></li>-->
		        </ul>
		      </div>
		  <?php endforeach; ?>
		<?php else: ?>
			Nenhum currículo foi encontrado.
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
 include("includes/rodape.php");
 ?>