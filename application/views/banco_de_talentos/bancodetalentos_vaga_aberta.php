

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

          <!--  <hr>

            <h1 style="width:120px;">Vagas em Aberto</h1>-->

            <!-- Pra cada candidato, inserir a linha abaixo -->
            <div class="lista-vagas-destaque">


                <form id="form_cadastro_de_vagas" method="post" action="">
                    <div class="centerCursos equalH-meus-cursos bancodetalentos_content" style="padding: 15px 0 0 15px;width: 707px;">
                        <?php if ($vaga): ?>
                            <h2 style="float:left;" class="titulo-cargo"><?php echo $vaga->titulo_cargo; ?></h2>

                            <?php if ($this->session->userdata('logged_in_Aluno')): ?>
                                <?php if (valida_candidatura($vaga->id_vaga) == 0): ?>
                                    <a style="float:right;margin-right:8px;" class="various" data-fancybox-type="iframe" href="<?php echo site_url(); ?>candidatura/vaga/<?php echo $vaga->id_vaga; ?>"><img src="<?php echo base_url() ?>/assets/img/cadastrar-vaga.png" alt=""></a>
                                <?php else: ?>
                                    <a  style="float:right;margin-right:8px;" href="<?php echo site_url(); ?>bancodetalentos/remover_candidatura/<?php echo $vaga->id_vaga; ?>/<?php echo(retorno_id_curriculo()); ?>"> <img src="<?php echo base_url() ?>assets/img/bt-remover-candidatura.png" alt=""></a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <h3 class="empresa-this-vaga clear-both"><?php echo $vaga->empresa; ?><br /><span><?php echo $vaga->quantidade_vagas; ?> Vagas</span></h3>

                            <h1>Dados da Vaga</h1>
                            <ul id="description-vaga">
                                <li><strong>Faixa Salarial: </strong><span><?php echo $vaga->faixa_salarial && $vaga->exibir_faixa_salarial == 'S' ? $vaga->faixa_salarial->pretencaosalarial_nome : 'Confidencial'; ?></span></li>
                                <li><strong>Nível: </strong><span><?php echo $vaga->nome_nivel; ?></span></li>

                                <?php if (isset($vaga->areas_atuacao) && $vaga->areas_atuacao): ?>
                                    <li><strong>Área de Atuação: </strong>
                                        <span>
                                            <?php foreach ($vaga->areas_atuacao as $area_atuacao): ?>
                                                <?php echo $area_atuacao->nome_area; ?><br />
                                            <?php endforeach; ?>
                                        </span></li>
                                    <li><strong></strong><span></span></li>
                                <?php endif; ?>

                                <?php if ($vaga->grau_formacao): ?>
                                    <li><strong>Grau de Formação: </strong><span><?php echo $graus_formacao[$vaga->grau_formacao]; ?></span></li>
                                <?php endif; ?>

                                <?php if ($vaga->curso_formacao): ?>
                                    <li><strong>Curso(s) de Formação: </strong><span><?php echo $vaga->curso_formacao; ?></span></li>
                                <?php endif; ?>

                                <?php if ($vaga->experiencia): ?>
                                    <li><strong>Experiência: </strong><span><?php echo $vaga->experiencia; ?></span></li>
                                    <li><strong></strong><span></span></li>
                                <?php endif; ?>

                                <?php if ($vaga->conhecimentos_necessarios): ?>
                                    <li><strong>Habilidades e Conhecimentos Necessários: </strong><span><?php echo $vaga->conhecimentos_necessarios; ?></span></li>
                                    <li><strong></strong><span></span></li>
                                <?php endif; ?>

                                <?php if (isset($vaga->idiomas) && $vaga->idiomas): ?>
                                    <li><strong>Idiomas: </strong>
                                        <span>
                                            <?php foreach ($vaga->idiomas as $idioma): ?>
                                                <?php echo $idioma->nome_idioma; ?>
                                                (Leitura: <?php echo $idioma->nivel_leitura==''?'':$niveis_idiomas[$idioma->nivel_leitura]; ?>,
                                                Escrita: <?php echo $idioma->nivel_leitura==''?'':$niveis_idiomas[$idioma->nivel_escrita]; ?>,
                                                Conversação: <?php echo $idioma->nivel_leitura==''?'':$niveis_idiomas[$idioma->nivel_conversacao]; ?>)
                                                <br />
                                            <?php endforeach; ?>
                                        </span></li>
                                    <li><strong></strong><span></span></li>
                                <?php endif; ?>

                                <?php if ($vaga->beneficios): ?>
                                    <li><strong>Benifícios Oferecidos: </strong><span><?php echo $vaga->beneficios; ?></span></li>
                                <?php endif; ?>

                                <?php if ($vaga->regime_contratacao): ?>
                                    <li><strong>Regime de Contratação: </strong><span><?php echo $tipos_contrato[$vaga->regime_contratacao]; ?></span></li>
                                <?php endif; ?>

                                <?php if ($vaga->horario): ?>
                                    <li><strong>Horário de Trabalho: </strong><span><?php echo $vaga->horario; ?></span></li>
                                    <li><strong></strong><span></span></li>
                                <?php endif; ?>

                                <?php if ($vaga->informacoes_adicionais): ?>
                                    <li><strong>Informações Adicionais: </strong><span><?php echo $vaga->informacoes_adicionais; ?></span></li>
                                <?php endif; ?>
                            </ul>

                            <?php if ($this->session->userdata('logged_in_Aluno')): ?>
                                <ul id="actions-vaga">
                                    <li><a class="indicar-vaga no-border" class="various" data-fancybox-type="iframe" href="<?php echo site_url(); ?>gerenciamento_email/indicar_vaga_amigo/<?php echo $vaga->id_vaga; ?>">Indicar vaga a um amigo</a></li>
                                    <?php if (valida_candidatura($vaga->id_vaga) == 0): ?>
                                        <li style="margin: 27px 0 0 224px;"><a class="various" data-fancybox-type="iframe" href="<?php echo site_url(); ?>candidatura/vaga/<?php echo $vaga->id_vaga; ?>"><img src="<?php echo base_url() ?>/assets/img/cadastrar-vaga.png" alt=""></a></li>
                                    <?php else: ?>
                                        <li style="margin: 27px 0 0 224px;">  <a href="<?php echo site_url(); ?>bancodetalentos/remover_candidatura/<?php echo $vaga->id_vaga; ?>/<?php echo(retorno_id_curriculo()); ?>"> <img src="<?php echo base_url() ?>assets/img/bt-remover-candidatura.png" alt=""></a></li>
                                    <?php endif; ?>
                                </ul>
                            <?php else: ?>                            
                                <ul id="actions-vaga">
                                    <li><a class="various indicar-vaga no-border" data-fancybox-type="iframe" href="<?php echo site_url(); ?>gerenciamento_email/indicar_vaga_amigo/<?php echo $vaga->id_vaga; ?>">Indicar vaga a um amigo</a></li>
                                    
                                </ul>
                            <?php endif; ?>

                        <?php else: ?>
                            Vaga não encontrada
                        <?php endif; ?>
                    </div>
                </form>






            </div>
            <!-- Pra cada candidato, inserir a linha acima -->

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

