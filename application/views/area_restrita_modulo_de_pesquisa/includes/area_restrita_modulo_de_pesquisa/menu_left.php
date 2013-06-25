<ul class="lista-meus-cursos">
<li><a href="<?php echo site_url('meucadastro/index/'.$this->session->userdata('SessionTipoPessoa'));?>">Meu Cadastro</a><span>Atualizar</span></li>
<li><a href="<?php echo site_url('area_restrita_modulo_de_pesquisa/index');?>/<?php echo $acesso['tipoacesso']; ?>">Minhas Pesquisas</a></li>
<?php if($inscricoes[0]->status != 'AP'): ?>	
<li  <?php echo strpos(uri_string(),'banco_de_dados')>0 ?'class="selected"':''?> ><a href="<?php echo site_url('area_restrita_modulo_de_pesquisa/banco_de_dados');?>/<?php echo $inscricoes[0]->id_pesquisas.'/'. $acesso['tipoacesso']; ?>">Banco de dados</a></li>
<li  <?php echo strpos(uri_string(),'logomarca')>0 ?'class="selected"':''?> ><a href="<?php echo site_url('area_restrita_modulo_de_pesquisa/logomarca');?>/<?php echo $inscricoes[0]->id_pesquisas.'/'. $acesso['tipoacesso']; ?>">Logomarca</a></li>
<?php else: ?>
<li  <?php echo strpos(uri_string(),'relatorio')>0 ?'class="selected"':''?> ><a href="<?php echo site_url('area_restrita_modulo_de_pesquisa/relatorio');?>/<?php echo $inscricoes[0]->id_pesquisas.'/'.$acesso['tipoacesso']; ?>">Relatório</a></li>
<?php endif; ?>
</ul>
