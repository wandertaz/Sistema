

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

            <div id="busca_bancodetalentos" style="padding:0px; padding-top:25px;">

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
                        
                        <input style="width: 475px;float: left;" type="text" name="palavra_chave" id="inpt_busca_bancodetalentos_curriculos" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       

                        <a style="float:left;display:block;color:#333; text-decoration:none;font-size: 14px;margin:-3px 0 0 20px;" href="<?php echo site_url(); ?>banco_talentos_curriculos/curriculo_busca_avancada">

                            <span style="width: 150px;">Pesquisa de Currículos</span><br />

                            <strong>Busca Avançada</strong>
                        </a>
     
                    </label>
                </form>




            </div>

            <?php if (isset($pagina) && $pagina): ?>
                <?php echo $pagina->texto; ?>
            <?php endif; ?>
            
            <div class="categorias_central_downloads_box no-margin">
                
            <ul id="categorias_central_downloads_container">
                <!--<li class="cat_central_downloads-item"><a href="<?php //echo site_url('banco_talentos_vagas'); ?>">Buscar Vagas e Curriculos</a></li>-->
                <li class="cat_central_downloads-item"><a href="<?php echo $this->session->userdata('SessionIdAluno')? site_url('bancodetalentos/meucurriculo') :site_url('loginlogout/index?url=bancodetalentos/meucurriculo'); ?>">Cadastrar/ Atualizar Currículo</a></li>
                <li class="cat_central_downloads-item"><a href="<?php echo $this->session->userdata('logged_in_Empresa') ||$this->session->userdata('logged_in_Permissao_Juridica')? site_url('bancodetalentos_empresa/cadastrar_vaga') :site_url('loginlogout/index?url=bancodetalentos_empresa/cadastrar_vaga'); ?>">Cadastrar/ Atualizar Vagas</a></li>
            </ul>
            </div>
            
            <hr>
            
            <h1 style="width:100px;">Vagas em Aberto</h1>

            <!-- Pra cada candidato, inserir a linha abaixo -->
            <div class="lista-vagas-destaque">
                <?php if ($vagas): ?>
                    <label style="width:220px;font-size:16px;float:right;margin-top:-52px;margin-right: 10px;">Foram encontradas <?php echo count($vagas); ?> vagas</label>
                <?php endif; ?>  
                <?php if ($vagas): ?>
                    <?php foreach ($vagas as $vaga): ?>
                        <div class="vaga">
                            <h1><?php echo $vaga->titulo_cargo; ?></h1>
                            <h2><?php echo $vaga->empresa; ?></h2> . <span class="quantidade-vagas"><?php echo $vaga->quantidade_vagas; ?> Vaga(s)</span>
                            <p><?php echo $vaga->descricao; ?></p>
                            <span class="nivel">
                                <h1>Nível</h1>
                                <h2><?php echo $vaga->nome_nivel; ?></h2>
                            </span>

                            <?php if ($vaga->exibir_faixa_salarial == 'S' && isset($vaga->faixa_salarial) && $vaga->faixa_salarial): ?>
                                <span class="faixa-salarial">
                                    <h1>Faixa Salarial</h1>
                                    <h2><?php echo $vaga->faixa_salarial->pretencaosalarial_nome; ?></h2>
                                </span>
                            <?php endif; ?>
                            <?php if ($this->session->userdata('logged_in_Aluno')): ?>
                                <?php if (testa_curriculo($this->session->userdata('SessionIdAluno')) > 0): ?>
                                    <a href="<?php echo site_url(); ?>bancodetalentos/detalhes_vaga/<?php echo $vaga->id_vaga; ?>">
                                        <img src="<?php echo base_url(); ?>assets/img/btn-ver-vaga.png">
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo site_url('home?msg=3'); ?>">
                                        <img src="<?php echo base_url(); ?>assets/img/btn-ver-vaga.png">
                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <!--<a href="<?php echo site_url('home?msg=33333'); ?>">
                                    <img src="<?php echo base_url(); ?>assets/img/btn-ver-vaga.png">
                                </a>-->
                            
                                    <a href="<?php echo site_url(); ?>banco_talentos_vagas/detalhes_vaga/<?php echo $vaga->id_vaga; ?>">
                                        <img src="<?php echo base_url(); ?>assets/img/btn-ver-vaga.png">
                                    </a>
                            
                            
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>                    
               <div style="width: 740px;">
                 <h1><center>Nenhuma Vaga foi encontrada!</center></h1>
               </div>
                <?php endif; ?>
            </div>
            <!-- Pra cada candidato, inserir a linha acima -->

            
            <div class="vejaTambem">					
               <?php
                   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'veja-tambem-Business-store.php';
                   ?>
           </div>
               <?php
                      // include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'box-destaques-blog.php';
                   ?>
            
            </div>
        


        <!-- Right Sidebar -->
        <div class="right">
            <?php include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'servicos-home.php'; ?>
        </div>

    </div>


</div>

<?php
include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
?>

