<ul id="example1" class="accordion2">
    <?php foreach ($projetos as $item):?>
    <li>
        <h3><?php echo($item->titulo);?></h3>
        <div class="panel loading">
                 <?php echo($item->descricao);?>
        </div>
    </li>
<?php endforeach;?> 
</ul>
<img src="<?php echo base_url(); ?>assets/img/interrogacao.png" />
Gostaria de saber mais sobre os serviços acima ou receber uma proposta comercial?
<br/><br/>
<div id="servicos-inscrevase">
<a class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>contato">Entre em contato conosco</a>
</div>         