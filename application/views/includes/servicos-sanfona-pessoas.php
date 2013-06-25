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

<br/>
<img src="<?php echo base_url(); ?>assets/img/interrogacao.png" />
Gostaria de saber mais sobre nossos serviços faça um orçamento On line?
<br/><br/>
<!--<div id="servicos-inscrevase">
<a class="various" data-fancybox-type="iframe" href="<?php //echo site_url();?>contato">Entre em contato conosco</a>-->

<!--</div>--> 
Selecione o orçamento ao lado: 
<select name="select-orcamento" id="select-orcamento">
    <option value="">Selecione</option>
        <option value="<?php echo site_url('orcamento_online/index/TR');?>">Orçamento Treinamento</option>
	<option value="<?php echo site_url('orcamento_online/index/AI');?>">Orçamento Auditoria Interna</option>
	<option value="<?php echo site_url('orcamento_online/index/GA');?>">Orçamento ISO 14001 (SGA)</option>
	<option value="<?php echo site_url('orcamento_online/index/SQ');?>">Orçamento ISO 9001 (SGQ)</option>
	<option value="<?php echo site_url('orcamento_online/index/SS');?>">Orçamento OHSAS 18001</option>
	<option value="<?php echo site_url('orcamento_online/index/GS');?>">Orçamento SA 8000</option>
        <option value="<?php echo site_url('orcamento_online/index/PB');?>">Orcamento PBQP-h </option>
</select>

    <p>Para informações de outros serviços não disponíveis para orçamento On-line:</p>						
    <a class="various" data-fancybox-type="iframe" href="<?PHP  echo site_url('orcamento_online/novo_orcamento');?>"><img src="<?PHP  echo site_url('assets/img/solicitar-proposta-personalizada.png');?>" alt=""></a>



<!--
<img src="<?php echo base_url(); ?>assets/img/interrogacao.png" />
Gostaria de saber mais sobre os serviços acima ou receber uma proposta comercial?
<br/><br/>
<div id="servicos-inscrevase">
<a class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>contato">Entre em contato conosco</a>
</div>-->         