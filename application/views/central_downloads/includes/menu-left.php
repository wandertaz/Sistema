<?php if (($this->session->userdata('SessionTipoPessoa')=='F') || ($this->session->userdata('SessionTipoPessoa')=='J')):?>
<ul id="submenu-area-restrita">
    <li class="active">
    	<a href="<?php echo site_url('central_downloads/index/'.$TipoAcesso);?>">Meus arquivos
    		<span>Atualizar</span>
    	</a>
    </li>
    <li><a class="various" data-fancybox-type="iframe" href="<?php echo site_url('contato/aceite_me/4');?>">Termos de utilização do serviço</a></li>
</ul>
<?php endif; ?>