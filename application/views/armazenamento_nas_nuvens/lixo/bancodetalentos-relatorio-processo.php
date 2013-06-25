<?php
include("includes/topo.php");
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
      <h1>relatório de processo de seleção</h1>

      <!-- Pra cada candidato, inserir a linha abaixo -->
      <div class="lista-relatorio">

			<?php if($processos): ?>
				<?php foreach($processos as $processo): ?>
			      <div class="conteudo-listagem">
			      <h1><?php echo $processo->titulo; ?></h1>
			       <span class="area"><?php echo $processo->descricao; ?></span>
			      <h3>Data de Aquisição: <?php echo date('d', strtotime($processo->created)); ?> de <?php echo br_month(date('m', strtotime($processo->created))); ?>, <?php echo date('Y', strtotime($processo->created)); ?></h3>
			      <div class="status-relatorio-processo">
				      <div class="icone-autodiagnostico-<?php echo $processo->status == 'A' ? 'progresso' : 'finalizado'; ?>"></div>
				      <font style="font-size:11px; color:#e7a008; position:relative; left:5px; top:-20px;"><?php echo $processo->status == 'A' ? 'EM EXECUÇÂO' : 'CONCLUÍDO'; ?></font>
			  	  </div>

			  	  <?php if($processo->status == 'C' && $processo->arquivo): ?>
			      	<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $processo->arquivo; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/icon-download.png"> Fazer download de Processo de Seleção</a>
			      <?php endif; ?>
			      <hr>
				  </div>
				<?php endforeach; ?>

		<?php endif; ?>


      </div>

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