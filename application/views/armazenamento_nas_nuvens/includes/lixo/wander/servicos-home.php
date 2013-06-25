
<div class="servicos">  
    
 <?php if (retornacarrinho(1)!=0):?>
    <div class="box-carrinho box-item">
        <h1>Carrinho<br /><span>de compras</span></h1>
        <a href="<?php echo site_url();?>carrinho">
            <img src="<?php echo base_url(); ?>assets/img/ico-carrinho.png" alt="">
            
            <p><?php echo retornacarrinho(1);?> itens<br /> R$<?php echo number_format(retornacarrinho(2), 2, ',', '.');?></p>
            
        </a>

        <a class="ver_carrinho" href="<?php echo site_url();?>carrinho">ver itens no carrinho</a>

        <a class="finalizar_compras" href="<?php echo site_url();?>carrinho/identificacao"><img src="<?php echo base_url(); ?>assets/img/finalizar_compra.png" alt=""></a>

    </div>
    <?php endif;?>


	<h1>Nossos Serviços</h1>

	<div class="box-item">
        	<img src="<?php echo base_url(); ?>assets/img/icone-estrategia.png" />
        <h2 style="display:inline-block;">Estratégia</h2>
        <p>A Estratégia define os objetivos que as organizações irão perseguir, suas metas e resultados almejados.</p>
        <a href="<?php echo site_url('servicos/estrategias'); ?>" class="leia"><span>Leia Mais</span></a>
    </div>

	<div class="box-item">
        	<img src="<?php echo base_url(); ?>assets/img/icone-processos.png" />
        <h2 style="display:inline-block;">Processos</h2>
        <p>A Estratégia define os objetivos que as organizações irão perseguir, suas metas e resultados almejados.</p>
        <a href="<?php echo site_url('servicos/processos'); ?>" class="leia"><span>Leia Mais</span></a>
    </div>

	<div class="box-item">
        	<img src="<?php echo base_url(); ?>assets/img/icone-pessoas.png" />
        <h2 style="display:inline-block;">Pessoas</h2>
        <p>A Estratégia define os objetivos que as organizações irão perseguir, suas metas e resultados almejados.</p>
        <a href="<?php echo site_url('servicos/pessoas'); ?>" class="leia"><span>Leia Mais</span></a>
    </div>
    
    <div class="box-item">
        	<img src="<?php echo base_url(); ?>assets/img/icone-governanca.png" />
        <h2 style="display:inline-block;">Governança<br/>Coorporativa</h2>
        <p>A Governança Corporativa é a responsável por definir um sistema de boas práticas, que visam assegurar a perenidade das empresas e garantir confiabilidade aos seus acionistas.</p>
        <a href="<?php echo site_url('servicos/governanca_corporativa'); ?>" class="leia"><span>Leia Mais</span></a>
    </div>
</div>