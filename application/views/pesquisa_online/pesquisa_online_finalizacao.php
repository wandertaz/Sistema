<?php

  include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>


          <?php           
            
            include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
            
            //print_r($pesquisa);
          ?>

            <div class="content">
              <div class="content-interna" style="background: #fff;">

                  <div class="breadcrumb" style="padding: 0 10px;">
                       <ul>
                        <li><a href="<?php echo site_url(); ?>">Home ></a></li>
                        <li><a>Pesquisa Online ></a></li>
                        <li><a href="<?php echo site_url('multimidia/videos'); ?>">Valores</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna pesquisa_online" style="width: 710px;overflow: hidden;padding: 0 11px;">

                    <h3 style="color:#F7931E;">Faça seu Orçamento</h3>

                    <div class="texto-conteudo" style="margin: 30px 0 0;">
                      <span><strong><?php echo $pesquisa['nome_responsavel']!=''? $pesquisa['nome_responsavel']: $pesquisa['nome_empresa'];?></strong> agradecemos seu interesse</span><br><br>

                      <strong>Sua Pesquisa está orçada em R$ <?php echo number_format($pesquisa['valor_orcamento'], 2);?> (<?php echo valorPorExtenso($pesquisa['valor_orcamento']) ?>) .</strong><br><br>

                      <span>(*) Em caso de inconsistência nas informações relatadas no Formulário de Orçamento, a pesquisa será paralisada e a MB Consultoria entrará em contato para checar os dados, podendo alterar o orçamento acima apresentado.</span><br><br>
                       
                      <strong> Gostaria de dar continuidade ao processo de compra e realização da pesquisa, declarando estar de acordo com os <a class="various" data-fancybox-type="iframe" href="<?php echo site_url('contato/aceite_me/8')?>">termos de uso</a>?</strong><br><br>
                      
                     
  

                      <div style="margin: 10px auto 20px;width: 475px;">
                          <a class="pesquisa_online_finalizacao-btns nao-bt" href="<?php echo site_url();?>">Não, Obrigado</a><a class="pesquisa_online_finalizacao-btns sim-bt" href="<?php echo site_url('pesquisa_online/aceitou_termos/'.$pesquisa['id_orcamento']);?>"> Sim, Gostaria</a></div>
                    </div> 
     

                  </div>
                  
                    <div class="vejaTambem">
                            <?php 

                           

                            include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'veja-tambem-Business-store.php';
                            ?>
                    </div>
                  
                  
                  

          <?php 
          include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'box-destaques.php';
          
          
          ?>
              </div>
              <div class="right">
                  <?php          
                    include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'servicos-home.php';
                ?>
              </div>

            </div>

            <?php
                    include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
            ?>