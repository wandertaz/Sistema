<?php
include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>


<?php include("includes/banner-interna.php"); ?>

<div class="content">

    <div class="menuAreaRestrita">
    <h1>Área Restrita</h1>
    <ul>
      <li><a href="#">Cursos</a></li>
      <li class="selected"><a href="#">Banco de Talentos</a></li>
      <li><a href="#">Auto Diagnóstico</a></li>      
      <!--
      <li><a href="#">Central de Downloads</a></li>
      <li><a href="#">Gerenciamento de Usuários</a></li>
      <li><a href="#">Armazenamento na Nuvem</a></li>
      -->
    </ul>
    </div>

    
    <?php include('includes/busca-topo-bancodetalentos.php'); ?>

    <div class="content-interna" style="width:990px; background:white;">

    <!-- Left Sidebar -->
     <div class="left-cursos equalH-meus-cursos">
        <div class="miolo-interna">
         <?php include("includes/banco_de_talentos/menu_left.php"); ?>
       </div>
     </div>

     <form id="form_cadastro_de_vagas" method="post" action="">
     <div class="centerCursos equalH-meus-cursos bancodetalentos_content">
      <?php if(isset($curriculos)):?>
            <?php if($curriculos['qtd_registros']>1):?> 
               <h1>Foram encontrados <?php echo $curriculos['qtd_registros'];?> currículos para o perfil solicitado</h1>
           <?php else:?> 
               <h1><?php echo $curriculos['qtd_registros']<1?'Não foi encontrado currículo com o perfil pesquisado!': 'Foi encontrado 1 currículo para o perfil solicitado';?></h1>
            <?php endif;?>
      <?php else:?> 
        <h1>Não foi encontrado currículo com o perfil pesquisado!</h1>
     <?php endif;?> 
     
    <?php if(isset($curriculos) && $curriculos['qtd_registros']>0):?>    
     <div class="anuncio-pacote-curriculos">
      
      <div style="float:left;">
      <h1>Compre por:</h1>
      <h2>R$<?php echo number_format(preco_pacote_curriculo($curriculos['qtd_registros']),2);?></h2>
      </div>
      
      <div style="float:right; width:450px; margin-left:50px;">
      <h3>Pacote de</h3>
      
      <h4><?php echo $curriculos['qtd_registros'];?> currículos completos</h4>
      <p>Uma vasta gama de cursos abertos ao público, são programados e realizados anualmente no Auditório da MB Consultoria, nas áreas da Qualidade, Comportamental, Desenvolvimento Gerencial, Logística e Produtividade.</p>
      </div>
      
         <a href="<?php echo site_url();?>carrinho/adicionar/<?php echo $curriculos['qtd_registros'];?>/BT/<?php echo  $curriculos['id_curriculos_compra'];?>/J" style="float:right;margin-top:10px;"><img src="<?php echo base_url();?>assets/img/btn-comprar.png"></a>
      
      </div>
   <?php endif;?> 
   <!--   
      <div class="lista-pacotes-curriculos">
        <div class="vaga">
        <h1>Título do Cargo</h1>
        <h2>Nome da Empresa</h2> . <span class="quantidade-vagas">3 Vagas</span>
        <p>Atuar com acompanhamento de agenda de pagamentos, recebimento, identificação e lançamento de pagamento 
        no sistema, controle das notas de consumo. 
      A Estratégia define os objetivos que as organizações irão perseguir, suas metas e resultados almejados.</p>
      <span class="nivel">
        <h1>Nível</h1>
        <h2>Gerente</h2>
      </span>

      <span class="faixa-salarial">
        <h1>Faixa Salarial</h1>
        <h2>R$1.000/2.000</h2>
      </span>

      <a href="#"><img src="<?php echo base_url();?>assets/img/btn-ver-vaga.png"></a>
      </div>

      <div class="vaga">
        <h1>Título do Cargo</h1>
        <h2>Nome da Empresa</h2> . <span class="quantidade-vagas">3 Vagas</span>
        <p>Atuar com acompanhamento de agenda de pagamentos, recebimento, identificação e lançamento de pagamento 
        no sistema, controle das notas de consumo. 
      A Estratégia define os objetivos que as organizações irão perseguir, suas metas e resultados almejados.</p>
      <span class="nivel">
        <h1>Nível</h1>
        <h2>Gerente</h2>
      </span>

      <span class="faixa-salarial">
        <h1>Faixa Salarial</h1>
        <h2>R$1.000/2.000</h2>
      </span>

      <a href="#"><img src="<?php echo base_url();?>assets/img/btn-ver-vaga.png"></a>
      </div>

    </div>
-->


     </div>
      </form>

     <!-- Right Sidebar -->
     <div class="rightMeusCursos">
         <?php include("includes/banco_de_talentos/menu_right.php"); ?>
     </div>

   </div>


 </div>

 <?php
 include("includes/rodape.php");
 ?>