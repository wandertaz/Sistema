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
      	<h1>Minhas Vagas</h1>

      		<?php if($vagas): ?>
				<?php foreach($vagas as $vaga): ?>
					<div class="vaga">
					  <h2 class="cargo-vaga"><?php echo $vaga->titulo_cargo; ?></h2>
					  <h3 class="atuacao-vaga">
						  <?php if(isset($vaga->areas_atuacao) && $vaga->areas_atuacao): ?>
						  	<?php foreach($vaga->areas_atuacao as $area_atuacao): ?>
						  		<?php echo $area_atuacao->nome_area.' . '; ?>
						  	<?php endforeach; ?>
						  <?php endif; ?>
					  	<span> <?php echo $graus_formacao[$vaga->grau_formacao]; ?></span>
					  </h3>
					  <p class="desc-vaga"><?php echo $vaga->descricao; ?></p>
					  <ul class="detalhes-vaga">
					    <li>
					      <span class="detalhe-title-vaga">Nível</span>
					      <br>
					      <span><?php echo $vaga->nome_nivel; ?></span>
					    </li>
					    <?php if(isset($vaga->faixa_salarial) && $vaga->faixa_salarial): ?>
							<li>
						      <span class="detalhe-title-vaga">Faixa Salarial</span>
						      <br>
						      <span><?php echo $vaga->faixa_salarial->pretencaosalarial_nome; ?></span>
						    </li>
						<?php endif; ?>
					  </ul>
					  <ul class="menu-vaga">
					    <li><a class="ver-vaga" href="<?php echo site_url('bancodetalentos/detalhes_vaga/'.$vaga->id_vaga); ?>">Detalhes da vaga</a></li>
					    <li><a class="delete-vaga" href="<?php echo site_url('bancodetalentos_empresa/excluir_vaga/'.$vaga->id_vaga) ?>" onclick="if(confirm('Tem certeza que deseja excluir a vaga?') == true){return true;} else{ return false;}" >Deletar vaga</a></li>
					    <li><a class="edit-vaga" href="<?php echo site_url('bancodetalentos_empresa/editar_vaga/'.$vaga->id_vaga); ?>">Editar vaga</a></li>
					    <li><a class="ver-curriculos-recebidos" href="<?php echo site_url('bancodetalentos_empresa/ver_curriculos_recebidos/'.$vaga->id_vaga); ?>">Currículos recebidos</a></li>
					  </ul>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				Nenhuma vaga foi encontrada.
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