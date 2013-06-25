<?php if (($this->session->userdata('SessionTipoPessoa')=='F') || ($this->session->userdata('SessionTipoPessoa')=='J')):?>
<ul id="submenu-area-restrita">
    <li class="active txt-right">
    	<a href="">Minhas Pastas</a>
    	<?php if(isset($pastas)): ?>
    		<?php foreach($pastas as $pasta): ?>
    			<a href="<?php echo site_url('armazenamento_nas_nuvens/index/'.$TipoAcesso.'/'.$pasta['id_pasta']); ?>" class="sub-links"><span><?php echo $pasta['nome_pasta']; ?></span></a>
    		<?php endforeach; ?>
    	<?php endif; ?>
    </li>
</ul>
<?php endif; ?>