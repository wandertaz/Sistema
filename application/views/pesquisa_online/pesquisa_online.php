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
                        <li><a>Pesquisa OnLine ></a></li>
                        <li><a href="<?php echo site_url('pesquisa_online/index'); ?>">Apresentação</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna pesquisa_online" style="width: 710px;overflow: hidden;padding: 0 11px;">

                    <h3 style="color:#F7931E;">Pesquisa ONLINE</h3>

                    <div class="texto-conteudo">
                        <?php if(isset($pagina) && $pagina): ?>
                                <?php echo $pagina->texto; ?>
                        <?php endif; ?>
                    </div>

                    <div class="boxes-passos-pesquisa-online clear-both">
                      <div class="passo-pesquisa-online icons-passos-pesquisa-online one">
                        <h6>Orçamento e Pagamento</h6>
                        <span>Realize seu orçamento sem compromisso</span>
                      </div>
                      <div class="passo-pesquisa-online icons-passos-pesquisa-online two">
                        <h6>Questionário e Base de Dados</h6>
                        <span>O consultor doa Portal cria um questionário inteligente. Você aprova e nos envia sua base de dados</span>
                      </div>
                      <div class="passo-pesquisa-online icons-passos-pesquisa-online three">
                        <h6>Pesquisa e Resultados</h6>
                        <span>As pesquisas são enviadas, podendo haver contato telefônico pelo consultor do Portal. Um relatório analítico é enviado pra você</span>
                      </div>
                    </div>

                    <div class="diferenciais-pesquisa-online clear-both">
                      <h5>Diferenciais</h5>
                      <ul>
                        <li>Pesquisas realizadas por especialistas experientes neste tipo de inferência</li>
                        <li>Sistema customizado às necessidades do cliente, com padrões variados de questões e respostas</li>
                        <li>Criação do questionário pelo consultor do Portal, que irá avaliar o melhor desenho das questões e possibilidades de resposta, de acordo com o público, expectativas de resultado e perfil do cliente.</li>
                        <li>Possibilidade de solicitar atualização de parte de sua base de dados, que lhe será entregue atualizada ao final da pesquisa(opcional).</li>
                        <li>Possibilidade de haver contato telefônico com os participantes da pesquisa, aumentando o índice de respostas e a segurança do resultado.</li>
                        <li>Relatório analítico, contendo gráficos, observações e recomendações, elaborado pelos especialistas em pesquisa.</li>
                        <li>Custo reduzido em relação ao mercado e à qualidade das pesquisas realizadas.</li>
                      </ul>
                    </div>

                    <div class="bt-to-right">
                        <a href="<?php echo site_url('pesquisa_online/dados_pessoais');?>"><img src="<?php echo base_url(); ?>/assets/img/btn-contratar.png" alt=""></a>
                    </div>
                    

                    

                  </div>
                    <div class="vejaTambem">
                            <?php 

                           

                            include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'veja-tambem-Business-store.php';
                            ?>
                    </div>
                    	         <?php 
                                        
                                        
                                           // include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'box-destaques-blog.php';
                                        
                                        ?>
                                                          
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
