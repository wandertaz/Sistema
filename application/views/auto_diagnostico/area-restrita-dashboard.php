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
                <li class="selected"><a href="<?php //echo site_url('area_restrita_autodiagnosticos/index'); ?>/<?php //echo $acesso['tipoacesso']; ?>">Auto Diagnóstico</a></li>
               <li><a href="#">Banco de Talentos</a></li>
                <li><a href="#">Central de Downloads</a></li>
                <li><a href="#">Gerenciamento de Usuários</a></li>
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
                    
                    <?php if($acesso['tipoacesso']=='J' || $acesso['tipoacesso']=='FJ'): ?>                 
                        <h1>Autodiagnósticos Empresariais</h1>
                     <?php else: ?>
                         <h1>Meus Autodiagnósticos</h1>
                     <?php endif; ?>
                        
                 <?php if($inscricoes): ?>
                 	<?php foreach($inscricoes as $item): ?>
						<div class="listagem-autodiagnostico">
							<div class="icone-autodiagnostico-<?php echo ($item->status == 'P' ? 'executar' : ($item->status == 'A' ? 'progresso' : 'finalizado')); ?>"></div>
							<span class="titulo-autodiagnostico">
							    <font class="<?php echo ($item->status == 'P' ? 'executar' : ($item->status == 'A' ? 'execucao' : 'finalizado')); ?>"><?php echo $item->nome_tipo; ?></font>
							    <br/>
							    <a href="<?php echo site_url('area_restrita_autodiagnosticos/ver_autodiagnostico/'.$item->id_inscricao.'/'.$item->url).'/'.$acesso['tipoacesso']; ?>"><?php echo $item->nome; ?></a>
							</span>
							<br/>

							<span class="data-aquisicao-autodiagnostico">Data de Aquisição : <?php echo date('d', strtotime($item->data_inscricao)); ?> de <?php echo br_month(date('m', strtotime($item->data_inscricao))) ?>, <?php echo date('Y', strtotime($item->data_inscricao)); ?></span>

							<?php if($item->status == 'P'): ?>
								<a href="<?php echo site_url('area_restrita_autodiagnosticos/ver_autodiagnostico/'.$item->id_inscricao.'/'.$item->url).'/'.$acesso['tipoacesso']; ?>" class="botaoExecutarAutodiagnostico">Executar</a>
							<?php elseif($item->status == 'A'): ?>
								<font style="font-size:11px; color:#e7a008; position:relative; left:40px; top:3px;">EM EXECUÇÃO</font>
								<div class="progress" style="float:right; top:10px; left:-60px;">
		                          <div class="progressBarFill" style="width:<?php echo $item->porcentagem.'%'; ?>"></div>
		                          <div class="progressBar"></div>
		                          <p class="progressNumero" style="left:<?php echo ($item->porcentagem - 5).'%'; ?>;"><?php echo $item->porcentagem; ?>%</p> <!-- O atributo left a ser passado precisa ser: valor da porcentagem - 5-->
		                      	</div>
                      		<?php elseif($item->status == 'F'): ?>
                      			<font class="autodiagnostico-finalizado">FINALIZADO</font> <a href="<?php echo site_url('area_restrita_autodiagnosticos/ver_resultado/'.$item->id_inscricao.'/'.$acesso['tipoacesso']); ?>" class="botaoAutodiagnosticoFinalizado">Finalizado</a>
                      		<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					Não foi encontrado nenhum autodiagnóstico disponível.
                 <?php endif; ?>
                </div>

              </div>

                        <div class="rightMeusCursos">&nbsp;

                        </div>

            </div>

<?php
	//include("includes/rodape.php");
?>

<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
?>