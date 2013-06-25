
            <?php
                include $_SERVER['DOCUMENT_ROOT'] . URL_VIEW_INCLUDES . 'topo.php';
            ?>


            <?php
                include $_SERVER['DOCUMENT_ROOT'] . URL_VIEW_INCLUDES . 'banner-interna.php';
            ?>


            <div class="content">
              <div class="content-interna" style="background: #fff;">

                  <div class="breadcrumb" style="padding: 0 10px;">
                       <ul>
                        <li><a href="<?php echo site_url(); ?>">Home ></a></li>
                        <li><a>Pesquisa Online ></a></li>
                        <li><a><?php echo $pesquisa->titulo; ?></a></li>
                        
                       </ul>
                  </div>
                  <?php //print_r($pesquisa); ?>
                  <div class="miolo-interna pesquisa_online" style="width: 710px;overflow: hidden;padding: 0 11px;">

                    <h3 style="color:#F7931E;"><?php echo $pesquisa->titulo; ?></h3>

                    <div class="texto-conteudo" style="margin: 30px 0 0;">
                      <img class="logo-cliente-big" src="<?php echo site_url(); ?><?php echo$pesquisa->logo==''? 'assets/img/logo-do-cliente.png':'assets/uploads/logo/'.$pesquisa->logo;?>" alt="">
                      <?php if($this->session->flashdata('msg')):?>
                      <span><h4 style="color: red;"><?php echo $this->session->flashdata('msg'); ?></h4></span><br><br>
                      <?php else:?>
                            <span><?php echo $pesquisa->agradecimentos; ?></span><br><br>
                        <?php endif;?>
                       <span>Realização:</span><br><br>
                       <img class="logo-cliente-big" src="<?php echo site_url(); ?>/assets/img/logo-black.png" alt="" width="160"><br><br>
                       

                      <!--<div style="margin: 10px auto 20px;width: 475px;">
                          <a class="pesquisa_online_finalizacao-btns participar-bt" href="<?php echo site_url();?>">Ir para Home</a></div>-->
                    </div> 
     

                  </div>

        
            <?php
                include $_SERVER['DOCUMENT_ROOT'] . URL_VIEW_INCLUDES . 'box-destaques.php';
            ?>
              </div>
              <div class="right">

            <?php
                include $_SERVER['DOCUMENT_ROOT'] . URL_VIEW_INCLUDES . 'servicos-home.php';
            ?>
              </div>

            </div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . URL_VIEW_INCLUDES . 'rodape.php';
?>