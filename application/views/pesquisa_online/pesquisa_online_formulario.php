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
                        <li><a>Pesquisa Online ></a></li>                       
                       </ul>
                  </div>
                  <div class="miolo-interna pesquisa_online" style="width: 710px;overflow: hidden;padding: 0 11px;">

                    <h3 style="color:#F7931E;">Faça seu Orçamento</h3>

                    <div class="texto-conteudo" style="margin: 30px 0 0;">
                      <strong>Responda as questões abaixo, para a geração e exibição do orçamento para a Pesquisa</strong><br><br>
                       
                      <span class="red">(*) Informações de preenchimento obrigatório.</span><br>    
                    </div> 

                    <div class="box-form-pesquisa-online clear-both">
                        <form action="<?php echo site_url('pesquisa_online/salvar_orcamento/'.$id_orcamento);?>" id="form_pesquisa_orcamento" method="post" class="clear-both">
                        <ul class="clear-both">
                          <li class="clear-both">
                            <div class="label-el-box">1. Tipo de pesquisa a ser realizada<span class="red">*</span></div>
                            <div class="el-box">
                              <label class="el" for=""><input type="radio" name="tipo_pesquisa" value="Pesquisa de satisfação de clientes">Pesquisa de satisfação de clientes</label>
                              <label class="el" for=""><input type="radio" name="tipo_pesquisa" value="Pesquisa de mercado">Pesquisa de mercado</label>
                              <label class="el" for=""><input type="radio" name="tipo_pesquisa" value="Pesquisa de opinião">Pesquisa de opinião</label>
                              <label class="el" for=""><input type="radio" name="tipo_pesquisa" value="Pesquisa de clima organizacional">Pesquisa de clima organizacional</label>
                              <label class="el" for=""><input type="radio" name="tipo_pesquisa" value="Outra">Outra</label>
                            </div>
                          </li>

                          <li class="clear-both">
                            <div class="label-el-box">2. A base de dados do público-alvo para a pesquisa já está preparada e 100% atualizada?<span class="red">*</span></div>
                            <div class="el-box">
                                <label class="el" for=""><input type="radio" name="base_dados" value="0">Sim. Totalmente atualizada e checada.</label>
                                <label class="el" for=""><input type="radio" name="base_dados"  value="1">Sim. Entretanto, pode precisar de alguma atualização.</label>
                                <label class="el" for=""><input type="radio" name="base_dados" value="2">Não. Temos a base, mas os dados podem estar bastante desatualizados.</label>
                                <label class="el" for=""><input type="radio" name="base_dados" value="3">Não. Precisamos que a MB defina totalmente a base de dados e seus contatos.</label>
                            </div>
                          </li>

                          <li class="clear-both">
                            <div class="label-el-box">3. Localização das pessoas que devem ser contactadas<span class="red">*</span></div>
                            <div class="el-box">
                                <label class="el" for=""><input type="radio" name="local_pesquisa" value="0">Manaus/AM e Região Metropolitana</label>
                                <label class="el" for=""><input type="radio" name="local_pesquisa" value="1">Capitais de todas as Regiões do Brasil</label>
                                <label class="el" for=""><input type="radio" name="local_pesquisa" value="2">Cidades do interior em todas as Regiões do Brasil</label>
                                <label class="el" for=""><input type="radio" name="local_pesquisa" value="3">Distribuídas em várias cidades (interior e capitais) em todo o Brasil</label>
                              <small>(apesar de realizada via web, pode ser necessário contato telefônico com o público-alvo da pesquisa)</small>
                            </div>
                          </li>

                          <li class="clear-both">
                            <div class="label-el-box">4. Quantidade de pessoas devem ser contatadas nesta pesquisa<span class="red">*</span></div>
                            <div class="el-box">
                              <label class="el" for=""><input type="radio" name="qtd_pessoas_pesquisadas" value="0">Até 50 pessoas</label>
                              <label class="el" for=""><input type="radio" name="qtd_pessoas_pesquisadas" value="1">51 a 200 pessoas</label>
                              <label class="el" for=""><input type="radio" name="qtd_pessoas_pesquisadas" value="2">201 a 400 pessoas</label>
                              <label class="el" for=""><input type="radio" name="qtd_pessoas_pesquisadas" value="3">401 a 800 pessoas</label>
                              <label class="el" for=""><input type="radio" name="qtd_pessoas_pesquisadas" value="4">Acima de 800 pessoas</label>
                            </div>
                          </li>

                          <li class="clear-both">
                            <div class="label-el-box">5. Tamanho do questionário a ser aaplicado<span class="red">*</span></div>
                            <div class="el-box">
                                <label class="el" for=""><input type="radio" name="tamanho_questionario" value="10">Até 10 questões</label>
                                <label class="el" for=""><input type="radio" name="tamanho_questionario" value="20">11 a 20 questões</label>
                                <label class="el" for=""><input type="radio" name="tamanho_questionario" value="40">21 a 40 questões</label>
                                <label class="el" for=""><input type="radio" name="tamanho_questionario" value="41">Acima de 40 questões (em geral, não recomendamos, a não ser em exceções)</label>
                                <label class="el" for=""><input type="radio" name="tamanho_questionario" value="0">Não sei</label>
                            </div>
                          </li>

                          <li class="clear-both">
                            <div class="label-el-box">6. Descreva o(s) problema(s)/ situação(ões) específico(s) que gostaria de abordar em sua pesquisa<span class="red">*</span></div>
                            <div class="el-box">
                              <label class="el el-textarea" for=""><textarea name="problemas" id=""></textarea></label>
                            </div>
                          </li>

                          <li class="clear-both">
                            <div class="label-el-box">7. Identifique questões de interesse que gostaria de conhecer junto ao seu público-alvo<span class="red">*</span></div>
                            <div class="el-box">
                              <label class="el el-textarea" for=""><textarea name="questoes_interesse" id=""></textarea></label>
                            </div>
                          </li>

                          <li class="clear-both">
                            <div class="label-el-box">8. Descreva perguntas que porventura já tenha elaborado</div>
                            <div class="el-box">
                              <label class="el el-textarea" for=""><textarea name="perguntas" id=""></textarea></label>
                            </div>
                          </li>

                          <li class="clear-both">
                            <div class="label-el-box">9. Gostaria de acrescentar alguma outra informação ou cuidado/pontos de atenção que julga importantes na realização desta pesquisa?</div>
                            <div class="el-box">
                              <label class="el el-textarea" for=""><textarea name="informacoes" id=""></textarea></label>
                            </div>
                          </li>

                          <li class="clear-both">
                            <div class="label-el-box"></div>
                            <div class="el-box" style="float: right;margin-right: 30px;">
                                <input type="button" class="pesquisa_online_formulario-btns cancelar-bt" onclick="javascritp: window.location='<?php echo site_url()?>'">
                                <input class="pesquisa_online_formulario-btns enviar-bt" type="submit" value="Enviar">
                            </div>
                          </li>

                        </ul>
                      </form>
                    </div>
                    <div class="vejaTambem">
                            <?php 

                           

                            include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'veja-tambem-Business-store.php';
                            ?>
                    </div>

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