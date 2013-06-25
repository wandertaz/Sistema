<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>

<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>
          <?php //include("includes/banner-interna.php"); ?>

            <div class="content">
              <div class="content-interna">
                <div class="left-internas" style="width:710px;height: 1056px;">
                   <div class="breadcrumb">
                       <ul>
                        <li><a href="#">Home ></a></li>
                        <li><a href="#">Bussiness Store > </a></li>
                        <li><a href="#">Orçamento On-line</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">
                      <?php 
                      
                     // print_r(unserialize($orcamento[0]->array_post));
                      
                      ?>
                  	<h3 style="margin-bottom: 15px;">orçamento on-line</h3> 
                                    
					<div class="box-sucess-orcamento">
                                        <?php $tipo_orcamento=$orcamento[0]->tipo_orcamento;?>
                                        <?php if($tipo_orcamento=='AI'): //(AI) Auditoria Interna ?>
						<?php $tipo='Auditoria Interna'  ?>
					<?php elseif($tipo_orcamento=='PB'): //(PB) Orcamento On Line_PBQP-h ?>  
						<?php $tipo='Orcamento On Line_PBQP-h'  ?>             
					<?php elseif($tipo_orcamento=='GA'): //(GA) Sistema Gestão Ambiental_ISO14001?> 
						<?php $tipo='Sistema Gestão Ambiental_ISO14001'  ?>                  
					<?php elseif($tipo_orcamento=='SQ'): //(GQ) Sistema Gestão da Qualidade_ISO9001  ?>  
						<?php $tipo='Sistema Gestão da Qualidade_ISO9001'  ?>           
					<?php elseif($tipo_orcamento=='GS'): //(GS) Sistema Gestão Responsabilidade Social ?>     
						<?php $tipo='Sistema Gestão Responsabilidade Social'  ?>                 
					<?php elseif($tipo_orcamento=='SS'): //(SS) Sistema Saúde e Segurança ?>       
						<?php $tipo='Sistema Saúde e Segurança'  ?>              
					<?php elseif($tipo_orcamento=='TR'): //(TR) Treinamento  ?>      
						<?php $tipo='Treinamento '  ?>				
					<?php endif; ?>    
                  		<p class="min-paragraph">OBRIGADO!<br /> Seu orçamento On-line para <?echo $tipo; ?>  foi solicitado com sucesso.</p>
                                <p class="min-paragraph">Data do orçamento: <?echo br_date_time($orcamento[0]->created);?></p>
						<p class="min-paragraph">Detalhes:</p> 
						<ul>
							<li>
								<span><?echo $orcamento[0]->nome_empresa.' '.$orcamento[0]->cnpj; ?></span>
							</li>
							<li>
								<span><?echo $orcamento[0]->nome_responsavel;?></span>
							</li>
							<li>
								<span><?echo $orcamento[0]->email_resposta;?></span>
							</li>
							<li>
								<span><?echo $orcamento[0]->telefone.' / '.$orcamento[0]->celular; ?></span>
							</li>
							
						</ul>
                                                <div class="adquirir-versao">
                                                    
                                                    <a href="<?  echo site_url('orcamento_online/gerarpdf/'.$orcamento[0]->id_orcamento_online);?>" class="download-arquivo" title="Fazer download do arquivo">Fazer download do arquivo</a>
						</div>
						<p class="min-paragraph last-item"></p>

					</div>

					<div class="info-outros-servicos">					
                                            <a class="to-right" href="<?php echo site_url('orcamento_online/index/'.$tipo_orcamento);?>"><img src="<?php echo base_url(); ?>assets/img/novo-orcamento-btn.png" alt=""></a>
					</div>

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