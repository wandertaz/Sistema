<?php
include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>


<?php include("includes/banner-interna.php"); ?>

<div class="content">

    <div class="menuAreaRestrita">
        <h1>Área Restrita</h1>
        <ul>
            <li><a href="#">Cursos</a></li>
            <li class="selected"><a href="#">Banco de Talentos</a></li>
            <li><a href="#">Auto Diagnóstico</a></li>      
            <!--
            <li><a href="#">Central de Downloads</a></li>
            <li><a href="#">Gerenciamento de Usuários</a></li>
            <li><a href="#">Armazenamento na Nuvem</a></li>
            -->
        </ul>
    </div>


    <?php include('includes/busca-topo-bancodetalentos.php'); ?>

    <div class="content-interna" style="width:990px; background:white;">

        <!-- Left Sidebar -->
        <div class="left-cursos equalH-meus-cursos">
            <div class="miolo-interna">
                <?php include("includes/banco_de_talentos/menu_left.php"); ?>
            </div>
        </div>

        <form id="form_cadastro_de_vagas" method="post" action="<?php echo site_url(); ?>bancodetalentos_busca/curriculo_busca_avancada_retorno">
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
                            <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao" value="DO" id=""><span>Doutorado</span></label>

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
                </div>


                <div>
                    <input class="salvar_cadastro_curriculo" type="submit" value="Salvar" />
                </div>


        </form>
    </div>

    <!-- Right Sidebar -->
    <div class="rightMeusCursos">
<?php include("includes/banco_de_talentos/menu_right.php"); ?>
    </div>

</div>

 </div>

        <?php
        include("includes/rodape.php");
        ?>