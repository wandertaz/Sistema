<?php if (($this->session->userdata('SessionTipoPessoa')=='F') || ($this->session->userdata('SessionTipoPessoa')=='J')):?>
<ul id="submenu-area-restrita">
    <li class="active">
    	<a href="<?php echo $base_url;?>central_downloads/arquivos">Meus arquivos
    		<span>Atualizar</span>
    	</a>
    </li>
    <li><a href="<?php echo $base_url;?>central_downloads/termos">Termos de utilização do serviço</a></li>
</ul>
<?php endif; ?>