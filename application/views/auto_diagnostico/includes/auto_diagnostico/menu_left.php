<ul class="lista-meus-cursos">

<li><a href="<?php echo site_url('meucadastro/index/'.$this->session->userdata('SessionTipoPessoa'));?>">Meu Cadastro</a><span>Atualizar</span></li>
<li class="selected"><a href="<?php echo site_url('area_restrita_autodiagnosticos/index');?>/<?php echo $acesso['tipoacesso']; ?>">Meus Autodiagnósticos</a></li>

</ul>
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