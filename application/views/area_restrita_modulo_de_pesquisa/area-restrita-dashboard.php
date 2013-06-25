<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>
<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>


         

            <div class="content">

            <div class="menuAreaRestrita">
            <h1>�?rea Restrita</h1>
           
            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
            ?>
            </div>

              <div class="content-interna" style="width:780px; background:white;">

                <div class="left-cursos equalH-meus-cursos">
                  <div class="miolo-interna">
                      <ul class="lista-meus-cursos">
                            <li><a href="<?php echo site_url('meucadastro/index/'.$this->session->userdata('SessionTipoPessoa'));?>">Meu Cadastro</a><span>Atualizar</span></li>
                            <li class="selected"><a href="<?php echo site_url('area_restrita_modulo_de_pesquisa/index');?>/<?php echo $acesso['tipoacesso']; ?>">Minhas Pesquisas</a></li>
                      </ul>  
                      
                      
                      
                 <?php //include("includes/area_restrita_modulo_de_pesquisa/menu_left.php"); ?>

                  </div>
                </div>
                <div class="centerCursos equalH-meus-cursos">
                    
                                
                        <h1>Minhas Pesquisas</h1>
                 <?php if($inscricoes): ?>
                 	<?php foreach($inscricoes as $item): ?>
                      
						<div class="listagem-autodiagnostico">
						
								<?php if($item->ativo == 'S'): ?>
								<?php if($item->status == 'IN'): ?>
								<a href="<?php echo site_url('pesquisa_online/pesquisa_email/'.$item->id_pesquisas); ?>"><?php elseif($item->status == 'AP'): ?>
							    <a href="<?php echo site_url('pesquisa_online/pesquisa_sugestao_teste/'.$item->id_pesquisas.'/'.$acesso['tipoacesso']); ?>"><?php endif; ?><?php endif; ?><div class="icone-autodiagnostico-<?php echo ($item->status == 'AP' ? 'executar' : ($item->status == 'IN' ? 'progresso' : 'finalizado')); ?>"></div><?php if($item->ativo == 'S' && ( $item->status == 'IN' || $item->status == 'AP' ) ): ?></a>
								<?php endif; ?>
								
							<span class="titulo-autodiagnostico">
							    <font class="<?php echo ($item->status == 'AP' ? 'Aprovado' : ($item->status == 'NA' ? 'Não Aprovado' : 'Em Alteração')); ?>">
								<?php if($item->ativo == 'S'): ?>
								<?php if($item->status == 'IN'): ?>
								<a href="<?php echo site_url('pesquisa_online/pesquisa_email/'.$item->id_pesquisas); ?>">
								<?php elseif($item->status == 'AP'): ?>
							    <a href="<?php echo site_url('pesquisa_online/pesquisa_sugestao_teste/'.$item->id_pesquisas.'/'.$acesso['tipoacesso']); ?>">
								<?php endif; ?>
								<?php endif; ?>
								Pesquisa
								<?php if($item->ativo == 'S' && ( $item->status == 'IN' || $item->status == 'AP' ) ): ?>
								</a>
								<?php endif; ?>
                                 </font>
							    <br/>
								<?php if($item->ativo == 'S'): ?>
								<?php if($item->status == 'IN'): ?>
								<a href="<?php echo site_url('pesquisa_online/pesquisa_email/'.$item->id_pesquisas); ?>">
								<?php elseif($item->status == 'AP'): ?>
							    <a href="<?php echo site_url('pesquisa_online/pesquisa_sugestao_teste/'.$item->id_pesquisas.'/'.$acesso['tipoacesso']); ?>">
								<?php endif; ?>
								<?php endif; ?>
								<?php echo $item->titulo; ?>
								<?php if($item->ativo == 'S' && ( $item->status == 'IN' || $item->status == 'AP' ) ): ?>
								</a>
								<?php endif; ?>
								
							</span>
							<br/>

							<span class="data-aquisicao-autodiagnostico">Data de Criação: <?php echo date('d', strtotime($item->created)); ?> de <?php echo br_month(date('m', strtotime($item->created))) ?>, <?php echo date('Y', strtotime($item->created)); ?></span>
							 <br/>
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
															<?php if($item->status != 'AP'): ?>
                                                            <div style="float:left;">
                                                            <div>
                                                                <a class="botaoPesquisaOnline-dados"  href="<?php echo site_url('area_restrita_modulo_de_pesquisa/banco_de_dados/'.$item->id_pesquisas.'/'.$acesso['tipoacesso']); ?>">Enviar Base de dados</a>
                                                                
                                                            </div><br>
                                                            <div style="margin-top:10px">
                                                                <a class="botaoPesquisaOnline-logomarca"  href="<?php echo site_url('area_restrita_modulo_de_pesquisa/logomarca/'.$item->id_pesquisas.'/'.$acesso['tipoacesso']); ?>">Enviar Logomarca</a>
                                                                
                                                            </div>
                                                            </div>
                                                        <?php endif; ?>
						</div><br>
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