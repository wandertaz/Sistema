
		<nav id="main-nav">
			<ul>
				<li><a href="<?php echo site_url('multitools/home');?>" title="" class="dashboard no-submenu">Home</a></li>

                                <?php if($this->session->userdata('tipo')=='A'): ?>
                                    <li><a href="<?php echo site_url('multitools/usuarios'); ?>" title="" class="no-submenu">Colaboradores MB Consultoria</a></li>
                                    <li><a href="<?php echo site_url('multitools/paginas'); ?>" title="" class="no-submenu">P&aacute;ginas</a></li>
                                    <li><a href="<?php echo site_url('multitools/banners'); ?>" title="" class="no-submenu">Banners Home/Publicit&aacute;rios</a></li>
                                    <li><a href="<?php echo site_url('multitools/enquetes'); ?>" title="" class="no-submenu">Enquetes</a></li>
                                    <li><a href="<?php echo site_url('multitools/projetos'); ?>" title="" class="no-submenu">Servi&ccedil;os - Projetos</a></li>

                                <li>
					<a href="<?php echo site_url('multitools/paginas'); ?>" title="" class="">Publica&ccedil;&otilde;es</a>
					<ul>
						<li><a href="<?php echo site_url('multitools/revistas'); ?>" title="" class="no-submenu">Revista MB</a></li>
						<li><a href="<?php echo site_url('multitools/artigos'); ?>" title="" class="no-submenu">Artigos</a></li>
						<li><a href="<?php echo site_url('multitools/pesquisas_estudos'); ?>" title="" class="no-submenu">Pesquisas e Estudos</a></li>
					</ul>
				</li>

				<li>
					<a href="<?php echo site_url('multitools/paginas'); ?>" title="" class="">Multim&iacute;dia</a>
					<ul>
						<li><a href="<?php echo site_url('multitools/videos'); ?>" title="" class="no-submenu">V&iacute;deos</a></li>
						<li><a href="<?php echo site_url('multitools/podcasts'); ?>" title="" class="no-submenu">&Aacute;udios</a></li>
						<li><a href="<?php echo site_url('multitools/galerias'); ?>" title="" class="no-submenu">Galeria de Fotos</a></li>
					</ul>
				</li>

				<li>
					<a href="<?php echo site_url('multitools/noticias'); ?>" title="" class="">Notícias</a>
					<ul>
						<li><a href="<?php echo site_url('multitools/noticias/index/D'); ?>" title="" class="no-submenu">Destaques</a></li>
						<li><a href="<?php echo site_url('multitools/noticias/index/N'); ?>" title="" class="no-submenu">News</a></li>
						<li><a href="<?php echo site_url('multitools/noticias/index/M'); ?>" title="" class="no-submenu">MB na mídia</a></li>
					</ul>
				</li>
                                <?php endif;?>
                                <?php if($this->session->userdata('tipo')=='A' || $this->session->userdata('tipo')=='C'): ?>
				<li>
					<a href="<?php echo site_url('multitools/paginas'); ?>" title="" class="">Blog</a>
					<ul>
						<li><a href="<?php echo site_url('multitools/posts_categorias'); ?>" title="" class="no-submenu">Categorias</a></li>
                                                <?php if($this->session->userdata('tipo')=='A'): ?>
                                                    <li><a href="<?php echo site_url('multitools/posts_colunistas'); ?>" title="" class="no-submenu">Colunistas</a></li>
                                                <?php endif;?>
						<li><a href="<?php echo site_url('multitools/posts'); ?>" title="" class="no-submenu">Posts</a></li>
					</ul>
				</li>
                                <?php endif;?>
                                <?php if($this->session->userdata('tipo')=='A'): ?>
                                    <li><a href="<?php echo site_url('multitools/depoimentos'); ?>" title="" class="no-submenu">Depoimentos</a></li>

                                    <li><a href="<?php echo site_url('multitools/comentarios'); ?>" title="" class="no-submenu">Coment&aacute;rios</a></li>
                                    <li><a href="<?php echo site_url('multitools/emails_news'); ?>" title="" class="no-submenu">E-mails Cadastrados</a></li>
                                    <li><a href="<?php echo site_url('multitools/avaliacoes_perguntas'); ?>" title="" class="no-submenu">Perguntas - Avalia&ccedil;&otilde;es</a></li>
                                    <li><a href="<?php echo site_url('multitools/inscritos/index/J'); ?>" title="" class="no-submenu">Empresas</a></li>
                                <?php endif;?>
				<?php if($this->session->userdata('tipo')=='A' || $this->session->userdata('tipo')=='I'): ?>
                                <li>
					<a href="" title="" class="">Cursos Abertos</a>
					<ul>
                                                <?php if($this->session->userdata('tipo')=='A'): ?>
                                                    <li><a href="<?php echo site_url('multitools/cursos_abertos'); ?>" title="" class="no-submenu">Cursos</a></li>
                                                <?php endif;?>
						<li><a href="<?php echo site_url('multitools/turmas/index/AB'); ?>" title="" class="no-submenu">Turmas</a></li>
                                                <?php if($this->session->userdata('tipo')=='A'): ?>
                                                    <li><a href="<?php echo site_url('multitools/inscritos'); ?>" title="" class="no-submenu">Usuários Cadastrados</a></li>
                                                    <li><a href="<?php echo site_url('multitools/inscricoes/index/AB'); ?>" title="" class="no-submenu">Compras/Inscri&ccedil;&otilde;es</a></li>
                                                <?php endif;?>
						<li><a href="<?php echo site_url('multitools/aulas/index/AB'); ?>" title="" class="no-submenu">Aulas</a></li>
						<li><a href="<?php echo site_url('multitools/faltas/index/AB'); ?>" title="" class="no-submenu">Faltas</a></li>
						<li><a href="<?php echo site_url('multitools/notas/index/AB'); ?>" title="" class="no-submenu">Notas</a></li>
						<li><a href="<?php echo site_url('multitools/arquivos/index/AB'); ?>" title="" class="no-submenu">Arquivos</a></li>
						<!--<li><a href="<?php //echo site_url('multitools/avaliacoes/index/AB'); ?>" title="" class="no-submenu">Avalia&ccedil;&otilde;es</a></li>-->
                                                    <li><a href="<?php echo site_url('multitools/certificados/index/AB'); ?>" title="" class="no-submenu">Libera&ccedil;&atilde;o de Certificados</a></li>
                                                <?php if($this->session->userdata('tipo')=='A'): ?>
                                                    <li><a href="<?php echo site_url('multitools/avise/index/AB'); ?>" title="" class="no-submenu">Avise-me</a></li>
                                                <?php endif;?>
					</ul>
				</li>

				<li>
					<a href="" title="" class="">Cursos "In Company"</a>
					<ul>
						<?php if($this->session->userdata('tipo')=='A'): ?>
                                                    <li><a href="<?php echo site_url('multitools/cursos_incompany'); ?>" title="" class="no-submenu">Cursos</a></li>
                                                    <li><a href="<?php echo site_url('multitools/inscritos'); ?>" title="" class="no-submenu">Usuários Cadastrados</a></li>
                                                    <li><a href="<?php echo site_url('multitools/inscricoes_empresas/index/IN'); ?>" title="" class="no-submenu">Inscri&ccedil;&otilde;es</a></li>
                                                    <li><a href="<?php echo site_url('multitools/turmas/index/IN'); ?>" title="" class="no-submenu">Turmas</a></li>
                                                <?php endif;?>
						<li><a href="<?php echo site_url('multitools/aulas/index/IN'); ?>" title="" class="no-submenu">Aulas</a></li>
						<li><a href="<?php echo site_url('multitools/faltas/index/IN'); ?>" title="" class="no-submenu">Faltas</a></li>
						<li><a href="<?php echo site_url('multitools/notas/index/IN'); ?>" title="" class="no-submenu">Notas</a></li>
						<li><a href="<?php echo site_url('multitools/arquivos/index/IN'); ?>" title="" class="no-submenu">Arquivos</a></li>
						<!--<li><a href="<?php //echo site_url('multitools/avaliacoes/index/IN'); ?>" title="" class="no-submenu">Avalia&ccedil;&otilde;es</a></li>-->
						<li><a href="<?php echo site_url('multitools/certificados/index/IN'); ?>" title="" class="no-submenu">Libera&ccedil;&atilde;o de Certificados</a></li>

					</ul>
				</li>

				<li>
					<a href="" title="" class="">Programa Alta Performance</a>
					<ul>
						<?php if($this->session->userdata('tipo')=='A'): ?>
                                                    <li><a href="<?php echo site_url('multitools/programas_alta_performance'); ?>" title="" class="no-submenu">Programas</a></li>
                                                <?php endif;?>
						<li><a href="<?php echo site_url('multitools/turmas/index/AL'); ?>" title="" class="no-submenu">Turmas</a></li>
                                                <?php if($this->session->userdata('tipo')=='A'): ?>
                                                    <li><a href="<?php echo site_url('multitools/inscritos'); ?>" title="" class="no-submenu">Usuários Cadastrados</a></li>
                                                    <li><a href="<?php echo site_url('multitools/inscricoes/index/AL'); ?>" title="" class="no-submenu">Compras/Inscri&ccedil;&otilde;es</a></li>
                                                 <?php endif;?>
						<li><a href="<?php echo site_url('multitools/aulas/index/AL'); ?>" title="" class="no-submenu">Aulas</a></li>
						<li><a href="<?php echo site_url('multitools/faltas/index/AL'); ?>" title="" class="no-submenu">Faltas</a></li>
						<li><a href="<?php echo site_url('multitools/notas/index/AL'); ?>" title="" class="no-submenu">Notas</a></li>
						<li><a href="<?php echo site_url('multitools/arquivos/index/AL'); ?>" title="" class="no-submenu">Arquivos</a></li>
						<!--<li><a href="<?php //echo site_url('multitools/avaliacoes/index/AL'); ?>" title="" class="no-submenu">Avalia&ccedil;&otilde;es</a></li>-->
						<li><a href="<?php echo site_url('multitools/certificados/index/AL'); ?>" title="" class="no-submenu">Libera&ccedil;&atilde;o de Certificados</a></li>
                                                <?php if($this->session->userdata('tipo')=='A'): ?>
                                                    <li><a href="<?php echo site_url('multitools/avise/index/AL'); ?>" title="" class="no-submenu">Avise-me</a></li>
                                                <?php endif;?>
                                        </ul>
				</li>

				<li>
					<a href="" title="" class="">Programas de Desenvolvimento</a>
					<ul>
                                                <?php if($this->session->userdata('tipo')=='A'): ?>
                                                    <li><a href="<?php echo site_url('multitools/programas_desenvolvimento'); ?>" title="" class="no-submenu">Programas</a></li>
                                                    <li><a href="<?php echo site_url('multitools/inscritos'); ?>" title="" class="no-submenu">Usuários Cadastrados</a></li>
                                                    <li><a href="<?php echo site_url('multitools/inscricoes_empresas/index/DE'); ?>" title="" class="no-submenu">Inscri&ccedil;&otilde;es</a></li>
                                                 <?php endif ?>
						<li><a href="<?php echo site_url('multitools/aulas/index/DE'); ?>" title="" class="no-submenu">Aulas</a></li>
						<li><a href="<?php echo site_url('multitools/faltas/index/DE'); ?>" title="" class="no-submenu">Faltas</a></li>
						<li><a href="<?php echo site_url('multitools/notas/index/DE'); ?>" title="" class="no-submenu">Notas</a></li>
						<li><a href="<?php echo site_url('multitools/arquivos/index/DE'); ?>" title="" class="no-submenu">Arquivos</a></li>
						<!--<li><a href="<?php //echo site_url('multitools/avaliacoes/index/DE'); ?>" title="" class="no-submenu">Avalia&ccedil;&otilde;es</a></li>-->
						<li><a href="<?php echo site_url('multitools/certificados/index/DE'); ?>" title="" class="no-submenu">Libera&ccedil;&atilde;o de Certificados</a></li>
					</ul>
				</li>

				<li>
					<a href="" title="" class="">E-learning</a>
					<ul>
						<?php if($this->session->userdata('tipo')=='A'): ?>
                                                    <li><a href="<?php echo site_url('multitools/elearning'); ?>" title="" class="no-submenu">Cursos</a></li>
                                                    <li><a href="<?php echo site_url('multitools/inscritos'); ?>" title="" class="no-submenu">Usuários Cadastrados</a></li>
                                                    <li><a href="<?php echo site_url('multitools/inscricoes_empresas/index/EL'); ?>" title="" class="no-submenu">Compras/Inscri&ccedil;&otilde;es</a></li>
                                                <?php endif;?>
						<li><a href="<?php echo site_url('multitools/aulas/index/EL'); ?>" title="" class="no-submenu">Aulas</a></li>
						<li><a href="<?php echo site_url('multitools/exercicios/index/EL'); ?>" title="" class="no-submenu">Exerc&iacute;cios/Prova</a></li>
						<li><a href="<?php echo site_url('multitools/notas/index/EL'); ?>" title="" class="no-submenu">Notas</a></li>
						<li><a href="<?php echo site_url('multitools/arquivos/index/EL'); ?>" title="" class="no-submenu">Arquivos</a></li>
						<!--<li><a href="<?php //echo site_url('multitools/avaliacoes/index/EL'); ?>" title="" class="no-submenu">Avalia&ccedil;&otilde;es</a></li>-->
						<li><a href="<?php echo site_url('multitools/mensagens/index/EL'); ?>" title="" class="no-submenu">Mensagens</a></li>
                                                <?php if($this->session->userdata('tipo')=='A'): ?>
                                                    <li><a href="<?php echo site_url('multitools/certificados/index/EL'); ?>" title="" class="no-submenu">Libera&ccedil;&atilde;o de Certificados</a></li>
                                                <?php endif;?>
						<li><a href="<?php echo site_url('multitools/chat'); ?>" title="" class="no-submenu">Chat</a></li>
					</ul>
				</li>
                                <?php endif;?>

                                <?php if($this->session->userdata('tipo')=='A'): ?>
				<li>
					<a href="" title="" class="">Autodiagn&oacute;sticos</a>
					<ul>
						<li><a href="<?php echo site_url('multitools/autodiagnosticos'); ?>" title="" class="no-submenu">Autodiagn&oacute;sticos</a></li>
						<li><a href="<?php echo site_url('multitools/tipos_autodiagnosticos'); ?>" title="" class="no-submenu">&Aacute;reas de Autodiagn&oacute;sticos</a></li>
						<li><a href="<?php echo site_url('multitools/autodiagnosticos_inscricoes'); ?>" title="" class="no-submenu">Controle de Servi&ccedil;os</a></li>
					</ul>
				</li>

				<li>
					<a href="" title="" class="">Banco de Talentos</a>
					<ul>
						<li><a href="<?php echo site_url('multitools/inscritos/index/F'); ?>" title="" class="no-submenu">Usuários Cadastrados</a></li>
						<li><a href="<?php echo site_url('multitools/inscritos/index/J'); ?>" title="" class="no-submenu">Empresas</a></li>
						<li><a href="<?php echo site_url('multitools/vagas'); ?>" title="" class="no-submenu">Vagas</a></li>
						<li><a href="<?php echo site_url('multitools/curriculos'); ?>" title="" class="no-submenu">Curr&iacute;culos</a></li>
						<li><a href="<?php echo site_url('multitools/curriculos/consulta'); ?>" title="" class="no-submenu">Consulta de Curr&iacute;culos</a></li>
						<li><a href="<?php echo site_url('multitools/candidaturas_vagas'); ?>" title="" class="no-submenu">Candidaturas</a></li>
						<li><a href="<?php echo site_url('multitools/processos_selecao'); ?>" title="" class="no-submenu">Processos de Sele&ccedil;&atilde;o</a></li>
						<li><a href="<?php echo site_url('multitools/selecao_curriculos_inscricoes'); ?>" title="" class="no-submenu">Sele&ccedil;&atilde;o de Curr&iacute;culos Contratados</a></li>
						<li><a href="<?php echo site_url('multitools/niveis_atuacao'); ?>" title="" class="no-submenu">N&iacute;veis de Atua&ccedil;&atilde;o</a></li>
						<li><a href="<?php echo site_url('multitools/areas_atuacao'); ?>" title="" class="no-submenu">&Aacute;reas de Atua&ccedil;&atilde;o</a></li>
						<li><a href="<?php echo site_url('multitools/segmentos_atuacao'); ?>" title="" class="no-submenu">Segmentos de Atua&ccedil;&atilde;o</a></li>
						<li><a href="<?php echo site_url('multitools/disponibilidades_horarios'); ?>" title="" class="no-submenu">Disponibilidades de Hor&aacute;rios</a></li>
						<li><a href="<?php echo site_url('multitools/pretensoes_salariais'); ?>" title="" class="no-submenu">Faixas Salariais</a></li>
						<li><a href="<?php echo site_url('multitools/idiomas_selecao'); ?>" title="" class="no-submenu">Idiomas</a></li>
					</ul>
				</li>

				<li>
					<a href="" title="" class="">Central de Downloads</a>
					<ul>
						<li><a href="<?php echo site_url('multitools/downloads_categorias'); ?>" title="" class="no-submenu">Linhas de Neg&oacute;cios</a></li>
						<li><a href="<?php echo site_url('multitools/downloads'); ?>" title="" class="no-submenu">Gerenciar Arquivos</a></li>
						<li><a href="<?php echo site_url('multitools/downloads_compras'); ?>" title="" class="no-submenu">Compras</a></li>
					</ul>
				</li>


                                <li>
					<a href="" title="" class="">Armazenamento nas Nuvens</a>
					<ul>
						<li><a href="<?php echo site_url('multitools/armazenamento_pastas'); ?>" title="" class="no-submenu">Gerenciamento de Pastas</a></li>
						<!--<li><a href="<?php //echo site_url('multitools/downloads_nuvens'); ?>" title="" class="no-submenu">Gerenciar Arquivos</a></li>-->

					</ul>
				</li>
                                <li>
					<a href="" title="" class="">Orçamento Online</a>
					<ul>
						<li><a href="<?php echo site_url('multitools/orcamento_online'); ?>" title="" class="no-submenu">Pedido de Orçamento</a></li>


					</ul>
				</li>

				<li>
					<a href="" title="" class="">Pesquisa</a>
					<ul>
						<li><a href="<?php echo site_url('multitools/pesquisas_orcamentos'); ?>" title="" class="no-submenu">Pedido de Orçamento</a></li>
						<li><a href="<?php echo site_url('multitools/pesquisas'); ?>" title="" class="no-submenu">Pesquisas</a></li>
						<li><a href="<?php echo site_url('multitools/pesquisas_relatorios'); ?>" title="" class="no-submenu">Resultados</a></li>


					</ul>
				</li>
                                <?php endif;?>



			</ul>
		</nav>


	</section>
	<section role="main">