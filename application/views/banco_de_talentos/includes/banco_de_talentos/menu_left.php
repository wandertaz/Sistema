<?php if ($this->session->userdata('SessionTipoPessoa')=='F'):?>
<ul class="lista-meus-cursos">
    <li><h6 class="this_title">Área Pessoal</h6></li>
    <li <?php echo strpos(uri_string(),'meucurriculo')>0 ?'class="selected"':''?>><a href="<?php echo site_url();?>bancodetalentos/meucurriculo">Meu Currículo<br /><span>Atualizar</span></a></li>
    <?php if (testa_curriculo($this->session->userdata('SessionIdAluno'))>0):?>
        <li <?php echo strpos(uri_string(),'curriculos_enviados')>0 ?'class="selected"':''?>><a href="<?php echo site_url();?>bancodetalentos/curriculos_enviados">Currículos Enviados </a></li>
    <?php endif; ?>
</ul>

<?php elseif ($this->session->userdata('SessionTipoPessoa')=='J'):?>
<ul class="lista-meus-cursos">
    <li><h6 class="this_title">Área Empresarial</h6></li>
    <li <?php echo strpos(uri_string(),'minhas_vagas')>0 ?'class="selected"':''?>>
    	<a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Minhas Vagas</a><br />
    	<span><a href="<?php echo site_url('bancodetalentos_empresa/cadastrar_vaga'); ?>">Cadastrar, </a></span><br />
    	<span><a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Gerenciar</a></span>

    </li>
    <li <?php echo strpos(uri_string(),'curriculos_recebidos')>0 || strpos(uri_string(),'ver_curriculo')>0?'class="selected"':''?>><a href="<?php echo site_url('bancodetalentos_empresa/curriculos_recebidos'); ?>">Currículos Recebidos<br /><span>Visualizar</span></a></li>
    <li <?php echo strpos(uri_string(),'curriculos_contratados')>0 ?'class="selected"':''?>><a href="<?php echo site_url('bancodetalentos_empresa/curriculos_contratados'); ?>">Seleção de Currículos Contratados</a></li>
    <li <?php echo strpos(uri_string(),'processo_selecao')>0?'class="selected"':''?>>
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
                <li <?php echo strpos(uri_string(),'minhas_vagas')>0 ?'class="selected"':''?>>
                    <a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Minhas Vagas</a><br />
                    <span><a href="<?php echo site_url('bancodetalentos_empresa/cadastrar_vaga'); ?>">Cadastrar, </a></span><br />
                    <span><a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Gerenciar</a></span>

                </li>
                <li <?php echo strpos(uri_string(),'curriculos_recebidos')>0 ?'class="selected"':''?>><a href="<?php echo site_url('bancodetalentos_empresa/curriculos_recebidos'); ?>">Currículos Recebidos<br /><span>Visualizar</span></a></li>
                <li <?php echo strpos(uri_string(),'curriculos_contratados')>0 ?'class="selected"':''?>><a href="<?php echo site_url('bancodetalentos_empresa/curriculos_contratados'); ?>">Seleção de Currículos Contratados</a></li>
                <li <?php echo strpos(uri_string(),'processo_selecao')>0 ?'class="selected"':''?>>
                    <a href="<?php echo site_url('bancodetalentos_empresa/processo_selecao'); ?>">Processo de Seleção</a><br />
                    <span><a href="<?php echo site_url('bancodetalentos_empresa/solicitar_processo_selecao'); ?>">Solicitar,</a></span>
                    <span><a href="<?php echo site_url('bancodetalentos_empresa/processo_selecao'); ?>">Ver Relatórios</a></span>
                </li>
            </ul>
    <?php endif; ?>
<?php endif; ?>
<!--
<ul class="lista-meus-cursos">
    <li <?php echo strpos(uri_string(),'minhas_vagas')>0 ?'class="selected"':''?>>
        <a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Perguntas Frequentes</a><br />
    </li>
</ul>
<ul class="lista-meus-cursos">
    <li <?php echo strpos(uri_string(),'minhas_vagas')>0 ?'class="selected"':''?>>
        <a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Fale Conosco/Suporte</a><br />
    </li>
</ul>
-->
<?php //echo(uri_string());?>




