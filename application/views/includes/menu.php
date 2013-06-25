 <nav class="menu">
                	<ul>
                        <li><a href="<?php echo site_url(); ?>">HOME</a></li>
                        <li><a style="cursor:pointer;">QUEM SOMOS</a>
                            <ul class="sub-quemsomos">
                       		  <li><a href="<?php echo site_url('quem_somos/historia'); ?>">Nossa História</a></li>
                       		  <li><a href="<?php echo site_url('quem_somos/cultura'); ?>">Cultura Organizacional</a></li>
                       		  <li><a href="<?php echo site_url('quem_somos/diferenciais'); ?>">Nossos Diferenciais</a></li>
                              <li><a href="<?php echo site_url('quem_somos/clientes'); ?>">Nossos Clientes</a></li>
                     		</ul>
                        </li>
                        <li><a style="cursor:pointer;">NOSSO NEGÓCIO</a>
                            <ul class="sub-servicos">
                       		  <li><a href="<?php echo site_url('servicos/estrategias'); ?>">Estratégia</a></li>
                       		  <li><a href="<?php echo site_url('servicos/processos'); ?>">Processos</a></li>
                       		  <li><a href="<?php echo site_url('servicos/pessoas'); ?>">Pessoas</a></li>
                              <li><a href="<?php echo site_url('servicos/governanca_corporativa'); ?>">Governança Corporativa</a></li>
                     		</ul>
                        </li>
                        <li><a href="<?php echo site_url('educacao_corporativa'); ?>" style="cursor:pointer;">BUSINESS STORE</a>
                          <ul class="sub-programa">
                            <li>
                              <h5>Educação Corporativa</h5>
                              <ul>


                            <li><a href="<?php echo site_url('educacao_corporativa/cursos_abertos'); ?>">Cursos Abertos</a></li>
                            <li><a href="<?php echo site_url('educacao_corporativa/cursos_incompany'); ?>">Cursos "in company"</a></li>
                            <li><a href="<?php echo site_url('educacao_corporativa/alta_performance'); ?>">Programa Alta Performance</a></li>
                            <li><a href="<?php echo site_url('educacao_corporativa/programas_desenvolvimento'); ?>">Programas de Desenvolvimento e Universidade Corporativa</a></li>
                            <li><a href="<?php echo site_url('educacao_corporativa/elearning'); ?>">E-learning</a></li>




                              </ul>
                            </li>
                            <li>
                              <h5>Autodiagnóstico</h5>
                              <ul>
                                    <li><a href="<?php echo site_url('autodiagnosticos'); ?>">Oferecidos</a></li>

                              </ul>
                            </li>

                            <li>
                              <h5>Banco de Talentos</h5>
                              <ul>
                                    <li><a href="<?php echo site_url('banco_talentos_vagas'); ?>">Buscar Vagas e Curriculos</a></li>
                                    <li><a href="<?php echo $this->session->userdata('SessionIdAluno')? site_url('bancodetalentos/meucurriculo') :site_url('loginlogout/index?url=bancodetalentos/meucurriculo'); ?>">Cadastrar/ Atualizar Currículo</a></li>
                                    <li><a href="<?php echo $this->session->userdata('logged_in_Empresa') ||$this->session->userdata('logged_in_Permissao_Juridica')? site_url('bancodetalentos_empresa/cadastrar_vaga') :site_url('loginlogout/index?url=bancodetalentos_empresa/cadastrar_vaga'); ?>">Cadastrar/ Atualizar Vagas</a></li>

                              </ul>
                            </li>
                            
                             <li>
                              <h5>Central de Downloads</h5>
                              <ul>
                                    <li><a href="<?php echo site_url('central_downloads/lista_downloads'); ?>">Destaques</a></li>
                                    <?php
                                    $data=  retorna_downloads_categorias();
                                    
                                    if($data):
                                        foreach ($data as $categoria):
                                        ?>
                                            <li><a href="<?php echo site_url('central_downloads/selecao_downloads_categorias/'.$categoria['id_downloads_categorias']); ?>"><?php echo $categoria['nome_categoria']; ?></a></li>
                                        <?php   
                                        endforeach;
                                    endif;                                   
                                    ?>

                              </ul>
                            </li>
                            
                             <li>
                                 
                                    <h5>Pesquisa On-line</h5>
                                    <ul>                                   
                                          <li><a href="<?php echo site_url('pesquisa_online/index'); ?>">Acessar</a></li>
                                    </ul>
                            </li>
                                 
                                 
                                 
                                 
                                 
                   <!--           
                   <h5>Orçamento On-line</h5>
                              <ul>                                   
                                    <li><a href="<?php //echo site_url('orcamento_online/index/AI'); ?>">Auditoria Interna</a></li>
                                    <li><a href="<?php //echo site_url('orcamento_online/index/PB'); ?>">Orcamento PBQP-h</a></li>
                                    <li><a href="<?php //echo site_url('orcamento_online/index/GA'); ?>">ISO 14001</a></li>
                                    <li><a href="<?php //echo site_url('orcamento_online/index/GQ'); ?>">ISO 9001</a></li>
                                    <li><a href="<?php //echo site_url('orcamento_online/index/GS'); ?>">Gestão Responsabilidade Social</a></li>
                                    <li><a href="<?php //echo site_url('orcamento_online/index/SS'); ?>">Sistema Saúde e Segurança</a></li>
                                    <li><a href="<?php //echo site_url('orcamento_online/index/TR'); ?>">Treinamento</a></li>
                                    <li><a class="various" data-fancybox-type="iframe" href="<?php echo site_url('orcamento_online/novo_orcamento'); ?>">Orçamento Personalizado</a></li>
                                    
                                   
                                    

                              </ul>
                            </li>
                 -->           

                            <!-- <li>
                             <h5>Educação Corporativa</h5>
                              <ul>
                                <li><a href="">Cursos Abertos</a></li>
                                <li><a href="">Cursos "In Company"</a></li>
                                <li><a href="">Programas de Desenvolvimento e Universidade Corporativa</a></li>
                                <li><a href="">Programa de Alta Performance</a></li>
                                <li><a href="">e-Learning</li></a>
                              </ul>
                            </li>
                            <li class="last">
                              <h5>Educação Corporativa</h5>
                              <ul>
                                <li><a href="">Cursos Abertos</a></li>
                                <li><a href="">Cursos "In Company"</a></li>
                                <li><a href="">Programas de Desenvolvimento e Universidade Corporativa</a></li>
                                <li><a href="">Programa de Alta Performance</a></li>
                                <li><a href="">e-Learning</li></a>
                              </ul>
                            </li>-->




                            <?php /*
                            <li><a href="<?php echo site_url('educacao_corporativa/cursos_abertos'); ?>">Cursos Abertos</a></li>
                            <li><a href="<?php echo site_url('educacao_corporativa/cursos_incompany'); ?>">Cursos "in company"</a></li>
                            <li><a href="<?php echo site_url('educacao_corporativa/alta_performance'); ?>">Programa Alta Performance</a></li>
                            <li style="padding-left:20px;"><a href="<?php echo site_url('educacao_corporativa/programas_desenvolvimento'); ?>">Programas de Desenvolvimento e Universidade Corporativa</a></li>
                            <li><a href="<?php echo site_url('educacao_corporativa/elearning'); ?>">E-learning</a></li>
                            <li><a href="<?php echo site_url('autodiagnosticos'); ?>">Autodiagnósticos</a></li>
                            <!--<li><a href="#">E-Learning</a></li>-->
                            */?>
                          </ul>
                        </li>
                        <li><a style="cursor:pointer;">PUBLICA&Ccedil;&Otilde;ES</a>
                            <ul class="sub-publicacoes">
                      		 <li><a href="<?php echo site_url('publicacoes/revistas'); ?>">Periódicos</a></li>
                      		 <li><a href="<?php echo site_url('publicacoes/artigos'); ?>">Artigos</a></li>
                      		 <li><a href="<?php echo site_url('publicacoes/pesquisas'); ?>">Pesquisas e Estudos</a></li>
                     		</ul>
                        </li>
                        <li><a style="cursor:pointer;">MULTIMÍDIA</a>
                             <ul class="sub-multimidia">
                      			 <li><a href="<?php echo site_url('multimidia/videos'); ?>">Vídeos</a></li>
                       			 <li><a href="<?php echo site_url('multimidia/podcasts'); ?>">Áudios</a></li>
                       			 <li><a href="<?php echo site_url('multimidia/galerias'); ?>">Imagens</a></li>
                     		</ul>
                        </li>
                        <li><a style="cursor:pointer;">NOT&Iacute;CIAS</a>
                            <ul class="sub-noticias">
                       			<li><a href="<?php echo site_url('noticias/destaques'); ?>">Destaques</a></li>
                       			<li style="left:-15px;"><a href="<?php echo site_url('noticias/news'); ?>">News</a></li>
                                <li style="left:140px; width:110px; top:-24px;"><a href="<?php echo site_url('noticias/mb_na_midia'); ?>">MB na Mídia</a></li>
                     		</ul>
                        </li>
                        <li><a class="menu-blog" href="<?php echo site_url('blog'); ?>">BLOG</a></li>
                    </ul>
</nav>
