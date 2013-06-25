<?php if ($this->session->userdata('SessionTipoPessoa')=='F'):?>
<ul class="lista-meus-cursos">
    <li><h6 class="this_title">Área Pessoal</h6></li>
    <li class="selected"><a href="<?php echo site_url();?>bancodetalentos/meucurriculo">Meu Currículo<br /><span>Atualizar</span></a></li>
    <li><a href="<?php echo site_url();?>bancodetalentos/curriculos_enviados">Currículos Enviados </a></li>
</ul>

<?php elseif ($this->session->userdata('SessionTipoPessoa')=='J'):?>
<ul class="lista-meus-cursos">
    <li><h6 class="this_title">Área Empresarial</h6></li>
    <li>
    	<a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Minhas Vagas</a><br />
    	<span><a href="<?php echo site_url('bancodetalentos_empresa/cadastrar_vaga'); ?>">Cadastrar, </a></span>
    	<span><a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Gerenciar</a></span>

    </li>
    <li><a href="<?php echo site_url('bancodetalentos_empresa/curriculos_recebidos'); ?>">Currículos Recebidos<br /><span>Visualizar</span></a></li>
    <li><a href="<?php echo site_url('bancodetalentos_empresa/curriculos_contratados'); ?>">Seleção de Currículos Contratados</a></li>
    <li>
    	<a href="<?php echo site_url('bancodetalentos_empresa/processo_selecao'); ?>">Processo de Seleção</a><br />
    	<span><a href="<?php echo site_url('bancodetalentos_empresa/solicitar_processo_selecao'); ?>">Solicitar,</a></span>
    	<span><a href="<?php echo site_url('bancodetalentos_empresa/processo_selecao'); ?>">Ver Relatórios</a></span>
    </li>
</ul>
<?php endif; ?>
    <?php if($this->session->userdata('logged_in_Permissao_Juridica')):?>
        <?php if(strpos($this->session->userdata('SessionAreaPermissoes'),'-3-')>0):?>
            <ul class="lista-meus-cursos">
                <li><h6 class="this_title">Área Empresarial</h6></li>
                <li>
                    <a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Minhas Vagas</a><br />
                    <span><a href="<?php echo site_url('bancodetalentos_empresa/cadastrar_vaga'); ?>">Cadastrar, </a></span>
                    <span><a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Gerenciar</a></span>

                </li>
                <li><a href="<?php echo site_url('bancodetalentos_empresa/curriculos_recebidos'); ?>">Currículos Recebidos<br /><span>Visualizar</span></a></li>
                <li><a href="<?php echo site_url('bancodetalentos_empresa/curriculos_contratados'); ?>">Seleção de Currículos Contratados</a></li>
                <li>
                    <a href="<?php echo site_url('bancodetalentos_empresa/processo_selecao'); ?>">Processo de Seleção</a><br />
                    <span><a href="<?php echo site_url('bancodetalentos_empresa/solicitar_processo_selecao'); ?>">Solicitar,</a></span>
                    <span><a href="<?php echo site_url('bancodetalentos_empresa/processo_selecao'); ?>">Ver Relatórios</a></span>
                </li>
            </ul>
    <?php endif; ?>
<?php endif; ?>





