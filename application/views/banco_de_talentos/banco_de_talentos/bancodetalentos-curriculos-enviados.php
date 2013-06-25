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

     <form id="form_cadastro_curriculo" method="post" action="">
     <div class="centerCursos equalH-meus-cursos bancodetalentos_content">
      <h1>Você se candidatou para <?php echo isset($vagas)?count($vagas):0;?> vaga(s)</h1>
      <?php if(isset($vagas)):?>
	<?php for ($i=0; $i < count($vagas); $i++): ?>

      <div class="lista-candidatura">
	      <div class="conteudo-listagem">
	      <h1><?php echo $vagas[$i][0]->titulo_cargo; ?></h1>

		  <?php if ($vagas[$i][0]->exibir_nome_empresa=="S"): ?>
	      <h2>Nome da Empresa</h2>			
		  <?php endif ?>

	      <p><?php echo $vagas[$i][0]->descricao; ?></p>
		  </div>
		  
		  <div class="indicar-vaga">
		  	<img src="../<?php base_url(); ?>assets/img/user-min.png">
		  	<a href="<?php echo site_url("/gerenciamento_email/indicar_vaga_amigo/".$vagas[$i][0]->id_vaga); ?>" data-fancybox-type="iframe" class="various">Indicar vaga a um amigo</a>
		  </div>
		  
		  <div class="nivel">
		  <?php foreach ($niveis_de_atuacao as $nivel): ?>
		  		<?php if ($nivel->id_nivel==$vagas[$i][0]->niveis_de_atuacao_id_nivel): ?>		  			
		  		Nível:<h1><?php echo $nivel->nome_nivel; ?></h1>
		  		<?php endif ?>
		  <?php endforeach ?>
		  </div>

		  <?php if ($vagas[$i][0]->exibir_faixa_salarial=="S"): ?>
		  <div class="nivel">
		  	<?php foreach ($pretencaosalarial as $salario): ?>
		  		<?php if ($salario->pretencaosalarial_id==$pretencaosalarial_vagas[$i][0]->pretencaosalarial_pretencaosalarial_id): ?>
		  			Faixa Salarial:<h1><?php echo $salario->pretencaosalarial_nome; ?></h1>
		  		<?php endif ?>
		  	<?php endforeach ?>
		  </div>		
		  <?php endif ?>


		  <div class="clear"></div>
		  
		  <div class="acoes"><a href="<?php echo site_url("/bancodetalentos/detalhes_vaga/".$vagas[$i][0]->id_vaga); ?>"><img src="../<?php base_url(); ?>assets/img/eye-min-black.png"> Ver detalhes da vaga</a></div>
		  
		
		  <div class="acoes"><a href="<?php echo site_url("/bancodetalentos/remover_candidatura/".$vagas[$i][0]->id_vaga.'/'.retorno_id_curriculo()); ?>"><img src="../<?php base_url(); ?>assets/img/delete-icon.png"> Remover candidatura</a></div>

      </div>

     <?php endfor; ?>
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