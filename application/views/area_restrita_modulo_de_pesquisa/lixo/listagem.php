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

              <div class="content-interna" style="width:780px; background:white;">

                <div class="left-cursos equalH-meus-cursos">
                  <div class="miolo-interna">

                 <?php include("includes/auto_diagnostico/menu_left.php"); ?>

                  </div>
                </div>
                <div class="centerCursos equalH-meus-cursos">
                 <h1>Meus Autodiagnósticos</h1>

                 
                </div>

              </div>

                        <div class="rightMeusCursos">&nbsp;

                        </div>

            </div>

<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
?>