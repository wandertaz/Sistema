<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>
<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>


         

            <div class="content">

            <div class="menuAreaRestrita">
            <h1>Área Restrita</h1>
           
            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
            ?>
            </div>

              <div class="content-interna" style="width:780px; background:white;">

                <div class="left-cursos equalH-meus-cursos">
                  <div class="miolo-interna">
                               
                      
                 <?php include("includes/area_restrita_modulo_de_pesquisa/menu_left.php"); ?>

                  </div>
                </div>
                <div class="centerCursos equalH-meus-cursos">
                    
                                
                        <h1>Minhas Pesquisas</h1>
                 <?php if($inscricoes): ?>
                 	<?php foreach($inscricoes as $item): ?>
                      
						<div style="margin-bottom: 5px;margin-left: 2px;" class="listagem-autodiagnostico">
							<div class="icone-autodiagnostico-<?php echo ($item->status == 'AP' ? 'executar' : ($item->status == 'IN' ? 'progresso' : 'finalizado')); ?>"></div>
                                                        
							<span class="titulo-autodiagnostico">
							    <font class="<?php echo ($item->status == 'AP' ? 'Aprovado' : ($item->status == 'NA' ? 'Não Aprovado' : 'Em Alteração')); ?>">Módulo de Pesquisa</font>
							    <br/>
							    <?php echo $item->titulo; ?>
							</span>
							<br/>

							<span class="data-aquisicao-autodiagnostico">Data de Criação: <?php echo date('d', strtotime($item->created)); ?> de <?php echo br_month(date('m', strtotime($item->created))) ?>, <?php echo date('Y', strtotime($item->created)); ?></span>
                            <?php if($item->status == 'NA' || $item->status == 'AL'): ?>
							 <font class="autodiagnostico-finalizado"  style="left: 0;bottom: 0;float: right;margin-right: 20px;margin-top: 6px;">AGUARDANDO ADEQUAÇÃO</font><BR>	
                                                         <a style="display:none;" href="#" class="botaoAutodiagnosticoFinalizado" style="margin-right: 20px;clear: both;margin-top: 15px;">Em Análise</a>
                                                                
							<?php elseif($item->status == 'AP'): ?>	
                                                           	
                                                              <font class="autodiagnostico-finalizado" style="color:green;left: 0;bottom: 0;float: right;margin-right: 20px;margin-top: 6px;">PESQUISA APROVADA</font>
                                                               <?php if($item->arquivo_relatorio): ?>
                                                                    <a href="<?php echo site_url('area_restrita_modulo_de_pesquisa/relatorio/'.$item->id_pesquisas.'/'.$acesso['tipoacesso']); ?>" class="botaoPesquisaOnline-relatorio" style="margin-right: 20px;clear: both;margin-top: 15px;">Finalizado</a>
                                                             <?php endif; ?>
                                                        <?php elseif($item->status == 'IN'): ?>
                                                            <?php if($item->ativo == 'S'): ?>
                                                            <font class="autodiagnostico-finalizado" style="color:#e7a008;left: 0;bottom: 0;float: right;margin-right: 20px;margin-top: 6px;">AGUARDANDO APROVAÇÃO</font><BR> 
                                                            <a href="<?php echo site_url('pesquisa_online/pesquisa_email/'.$item->id_pesquisas); ?>" class="botaoPesquisaOnline" style="margin-right: 20px;clear: both;margin-top: 15px;">Aguardando</a>
															<?php else: ?>
                                                            <font class="autodiagnostico-finalizado" style="color:#e7a008;left: 0;bottom: 0;float: right;margin-right: 20px;margin-top: 6px;">EM DESENVOLVIMENTO</font><BR> 
															<?php endif; ?>
														
                                                        <?php endif; ?>
                            <hr>
						</div>
                        
                                         <h4>FAÇA O UPLOAD DA SUA LOGOMARCA</h4>
                                                <style>
                                                    .adquirir-versao .button-download {
                                                        margin-top: 1.3em;
                                                     }
                                                    .adquirir-versao a {
                                                        text-decoration: underline !important;
                                                        color: #666;
                                                        float:right;
                                                     }
                                                     .button-download {
                                                        background: url('/mbconsultoria/assets/img/button-download.png') 0 0 no-repeat;
                                                        color: #222 !important;
                                                        display: block;
                                                        font-size: 12px;
                                                        font-style: italic;
                                                        line-height: 12px;
                                                        margin-top: 5px;
                                                        padding-left: 20px;
                                                        }

                                                </style>
                                             <label> <?php echo $this->session->flashdata('msg');?></label>
                                         <form style="float:left;" action="<?php echo site_url('area_restrita_modulo_de_pesquisa/functionSalvalogo/'.$item->id_pesquisas.'/'.$acesso['tipoacesso']);?>" method="post" enctype="multipart/form-data" name="upload">
                                                    <input type="file" name="userfile" style="font-size: 10px;">
                                                    <input type="submit" name="envio" value="enviar">
                                                    
                                                </form>
                                                
                                                <?php if(trim($item->logo)!=''): ?>                                                                            
                                                    <div class="adquirir-versao" style="float:right;">
                                                        <a style="margin: 6px 42px 0;" href="<?php echo site_url('area_restrita_modulo_de_pesquisa/functionUp_/'.$item->id_pesquisas.'/L/'.$item->chave)?>" class="button-download" title="Fazer download do arquivo">Fazer download do arquivo</a>
                                                    </div>                       
                                                <?php else: ?>
                                                     <!-- Vôce deve inserir uma base para disparo -->
                                                <?php endif;?> 
                        
                        
					<?php endforeach; ?>
				<?php else: ?>
					Não foi encontrado nenhuma pesquisa disponível.
                 <?php endif; ?>
                                    
                </div>

              </div>

                        <div class="rightMeusCursos">&nbsp;

                        </div>

            </div>
<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
?>