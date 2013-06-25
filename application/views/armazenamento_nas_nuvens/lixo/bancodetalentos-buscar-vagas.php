<?php
include("includes/topo.php");
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

    <form id="form_cadastro_de_vagas" method="post" action="<?php echo site_url();?>bancodetalentos_busca/vagas">
     <div class="centerCursos equalH-meus-cursos bancodetalentos_content">
      <?php if($post==0):?>
          <h1> Não foi encontrada vaga para a busca realizada</h1>
      <?php else:?>
          <h1>Foram encontradas <?php echo isset($vagas)?$vagas[0]['qtd_registros']:'0';?> vagas para a busca realizada</h1>
      <?php if(isset($vagas)):?>
       <?php foreach ($vagas as $itens_vagas):?>
      <div class="vaga">
        <h2 class="cargo-vaga"><?php echo $itens_vagas['titulo'];?></h2>
        <h3 class="atuacao-vaga"><?php echo $itens_vagas['exibir_nome_empresa']=='S'? $itens_vagas['nome_empresa']:'Confidencial';?>&nbsp;<span> <?php echo $itens_vagas['quantidade_vagas'];?> vagas</span></h3>
        <p class="desc-vaga small">
            <?php echo $itens_vagas['descricao_cargo'];?>
        </p>
        <a class="indicar-vaga" class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>gerenciamento_email/indicar_vaga_amigo/<?php echo $itens_vagas['id_vaga'];?>">Indicar vaga a um amigo</a>
        <ul class="detalhes-vaga clear-both">
          <li>
            <span class="detalhe-title-vaga">Nível</span>
            <br>
            <span><?php echo exibir_nivel_atuacao($itens_vagas['id_nivel']);?></span>
          </li>
          <li>
            <span class="detalhe-title-vaga">Faixa Salarial</span>
            <br>
            <span><?php echo $itens_vagas['exibir_faixa_salarial']=='S'? exibir_faixa_salarial($itens_vagas['id_vaga'],'V'):'Confidencial';?></span>
          </li>
        </ul>
        <ul class="menu-vaga">
            <li><a class="ver-vaga" href="<?php echo site_url();?>bancodetalentos/detalhes_vaga/<?php echo $itens_vagas['id_vaga']?>">Detalhes da Vaga</a></li>
          <li></li>
          <li></li>
          <!class="cadastrar"-->
         
          <?php if(valida_candidatura($itens_vagas['id_vaga'])==0):?>
          <li><a  class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>candidatura/vaga/<?php echo $itens_vagas['id_vaga'];?>"> <img src="<?php echo base_url() ?>/assets/img/cadastrar-vaga.png" alt=""></a></li>
          <?php else: ?>
          <li><a   href="<?php echo site_url();?>bancodetalentos/remover_candidatura/<?php echo $itens_vagas['id_vaga'];?>/<?php echo(retorno_id_curriculo());?>"> <img src="<?php echo base_url() ?>assets/img/bt-remover-candidatura.png" alt=""></a></li>
          <?php endif;?>
        </ul>
        <?php
        /*print_r($itens_vagas);
        exit();*/
        
        ?>
      </div>
   <?php endforeach;?>
<!--
      <div class="vaga">
        <h2 class="cargo-vaga">Título do Cargo</h2>
        <h3 class="atuacao-vaga">Nome da Empresa .<span> 3 vagas</span></h3>
        <p class="desc-vaga small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci esse facilis ullam omnis necessitatibus obcaecati neque. Fuga ad cupiditate unde quod mollitia magnam dolores labore perspiciatis pariatur sint debitis dicta.</p>
        <a class="indicar-vaga" href="">Indicar vaga a um amigo</a>
        <ul class="detalhes-vaga clear-both">
          <li>
            <span class="detalhe-title-vaga">Nível</span>
            <br>
            <span>GERENTE</span>
          </li>
          <li>
            <span class="detalhe-title-vaga">Faixa Salarial</span>
            <br>
            <span>R$1000,00/2.000</span>
          </li>
        </ul>
        <ul class="menu-vaga">
          <li><a class="ver-vaga" href="">Detalhes da Vaga</a></li>
          <li></li>
          <li></li>
          <li><a class="cadastrar" href=""><img src="<?php echo base_url() ?>/assets/img/cadastrar-vaga.png" alt=""></a></li>
        </ul>
      </div>

      <div class="vaga last-vaga">
        <h2 class="cargo-vaga">Título do Cargo</h2>
        <h3 class="atuacao-vaga">Nome da Empresa .<span> 3 vagas</span></h3>
        <p class="desc-vaga small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci esse facilis ullam omnis necessitatibus obcaecati neque. Fuga ad cupiditate unde quod mollitia magnam dolores labore perspiciatis pariatur sint debitis dicta.</p>
        <a class="indicar-vaga" href="">Indicar vaga a um amigo</a>
        <ul class="detalhes-vaga clear-both">
          <li>
            <span class="detalhe-title-vaga">Nível</span>
            <br>
            <span>GERENTE</span>
          </li>
          <li>
            <span class="detalhe-title-vaga">Faixa Salarial</span>
            <br>
            <span>R$1000,00/2.000</span>
          </li>
        </ul>
        <ul class="menu-vaga">
          <li><a class="ver-vaga" href="">Detalhes da Vaga</a></li>
          <li></li>
          <li></li>
          <li><a class="cadastrar" href=""><img src="<?php echo base_url() ?>/assets/img/cadastrar-vaga.png" alt=""></a></li>
        </ul>
      </div>-->
    <?php endif;?>
    <?php endif;?>
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