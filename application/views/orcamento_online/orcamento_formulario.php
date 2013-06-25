<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>

<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>
          <?php //include("includes/banner-interna.php"); ?>

            <div class="content">
              <div class="content-interna">
                <div class="left-internas" style="width:710px;">
                   <div class="breadcrumb">
                       <ul>
                        <li><a href="<?php echo site_url();?>">Home ></a></li>
                        <li><a href="#">Orçamento On-line > </a></li>                        
                       </ul>
                  </div>
				  <div class="miolo-interna">

					<?php if($tipo_orcamento=='AI'): //(AI) Auditoria Interna ?>
						<?php include 'orcamento-forms/auditoria-interna.php';  ?>
					<?php elseif($tipo_orcamento=='PB'): //(PB) Orcamento On Line_PBQP-h ?>  
						<?php include 'orcamento-forms/programa-brasileiro.php';  ?>             
					<?php elseif($tipo_orcamento=='GA'): //(GA) Sistema Gestão Ambiental_ISO14001?> 
						<?php include 'orcamento-forms/gestao-ambiental-ISO14001.php';  ?>                  
					<?php elseif($tipo_orcamento=='SQ'): //(GQ) Sistema Gestão da Qualidade_ISO9001  ?>  
						<?php include 'orcamento-forms/gestao-qualidade-ISO9001.php';  ?>             
					<?php elseif($tipo_orcamento=='GS'): //(GS) Sistema Gestão Responsabilidade Social ?>     
						<?php include 'orcamento-forms/gestao-responsabilidade-social.php';  ?>                  
					<?php elseif($tipo_orcamento=='SS'): //(SS) Sistema Saúde e Segurança ?>       
						<?php include 'orcamento-forms/sistema-saude-seguranca.php';  ?>               
					<?php elseif($tipo_orcamento=='TR'): //(TR) Treinamento  ?>      
						<?php include 'orcamento-forms/treinamentos.php';  ?>   
					<?php else:?>
					  Não Encontrado
					<?php endif; ?>    

                </div>
				</div>

               </div>
				<div class="right">
                	     <?php
                                        include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'servicos-home.php';
                                    ?>
                </div>
            </div>

<?php include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php'; ?>