
         <div id="footer">
                <div id="col-footer-1">
                  <h4>Mapa do site</h4>
                  <ul class="menu-footer ulboder">
                    <li style="width:74px;"><a href="home">HOME</a></li>
                    <li style="width:156px;"><a href="<?php echo $base_url;?>quem_somos/historia">QUEM SOMOS</a>
                     <ul>
                         <li><a href="<?php echo $base_url; ?>quem_somos/historia">Nossa História</a></li>
                       <li><a href="<?php echo $base_url;?>quem_somos/cultura">Cultura Organizacional</a></li>
                       <li><a href="<?php echo $base_url;?>quem_somos/diferenciais">Nossos Diferenciais</a></li>
                       <li><a href="<?php echo $base_url;?>quem_somos/clientes">Nossos Clientes</a></li>
                     </ul>
                    </li>
                    <li style="width:165px;"><a href="<?php echo $base_url;?>servicos/estrategias">SERVIÇOS</a>
                      <ul>
                       <li><a href="<?php echo $base_url;?>servicos/estrategias">Estratégias</a></li>
                       <li><a href="<?php echo $base_url;?>servicos/processos">Processos</a></li>
                       <li><a href="<?php echo $base_url;?>servicos/pessoas">Pessoas</a></li>
                       <li><a href="<?php echo $base_url;?>servicos/governanca_corporativa">Governança Corporativa</a></li>
                     </ul>
                    </li>
                    <li style="width:200px;"><a href="<?php echo $base_url;?>servicos/educacao_corporativa">EDUCAÇÃO CORPORATIVA</a>
                      <ul>
                       <li><a href="<?php echo $base_url;?>educacao_corporativa/cursos_abertos">Cursos Abertos</a></li>
                       <li><a href="<?php echo $base_url;?>educacao_corporativa/cursos_incompany">Cursos "in company"</a></li>
                       <li><a href="<?php echo $base_url;?>educacao_corporativa/programas_desenvolvimento">Programas de Desenvolvimento e Universidade Corporativa</a></li>
                       <li><a href="<?php echo $base_url;?>educacao_corporativa/alta_performance">Programa Alta Performance</a></li>
                       <li><a href="<?php echo $base_url;?>educacao_corporativa/elearning">E-Learning</a></li>
                     </ul>
                    </li>
                   <li style="width:115px;"><a href="<?php echo $base_url;?>publicacoes/revistas">PUBLICAÇÕES</a>
                      <ul>
                       <li><a href="<?php echo $base_url;?>publicacoes/revistas">Revista MB</a></li>
                       <li><a href="<?php echo $base_url;?>publicacoes/artigos">Artigos</a></li>
                       <li><a href="<?php echo $base_url;?>publicacoes/pesquisas">Pesquisas e Relatórios</a></li>
                     </ul>
                    </li>

                  </ul>
                  <ul class="menu-footer">
                  <li style="width:105px;"><a href="<?php echo $base_url;?>multimidia/videos">MULTIMÍDIA</a>
                     <ul>
                       <li><a href="<?php echo $base_url;?>multimidia/videos">Vídeos</a></li>
                       <li><a href="<?php echo $base_url;?>multimidia/podcasts">Áudios</a></li>
                       <li><a href="<?php echo $base_url;?>multimidia/galerias">Imagens</a></li>

                     </ul>
                  </li>
                  <li style="width:105px;"><a href="<?php echo $base_url;?>noticias/destaques">NOTÍCIAS</a>
                     <ul>
                       <li><a href="<?php echo $base_url;?>noticias/destaques">Destaques</a></li>
                       <li><a href="<?php echo $base_url;?>noticias/news">News</a></li>

                     </ul>
                  </li>
                  <li style="width:105px;"><a href="<?php echo $base_url;?>blog">BLOG</a></li>
                  <li style="width:105px;"><a href="faq">FAQ</a></li>
                  <!--<li style="width:105px;"><a href="#">CARREIRA</a></li>-->
                  <li style="width:135px;" class="abre-contato"><a class="various" data-fancybox-type="iframe" href="<?php echo $base_url;?>contato">CONTATO</a>
                       <ul>
                       <a class="various" data-fancybox-type="iframe" href="<?php echo $base_url;?>contato">Formulário de Contato</a>
                       <li><a href="localizacao">Localização</a></li>

                     </ul>
                  </li>
                  </ul>

                 <div id="footer-onde-estamos">
                   <h4>Onde estamos</h4>
                   <address>
                    Av. Constantino Nery , nº 2789 , sala 1006 a 1008<br />
                    Ed. Empire Center    -  CEP 69050 - 002   <br />
                    Chapada / Manaus / Amazonas<br />
                    <strong>Tel: +55 (92) 3656-2452     <br />
                    Telefax: +55 (92) 3656-5184  <br />
                    E-mail: mb@netmb.com.br</strong><br />
                   </address>
                 </div>


                 <?php if(!($this->session->userdata('SessionIdAluno')>0 || $this->session->userdata('SessionIdEmpresa')>0)): ?>
                 <div id="footer-login">
                   <h4>Login</h4>
                   <form>
                   <ul>
                     <li><label for="nome">Usuário</label><input type="text" name="nome" id="none" /></li>
                     <li><label for="senha">Senha</label><input type="text" name="senha" id="senha" /></li>
                     <li>
                     <input type="image" class="entrar" src="<?php echo $base_url; ?>assets/img/btn-footer-entrar.gif" width="130" height="15" name="entrar" />
                     </li>
                   </ul>

                   </form>
                 </div>
                 <?php endif; ?>



                </div>
                <div id="col-footer-2">
                  <div class="sobre">
                    <h5>Sobre a MB Consultoria</h5>
                    <p>Nossas soluções são voltadas para a Gestão Empresarial e a melhoria dos negócios dos clientes, em projetos                     sustentados pelo desenvolvimento das pessoas, construção de métodos e processos e o desenho de uma
                    arquitetura organizacional eficiente.</p>
                  </div>
                  <div class="sobre">
                    <h5>Acompanhe-nos</h5>
                     <ul>
                      <li><a href="#"><img src="<?php echo $base_url; ?>assets/img/ico-fb.gif" alt="facebook" />Facebook</a></li>
                      <li><a href="#"><img src="<?php echo $base_url; ?>assets/img/ico-tw.gif" alt="twitter" />Twitter</a></li>
                      <li><a href="#"><img src="<?php echo $base_url; ?>assets/img/ico-yt.gif" alt="You Tube" />You Tube</a></li>
                      <li><a href="#"><img src="<?php echo $base_url; ?>assets/img/ico-in.gif" alt="Linkedin" />Linkedin</a></li>
                      <li><a href="<?php echo site_url('home/rss'); ?>"><img src="<?php echo $base_url; ?>assets/img/ico-rss.gif" alt="rss" />RSS</a></li>

                     </ul>
                  </div>
                  <div class="assinatura">
                    <a href="#">
                    <img src="<?php echo $base_url; ?>assets/img/criacao-site.png" alt="criação de site" />
                    </a>
                  </div>
                </div>

        </div>
        </div>

        <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.maskedinput-1.3.min.js"></script>
        <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/radio.js"></script>
        <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/plugins.js"></script>
        <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/main.js"></script>
        <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.accordion.2.0.js"></script>
        <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/tinycarousel.js"></script>
        <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.sliderTabs.min.js"></script>
        <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/bancodetalentos.js"></script>
        <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.fancybox.pack.js"></script>

		<script type="text/javascript">
		$(document).ready(function() {
			$(".various").fancybox({
				maxWidth	: 800,
				maxHeight	: 800,
				fitToView	: false,
				width		: '70%',
				height		: '80%',
				autoSize	: false,
				closeClick	: false,
				scrolling   : 'no',
				openEffect	: 'none',
				closeEffect	: 'none'
			});
		});
		</script>
    </body>
</html>
