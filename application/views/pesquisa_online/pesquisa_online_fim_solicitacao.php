<?php

  include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>

<?php

  include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>

            <div class="content">
              <div class="content-interna" style="background: #fff;">

                  <div class="breadcrumb" style="padding: 0 10px;">
                       <ul>
                        <li><a href="<?php echo site_url(); ?>">Home ></a></li>
                        <li><a>Pesquisa Online</a></li>                        
                       </ul>
                  </div>
                  <div class="miolo-interna pesquisa_online" style="width: 710px;overflow: hidden;padding: 0 11px;">

                    <h3 style="color:#F7931E;">FAÇA SEU ORÇAMENTO</h3>

                    <div class="texto-conteudo" style="margin: 30px 20px 20px;">                      

                       <span>Obrigado pela solicitação, em breve um colaborador da  MB Consultoria entrará em contato com você para dar continuidade a solicitação feita. </span><br><br>

                       <span>Agradecemos sua confiança.</span><br><br>

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