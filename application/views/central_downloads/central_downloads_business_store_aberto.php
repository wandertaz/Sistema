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
                        <li><a href="#">Home ></a></li>
                        <li><a href="#">Bussiness Store > </a></li>
                        <li><a href="#">Central de Downloads</a></li>
                       </ul>
                  </div>
				  <div class="miolo-interna">
                     <h3>Central de Downloads</h3>

                     	<div class="text-cursos" style="float:left; margin-left:75px; width:600px; margin-top:20px; margin-bottom:10px;">
					    	<?php if(isset($pagina) && $pagina): ?>
					        	<?php echo $pagina->texto; ?>
					        <?php endif; ?>
					    </div>

                     <div class="box-search-cursos*" style="margin-bottom:20px;">
					    
					    </div>
				 <div style="clear:both;"></div>

                                            <?php if($central_downloads): ?>
						<div >
                                                        <?php foreach($central_downloads as $item): ?>
                                                         <?php
                                                          $dadosversao = retorna_ultima_versao_downloads($item->id_downloads, $busca);
                                                          if($dadosversao):
                                          //print_r($dadosversao);
                                         ?>
								<div class="lista-autodiagnostico8" style="margin-top:15px; margin-bottom:15px">
									<!--<img src="<?php echo base_url();?>assets/img/icone-autodiagnostico.jpg" style="margin-left:0px" align="left"/>-->
                                                                    <p>
                                                                        <h3 style=" width:710px; line-height:100%; font-size:12.5px; padding-top:10px;">
                                                                            <?php echo $item->titulo; ?>
                                                                        </h3>
                                                                    </p>
                                                                    <p style=" font-size:12.5px;padding-top:50px; margin-left:75px;"><?php echo $item->descricao; ?></p>                                                                        
                                                                        <p style="font-size:12.5px; margin-left:75px;">Versão: <?php echo $dadosversao[0]['numero_versao']; ?></p>
                                                                        <p style="font-size:12.5px; margin-left:75px;">Formato: 
                                                                            <?php echo $dadosversao[0]['formato_arquivo']; ?>
                                                                             <?php echo $dadosversao[0]['descricao_extensao']==''?'':'('.$dadosversao[0]['descricao_extensao'].')'; ?>
                                                                        </p>
                                                                        <p  style=" font-size:12.5px;margin-left:75px;">Preço: <b style="color:#f7931e;" >R$ <?php echo $item->preco; ?></b></p>
                                                                         <p style=" margin-left:75px;font-size:12.5px;"><label><input type="checkbox" name="aceite-termos-<?php echo $dadosversao[0]['id_download_versoes']; ?>"> Li e aceito os <a class="various" data-fancybox-type="iframe" href="<? echo site_url('contato/aceite_me/4');?>">termos de uso</a></label></p>
									
                                                                        <p style=" margin-left:75px;font-size:12.5px;"><a href="<?  echo site_url('carrinho/adicionar/'.$dadosversao[0]['id_download_versoes'].'/DO/false');?>"><img src="<?php echo base_url();?>assets/img/btn-comprar-vermelho.jpg"/></a></p>
								</div>
								<?php endif; ?>
                                                       <?php endforeach; ?>

							<div class="pagination-courses">
								
							</div>
                                                    
                                                    <span class="voltar" style="text-transform: uppercase;color: #f7931e;float: right;margin-top: 20px;text-decoration: none;">
                                                        <a style="text-transform: uppercase;color:#f7931e;float: right;margin-top: 20px;text-decoration: none;" href="<?php echo site_url('central_downloads/lista_downloads');?>">Voltar</a></span>
						</div>
                                            <?php endif; ?>
                                        </div>
				</div>

				<div class="vejaTambem">
                                        <?php 
                                        
                                        //include("includes/veja-tambem.php"); 
                                        
                                        include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'veja-tambem-Business-store.php';
                                        ?>
				</div>


					         <?php 
                                        
                                            //include("includes/box-destaques-blog.php");
                                            include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'box-destaques-blog.php';
                                        
                                        ?>

               </div>
				<div class="right">
                                    <?php
						//include("includes/servicos-home.php");
                                               include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'servicos-home.php';
					?>
                </div>
            </div>

<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
?>
