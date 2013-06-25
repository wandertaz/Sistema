<?php if ($this->session->userdata('SessionTipoPessoa') == 'F'): ?>
    <?php if ($this->session->userdata('Session_menu_area_restrita')=='' ||$this->session->userdata('Session_menu_area_restrita') == 'F'): ?>
        <ul>
            <li <?php echo strpos(uri_string(),'curso')>0 || strpos(uri_string(),'restrita_meus_cursos')>0 || strpos(uri_string(),'rtifica')>0 ?'class="selected"':''?>><a href="<?php echo site_url('area_restrita_meus_cursos'); ?>">Cursos</a></li>    
            <li <?php echo strpos(uri_string(),'talento')>0 ?'class="selected"':''?>><a href="<?php echo site_url('bancodetalentos/meucurriculo'); ?>">Banco de Talentos</a></li>
            <li <?php echo strpos(uri_string(),'autodiagnostico')>0 ?'class="selected"':''?>><a href="<?php echo site_url('area_restrita_autodiagnosticos/index/F'); ?>">Auto Diagnóstico</a></li>
            <li <?php echo strpos(uri_string(),'_download')>0 ?'class="selected"':''?>><a href="<?php echo site_url('central_downloads/index/F'); ?>">Central de Downloads</a></li>
            <li><a href="<?php echo site_url(''); ?>">Gerenciamento de Usuários</a></li>
            <li <?php echo strpos(uri_string(),'nuvens')>0 ?'class="selected"':''?>><a href="<?php echo site_url('armazenamento_nas_nuvens/index/F'); ?>">Armazenamento na Nuvem</a></li>
        </ul>
    <?php elseif ($this->session->userdata('Session_menu_area_restrita') == 'FJ'): ?>
        <?php if ($this->session->userdata('logged_in_Permissao_Juridica')): ?>
            <ul>
                <?php if (strpos($this->session->userdata('SessionAreaPermissoes'), '-1-') > 0): ?>
                    <li <?php echo strpos(uri_string(),'notas_empresa')>0 || strpos(uri_string(),'renciarinscrito')>0 || strpos(uri_string(),'curso')>0 || strpos(uri_string(),'cursos_empresa')>0 || strpos(uri_string(),'rtifica')>0 ?'class="selected"':''?>><a href="<?php echo site_url('area_restrita_meus_cursos_empresa'); ?>">Cursos</a></li> 
                <?php endif; ?>

                <?php if (strpos($this->session->userdata('SessionAreaPermissoes'), '-3-') > 0): ?>   
                    <li <?php echo strpos(uri_string(),'talento')>0 ?'class="selected"':''?> ><a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Banco de Talentos</a></li>
                <?php endif; ?>

                <?php if (strpos($this->session->userdata('SessionAreaPermissoes'), '-2-') > 0): ?>
                    <li <?php echo strpos(uri_string(),'restrita_autodiagnostico')>0 ?'class="selected"':''?>><a href="<?php echo site_url('area_restrita_autodiagnosticos/index/FJ'); ?>">Auto Diagnóstico</a></li>
                <?php endif; ?>

                <?php if (strpos($this->session->userdata('SessionAreaPermissoes'), '-4-') > 0): ?>    
                    <li <?php echo strpos(uri_string(),'_download')>0 ?'class="selected"':''?>><a href="<?php echo site_url('central_downloads/index/FJ'); ?>">Central de Downloads</a></li>
                <?php endif; ?>

                <?php if (strpos($this->session->userdata('SessionAreaPermissoes'), '-6-') > 0): ?>
                    <li><a href="<?php echo site_url(''); ?>">Gerenciamento de Usuários</a></li>
                <?php endif; ?>

                <?php if (strpos($this->session->userdata('SessionAreaPermissoes'), '-5-') > 0): ?>
                    <li <?php echo strpos(uri_string(),'nuvens')>0 ?'class="selected"':''?>><a href="<?php echo site_url('armazenamento_nas_nuvens/index/FJ'); ?>">Armazenamento na Nuvem</a></li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
<?php elseif ($this->session->userdata('SessionTipoPessoa') == 'J'): ?>
    <ul>
        <li <?php echo strpos(uri_string(),'enciar_permisso')>0 ||strpos(uri_string(),'curso')>0 || strpos(uri_string(),'restrita_meus_cursos')>0 || strpos(uri_string(),'rtifica')>0 ?'class="selected"':''?>><a href="<?php echo site_url('area_restrita_meus_cursos_empresa') ?>">Cursos</a></li>    
        <li <?php echo strpos(uri_string(),'talento')>0 ?'class="selected"':''?>><a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>">Banco de Talentos</a></li>
        <li <?php echo strpos(uri_string(),'autodiagnostico')>0 ?'class="selected"':''?>><a href="<?php echo site_url('area_restrita_autodiagnosticos/index/J'); ?>">Auto Diagnóstico</a></li>
        <li <?php echo strpos(uri_string(),'_download')>0 ?'class="selected"':''?>><a href="<?php echo site_url('central_downloads/index/J'); ?>">Central de Downloads</a></li>
       <!-- <li><a href="<?php echo site_url(''); ?>">Gerenciamento de Usuários</a></li>-->
        <li <?php echo strpos(uri_string(),'nuvens')>0 ?'class="selected"':''?> ><a href="<?php echo site_url('armazenamento_nas_nuvens/index/J'); ?>">Armazenamento na Nuvem</a></li>
    </ul>
<?php endif; ?>
<?php // echo (uri_string());?>


