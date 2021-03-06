<?php include("includes/topo.php"); ?>          
    <?php include("includes/banner-interna.php"); ?>            
<div class="content noticias">              
    <div class="content-interna">                
        <div class="left-internas">                  
            <div class="breadcrumb">                       
                <ul>                        
                    <li><a href="<?php echo site_url(); ?>index.php">Home ></a></li>                        
                    <li><a>Notícias ></a></li>                        
                    <li><a href="noticias/destaques">News</a></li>                        
                    <li><a href="noticias_abertas?id_noticia=<?php echo($noticias->id); ?>"><?php echo($noticias->titulo); ?></a></li>
                </ul>                  
            </div>                  
            <div class="miolo-interna noticias">                    
                <h3 style="color:#ff3600;">MB News</h3>                    
                <div class="txt-interna">
                    <p><?php echo($pagina->texto); ?></p>                    
                </div>				    
                <div class="box-search-noticias">				    
                    <h3 style=" width:206px; line-height:100%;">&nbsp;</h3>				    	
                    <input type="text" name="buscarCurso" id="buscarCurso" placeholder="Buscar arquivos" class="inputBuscarCurso" />
                    <input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />				    
                </div>                  
                <div class="txt-interna">                    
                    <div id="artigo-in-lista">					
                        <div class="miolo-interna">                     
                            <h2 class="h2-data-pesquisa"><?php echo(br_date_time($noticias->data, TRUE)); ?></h2>                      
                            <h3 class="h3-pesquisas"><?php echo($noticias->titulo); ?></h3>		             
                            <div class="box-foto" style="float:left;">
                                <img src="<? echo base_url(); ?>assets/img/noticia-1.jpg" alt="quem somos" width="375" align="left">                     
                                <span class="borda" style="position:relative; left:0px; top:0px;"></span>                     
                            </div>                     
                            <p style="margin-bottom: 20px; margin-right: 10px; width:375px;" class="textoArtigo">                          
                                <?php echo($noticias->texto); ?>                     
                            </p>                      
                            <div style=" height: 0; left: -100px; position:relative; top: -222px; width:87px; border:none;" id="lateral-left-publicacoes-artigos">                        
                                <div style="border-top:thin solid #9c9c9c; padding-top:10px; margin-top:7px;" class="ver-mais-artigos">                        	
                                    <img src="<? echo base_url(); ?>assets/img/icon-msg.png"><br />                        	
                                    <a href="#">Enviar por email</a>                        
                                </div>                        
                                <!--<div style="border-top:thin solid #9c9c9c;" class="ver-mais-artigos">                        	
                                    Compartilhar:<br/> <a href="#">
                                        <img src="<? echo base_url(); ?>assets/img/icon-facebook-black.png">
                                    </a>                        	
                                    <a href="#"><img src="<? echo base_url(); ?>assets/img/icon-twitter-black.png"></a>                        
                                </div>--> 
                                <?php include("includes/midia_social.php"); ?> 
                            </div>				
                            <a class="various" data-fancybox-type="iframe" href="<?php echo site_url(); ?>comentarios?ID=<?php echo$noticias->id ?>&area=NOT&tituloarea=MB na mídia - <?php echo $noticias->titulo; ?>">                       
                                <img src="<? echo base_url(); ?>assets/img/button-comentario.png" alt="Fazer um comentário" title="Fazer um comentário" />                   
                            </a>                      
                            <div id="publicacoes-artigos-comentarios" style="margin-left: -110px; width: 465px !important;">                      
                                <h3>comentários</h3>                      
                                <ul>                      	
                                    <?php foreach ($comentarios as $item): ?>
                                    <li>                             
                                        <?php echo $item->comentario ?>						
                                        <p class="autor-comentario">-<?php echo $item->nome ?></p>						
                                        <p class="data-comentario"><?php echo br_date_time($item->created) ?></p>                        
                                    </li>                          
                                    <?php endforeach ?>                      
                                </ul>                      
                            </div>                  
                        </div>            
                    </div>                    
                </div>                 
            </div>                
        </div>                
        <div class="center2">                 
            <div id="destaques" style="border:none;">                  
                <div class="depoimentos">                     
                    <h4>Últimas notícias</h4>                     
                    <h3>Destaques</h3>                     
                        <?php foreach ($noticia_destaque as $item): ?>                        
                            <h6><?php echo($item->titulo); ?></h6>                        
                            <p class="ultimosArtigos">                            
                                <?php echo(character_limiter($item->descricao, 200, '...')); ?>                             
                                    <a href="noticias_abertas?id_noticia=<?php echo($item->id); ?>">                                
                                        <img src="<? echo base_url(); ?>assets/img/btn-leia-mais-vermelho-preto.png">                                
                                    </a>                        
                            </p>                     
                        <?php endforeach; ?> 
                         <!--
                            <h4>&nbsp;</h4><br>
                            <h3>News</h3>                     
                                <?php //foreach ($noticia_news as $item): ?>                            
                                    <h6><?php //echo($item->titulo); ?></h6>                            
                                    <p class="ultimosArtigos"><?php //echo(character_limiter($item->descricao, 200, '...')); ?>                           
                                        <a href="noticias_abertas?id_noticia=<?php //echo($item->id); ?>">                            
                                            <img src="<? //echo base_url(); ?>assets/img/btn-leia-mais-vermelho-preto.png">                           
                                        </a>                            
                                    </p>                      
                                <?php //endforeach; ?>
                         -->
                                <h3>&nbsp;</h3><br><br>
                                <h3>MB na mídia</h3>                     
                                    <?php foreach ($noticia_mbmidia as $item): ?>                            
                                        <h6><?php echo($item->titulo); ?></h6>                            
                                        <p class="ultimosArtigos"><?php echo(character_limiter($item->descricao, 200, '...')); ?>                           
                                            <a href="noticias_abertas?id_noticia=<?php echo($item->id); ?>">                            
                                                <img src="<? echo base_url(); ?>assets/img/btn-leia-mais-vermelho-preto.png">                           
                                            </a>                            
                                        </p>                      
                                     <?php endforeach; ?>                  
                </div>                 
            </div>                
        </div>					
            <?php include("includes/box-destaques.php"); ?>              
    </div>              
    <div class="right">                	
        <?php include("includes/servicos-home.php"); ?>              
    </div>            
</div><?php include("includes/rodape.php"); ?>