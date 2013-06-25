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
                        <li><a href="#">Bussiness Store > </a></li>
                        <li><a href="<?php echo site_url('central_downloads/lista_downloads');?>">Central de Downloads</a></li>
                       </ul>
                  </div>
				  <div class="miolo-interna">
                     <h3>Central de Downloads</h3>
<?php 

//print_r($central_downloads);
//exit();

?>
                     	<div class="text-cursos" style="float:left; margin-left:75px; width:600px; margin-top:20px; margin-bottom:10px;">
					    	<?php if(isset($pagina) && $pagina): ?>
					        	<?php echo $pagina->texto; ?>
					        <?php endif; ?>
					    </div>                     
                    
                    <!-- menu de categorias-->             
                    <div class="categorias_central_downloads_box">
                           <ul id="categorias_central_downloads_container">
                             <?php foreach ($menu as $value): ?>           
                                    <?php if ($value['id']==0):?>
                                          <li class="cat_central_downloads-item">
                                             <a href="<?php echo site_url('central_downloads/lista_downloads/');?>">
                                                 <?php echo $value['nome'];?>
                                             </a>
                                         </li>
                                    <?php else:?>
                                         <li class="<?php echo $value['selected']==1?'cat_central_downloads-item selected':'cat_central_downloads-item'?>">
                                             <a href="<?php echo $value['selected']==1?'#' :site_url('central_downloads/selecao_downloads_categorias/'.$value['id']);?>">
                                                 <?php echo $value['nome'];?>
                                             </a>
                                         </li>
                                    <?php endif;?>
                             <?php endforeach; ?>                            
                           </ul>         
                     </div>
                     <!-- menu de categorias-->
                     
                     <div class="box-search-cursos" style="margin-bottom:20px;">
					    	<h3 style=" width:442px; line-height:100%; font-size:12.5px; padding-top:10px;">Arquivos<br><?php echo($nome_categoria[0]->nome_categoria); ?></h3>
					    	<form action="<?php echo site_url('central_downloads/lista_downloads_categorias');?>" method="GET">
								<input type="text" name="busca" id="buscarArquivo" placeholder="Buscar Arquivo" class="inputBuscarCurso">
						    	<input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso">
					    	</form>
					    </div>

					 <div style="clear:both;"></div>

              <?php if($central_downloads): ?>
              <div style="width:700px; min-height:300px; margin-left:30px;">
              <?php foreach($central_downloads as $item): ?>
              <?php
               
              $dadosversao = retorna_ultima_versao_downloads($item->id_downloads, $busca);
 //print_r($dadosversao);
              if($dadosversao):
              ?>
              <div class="lista-autodiagnostico" style="margin-top:15px; margin-bottom:10px">
              <a href="<?  echo site_url('central_downloads/lista_downloads_aberto/'.$dadosversao[0]['id_download_versoes']);?>">
                 
            <?php if($dadosversao[0]['descricao_extensao']=='audio'): ?>
                  <img src="<?php echo base_url();?>assets/img/icone-autodiagnostico-texto-audio.png" style="margin-left:0px" align="left"/>
            <?php elseif($dadosversao[0]['descricao_extensao']=='video'): ?>
                  <img src="<?php echo base_url();?>assets/img/icone-autodiagnostico-texto-video.png" style="margin-left:0px" align="left"/>
            <?php elseif($dadosversao[0]['descricao_extensao']=='texto'): ?>
                  <img src="<?php echo base_url();?>assets/img/icone-autodiagnostico-texto.png" style="margin-left:0px" align="left"/>
           <?php elseif($dadosversao[0]['descricao_extensao']=='planilha'): ?>
                  <img src="<?php echo base_url();?>assets/img/icone-autodiagnostico-planilha.png" style="margin-left:0px" align="left"/>
            <?php elseif($dadosversao[0]['descricao_extensao']=='slide'): ?>                       
                  <img src="<?php echo base_url();?>assets/img/icone-autodiagnostico-apresentacao.png" style="margin-left:0px" align="left"/>
           <?php else:?>
                  <img src="<?php echo base_url();?>assets/img/icone-autodiagnostico-download.png" style="margin-left:0px" align="left"/>
           <?php endif;?>
                  
                  
                  
                <h2><?php echo $item->titulo; ?></h2>
                <p><?php echo $item->descricao; ?></p>
                <span>
               <p>Versão: <?php echo $dadosversao[0]['numero_versao']; ?></p>
               <p>Extensão: <?php echo $dadosversao[0]['formato_arquivo'].'('.$dadosversao[0]['descricao_extensao'].')'; ?></p>
               </span>
              </a>    
              <p>
                <label>
                  <input type="checkbox" name="aceite-termos-<?php echo $dadosversao[0]['id_download_versoes']; ?>">
                  Li e aceito os <a class="various" data-fancybox-type="iframe" href="<? echo site_url('contato/aceite_me/4');?>">termos de uso</a>
                </label>
              </p>
                <h3 style="position:relative; clear: both;">R$ <?php echo $item->preco; ?></h3>
              
              <p>
                <a href="<?  echo site_url('carrinho/adicionar/'.$dadosversao[0]['id_download_versoes'].'/DO/false');?>">
                  <img src="<?php echo base_url();?>assets/img/btn-comprar-peq.png"/>
                </a>
              </p>
              </div>
              <?php endif; ?>
              <?php endforeach; ?>

              <div class="pagination-courses">
              <?php echo $paginacao ? $paginacao : ''; ?>
              </div>
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
