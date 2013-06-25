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

              <div class="content-interna" style="width:780px; background:white;">

                <div class="left-cursos equalH-meus-cursos">
                  <div class="miolo-interna">


         <?php include("includes/banco_de_talentos/menu_left.php"); ?>

                  </div>
                </div>

                <div class="centerCursos equalH-meus-cursos">
                 <h1>Selecione um Pacote</h1>
	<?php if($curriculos_inscricoes): ?>
		<?php foreach ($curriculos_inscricoes as $inscricao): ?>

			     <div class="curso">
                   <a style="float:left;" href="<?php echo site_url("bancodetalentos_empresa/ver_curriculos_contratados/".$inscricao->id_inscricao);?>">
                    <img src="<?php echo base_url(); ?>assets/uploads/a" width="92" height="56" align="left" style="margin-right:5px;position:absolute;">
                    <div class="mascaraPlayer meus_cursos"></div>
                  </a>

                  <div class="container-header-curso">
                    <a style="text-decoration: none;" href="<?php echo site_url("bancodetalentos_empresa/ver_curriculos_contratados/".$inscricao->id_inscricao);?>">
                      <h2 style="position:relative; left:2px; width: 600px;display: block;">Pacote</h2>
                    </a>

                    <?php $total_curriculos = count(explode(',', $inscricao->curriculos_ids)); ?>
                    <h3 class="meus_cursos"><?php echo $total_curriculos.' currículos '.' - '.br_date($inscricao->data_inscricao); ?></h3>
                  </div>
                  <div class="datas_meus_cursos">


                  </div>

                </div>
		<?php endforeach ?>
	<?php else: ?>
		Nenhum pacote de seleção de currículos foi encontrado.
	<?php endif; ?>





                </div>
                <?php /*
                <div class="vejaTambem">
                <?php //include("includes/veja-tambem-quem-somos.php"); ?>
                </div>
                <?php include("includes/box-destaques.php");
                */ ?>
              </div>
              <div class="rightMeusCursos">
               <?php
                	//include("includes/coluna-direita-area-restrita.php");
                ?>
              </div>

            </div>

            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
            ?>