

<?php
include $_SERVER['DOCUMENT_ROOT'] . URL_VIEW_INCLUDES . 'topo.php';
?>

<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>

<?php //include("includes/banner-interna.php"); ?>

<div class="content">




    <div class="content-interna" style="width:990px; background:white;">

        <div class="centerCursos equalH-meus-cursos bancodetalentos_content" style="width:724px;">

            <div id="busca_bancodetalentos" style="padding:0px; padding-bottom:25px; padding-top:25px;">
                <!-- 	  <ul id="menu_busca_bancodetalentos">
                            <li><span class="title_menu">Buscar Empregos</span> <span class="triangulo_branco"></span></li>
                            <li><span class="title_menu">Buscar Currículo</span> <span class="triangulo_branco"></span></li>
                          </ul>
                          <form id="form_busca_bancodetalentos" action="">
                            <label id="inpt_busca_bancodetalentos" for="">
                              <input type="text" name="" id="" style="width:610px;" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">
                            </label>
                          </form> -->

                <ul id="menu_busca_bancodetalentos">    
                    <li id="busca_empregos" class="active"><span class="title_menu">Buscar Oportunidades</span> <span class="triangulo_branco"></span></li>   
                    <li id="busca_curriculo"><span class="title_menu">Buscar Profissionais</span> <span class="triangulo_branco"></span></li>    
                </ul>

                <form id="form_busca_bancodetalentos"  class="form_busca_vagas" method="post" action="<?php echo site_url(); ?>banco_talentos_vagas">
                    <label id="inpt_busca_bancodetalentos" for="">

                        <input type="text" style="width: 645px;" name="palavra_chave" id="" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       
                    </label>
                </form>


                <form id="form_busca_bancodetalentos" style="display:none;" class="form_busca_curriculos" method="post" action="<?php echo site_url(); ?>banco_talentos_curriculos/curriculo">
                    <label id="inpt_busca_bancodetalentos_curriculos" for="">
                        <?php //if(!$this->session->userdata('logged_in_Empresa')):?>
                        <input style="width: 475px;float: left;" type="text" name="palavra_chave" id="inpt_busca_bancodetalentos_curriculos" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       

                        <a style="float:left;display:block;color:#333; text-decoration:none;font-size: 14px;margin:-3px 0 0 20px;" href="<?php echo site_url(); ?>banco_talentos_curriculos/curriculo_busca_avancada">

                            <span style="width: 150px;">Pesquisa de Currículos</span><br />

                            <strong>Busca Avançada</strong>
                        </a>
                        <?php // else:?>
                            <!--<span style="text-align: left;width:300px;">Você deve estar logado para a pesquisa de curriculo!</span>-->
                        <?php //endif;?>    
                    </label>
                </form>




            </div>

            <?php if (isset($pagina) && $pagina): ?>
                <?php echo $pagina->texto; ?>
            <?php endif; ?>




            <!-- Pra cada candidato, inserir a linha abaixo -->
            <div class="lista-vagas-destaque">


                <form id="form_cadastro_de_vagas" method="post" action="<?php echo site_url(); ?>banco_talentos_curriculos/curriculo_busca_avancada_retorno">
                    <div class="centerCursos equalH-meus-cursos bancodetalentos_content">
                        <h1>Pesquisa Avançada de Currículos</h1>

                        <div id="cadastrar_vagas" class="holder_cadastro_curriculo">

                            <label for="titulodocargo_cadastrar_vagas"><span>Pesquisar Currículo</span>
                                <input type="text" name="palavra_chave" id="titulodocargo_cadastrar_vagas" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>

                            <div class="num-col-2 clear-both" style="margin-top:30px;">
                                <span class="label-cols">Nivel de Atuação </span>


                                <?php
                                $x = 1;
                                $media = 0;
                                foreach ($objetivosprofissionais_atuacao as $itens):
                                    $media = round($itens['qtd_media'] / 2) + $itens['qtd_media'] % 2;
                                    ?>
                                    <?php if ($x == 1 || $x == ($media + 1)): ?>
                                        <div class="col">
                                        <?php endif; ?>
                                        <label for="" class="inpt_checkbox"><input type="checkbox" name="nivel_atuacao[]"  value="<?php echo $itens['id_area']; ?>" id=""><span><?php echo $itens['nome_area']; ?></span></label>

                                        <?php if (($x == $media) || $x == $itens['qtd_media']): ?>


                                        </div>
                                        <?php
                                    endif;
                                    ?>

                                    <?php
                                    $x = $x + 1;
                                endforeach;
                                ?>

                            </div>

                            <div class="num-col-2 clear-both" style="margin-top:30px;"><span class="label-cols">Grau de Formação</span>

                                <div class="col">

                                    <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao" value="EF" id=""><span>Ensino Fundamental</span></label>
                                    <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao" value="EM" id=""><span>Ensino Médio</span></label>
                                    <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao" value="GR" id=""><span>Graduação</span></label>
                                    <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao" value="PG" id=""><span>Pós-graduação/ MBA</span></label>
                                    <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao" value="ME" id=""><span>Mestrado</span></label>
                                    <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao" value="DO" id=""><span>Doutoria</span></label>

                                </div>

                            </div>


                            <hr class="hr_sep" style="position: relative; top:-10px;" />

                            <div class="num-col-2 clear-both"><span class="label-cols">Área de Atuação </span>


                                <?php
                                $x = 1;
                                $media = 0;
                                foreach ($objetivosprofissionais_area_atuacao as $itens):
                                    $media = round($itens['qtd_media'] / 2) + $itens['qtd_media'] % 2;
                                    ?>
                                    <?php if ($x == 1 || $x == ($media + 1)): ?>
                                        <div class="col">
                                        <?php endif; ?>
                                        <label for="" class="inpt_checkbox"><input type="checkbox" name="area_atuacao[]"  value="<?php echo $itens['id_area']; ?>" id=""><span><?php echo $itens['nome_area']; ?></span></label>

                                        <?php if (($x == $media) || $x == $itens['qtd_media']): ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    $x = $x + 1;
                                endforeach;
                                ?>

                            </div>

                            <hr class="hr_sep" style="margin-bottom: 24px;" />

       <!--  <label for="" class="to-left"><span>Cursos de Formação </span><textarea name="" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" id="" cols="30" rows="5"></textarea></label>
        <label for="" class="to-left"><span>Qualificação (outros cursos importantes)</span><textarea name="" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" id="" cols="30" rows="5"></textarea></label>-->

                            <div class="num-col-2 clear-both">

                                <span class="label-cols">Faixa Salarial</span>
                                <?php
                                $x = 1;
                                $media = 0;
                                foreach ($objetivosprofissionais_pretencaosalarial as $itens):
                                    $media = round($itens['qtd_media'] / 2) + $itens['qtd_media'] % 2;
                                    ?>
                                    <?php if ($x == 1 || $x == ($media + 1)): ?>
                                        <div class="col">
                                        <?php endif; ?>
                                        <label for="" class="inpt_checkbox"><input type="radio" name="pretencaosalarial" value="<?php echo $itens['pretencaosalarial_id']; ?>"  id=""><span><?php echo $itens['pretencaosalarial_nome']; ?></span></label>

                                        <?php if (($x == $media) || $x == $itens['qtd_media']): ?>
                                        </div>

                                    <?php endif; ?>

                                    <?php
                                    $x = $x + 1;
                                endforeach;
                                ?>

                            </div>

<!--  <label for=""><span>Habilidade e conhecimentos necessários</span><textarea name="" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" id="" cols="30" rows="5"></textarea></label>-->
                            <hr class="hr_sep" style="position: relative; top:-10px;" />




                            <div class="num-col-2 clear-both">

                                <span class="label-cols">Idioma</span>
                                <?php
                                $x = 1;
                                $media = 0;
                                foreach ($idiomas_lista as $itens):
                                    $media = round($itens['qtd_media'] / 2) + $itens['qtd_media'] % 2;
                                    ?>
                                    <?php if ($x == 1 || $x == ($media + 1)): ?>
                                        <div class="col">
                                        <?php endif; ?>
                                        <label for="" class="inpt_checkbox"><input type="checkbox" name="idioma[]" value="<?php echo $itens['id_idioma']; ?>"  id=""><span><?php echo $itens['nome_idioma']; ?></span></label>

                                        <?php if (($x == $media) || $x == $itens['qtd_media']): ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    $x = $x + 1;

                                endforeach;
                                ?>

                            </div>




                            <hr class="hr_sep" style="position: relative; top:-10px;" />
                            <div class="secound_col hidden-bg">
                                <div class="num-col-2">
                                    <span class="label-cols">Disponibilidade de Horário </span>

                                    <div class="col">
                                        <?php
                                        $x = 1;
                                        $media = 0;
                                        foreach ($objetivosprofissionais_disponibilidade_horario as $itens):
                                            // $media = round($itens['qtd_media'] / 2) + $itens['qtd_media'] % 2;
                                            ?>
                                            <label for="" class="inpt_checkbox"><input type="radio" name="disponibilidadedehorario" value="<?php echo $itens['disponibilidadehorario_id']; ?>" id=""><span><?php echo $itens['disponibilidadehorario_nome']; ?></span></label>

                                            <?php
                                            $x = $x + 1;
                                        endforeach;
                                        ?>
                                    </div>

                                </div>
                            </div>


                            <label class="clear-both" for="">
                                <!--<span>Informações Adicionais</span><textarea name="" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" id="" cols="30" rows="5"></textarea>-->
                            </label>


                            <div class="set" style="border-top: 1px solid #ddd;margin-top: 20px;padding-top: 10px;">
                                <h3 class="clear-both" style="margin: 0;top: 21px;font-size: 13px; padding-left:67px;width: 36px;">Sexo</h3>
                                <div class="first_col">
                                    <label for="" class="inpt_checkbox"><input type="radio" name="sexo" value="" checked id=""><span>Indiferente</span></label>
                                    <label for="" class="inpt_checkbox"><input type="radio" name="sexo" value="M"   id=""><span>Masculino</span></label>
                                    <label for="" class="inpt_checkbox"><input type="radio" name="sexo" value="F" id="" ><span>Feminino</span></label>
                                </div>
                                <div class="secound_col_custom hidden-bg">
                                    <span style="position:relative;top:1px;padding-left: 12px;font-size:13px;">Idade</span>

                                    <label class="to-right clear-both" for="">
                                        <input type="radio" name="idade" value="1" id=""> <small>Entre</small>
                                        <input style="width: 54px;" class="inpt_cadastro_curriculo" size="5" type="text" name="faixaidadeinicial"> <small>anos e</small>
                                        <input style="width: 58px;" class="inpt_cadastro_curriculo" size="5" type="text" name="faixaidadefinal">
                                    </label>
                                    <label class="to-right clear-both" for="">
                                        <input type="radio" name="idade" value="2" id=""> <small>Inferior ou igual a:</small> <input style="width:101px;" class="inpt_cadastro_curriculo" size="5" type="text" name="faixaidadeinferior" id="" />
                                    </label>
                                    <label class="to-right clear-both" for="">
                                        <input type="radio" name="idade"  value="3" id=""> <small>Superior ou igual a:</small> <input style="width:95px;" class="inpt_cadastro_curriculo" size="5" type="text" name="faixaidadesuperior" id="" />
                                    </label>
                                </div>
                            </div>

                            <div class="clear-both">
                                <label for="titulodocargo_cadastrar_vagas">
                                    <span>Cidade onde reside</span>
                                    <input type="text" name="cidade" id="titulodocargo_cadastrar_vagas" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" />
                                </label>


                                <h3 class="clear-both" style="margin: 0;top: 21px;font-size: 13px; padding-left:67px;width: 36px;">Estado Civil</h3>
                                <?php foreach ($estados_civis as $flag_estado => $estado_civil): ?>
                                    <label for="" class="inpt_checkbox"><input type="radio" name="estado_civil" value="<?php echo $flag_estado; ?>" id="" class="inpt_checkbox"><span><?php echo $estado_civil; ?></span></label>
                                <?php endforeach; ?>

                                <h3 class="clear-both" style="margin: 0;top: 21px;font-size: 13px; padding-left:67px;width: 36px;">Portador de Necessidades Especiais?</h3>
                                <div class="first_col">
                                    <label for="" class="inpt_checkbox"><input type="radio" name="portador_necessidades" value="S"  id=""><span>Sim</span></label>
                                    <label for="" class="inpt_checkbox"><input type="radio" name="portador_necessidades" value="N"  id=""><span>Não</span></label>
                                </div>

                                <label for="titulodocargo_cadastrar_vagas">
                                    <span>Curso de Formação</span>
                                    <input type="text" name="curso_formacao" id="titulodocargo_cadastrar_vagas" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" />
                                </label>

                            </div>
                        </div>


                        <div>
                            <input class="salvar_cadastro_curriculo" type="submit" value="Salvar" />
                        </div>

                    </div>
                </form>



                <!-- Pra cada candidato, inserir a linha acima -->
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="right">           
            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'servicos-home.php';
            ?>
        </div>

    </div>


</div>

            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
            ?>

