

<?php
include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>

<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>


<?php //include("includes/banner-interna.php"); ?>

<div class="content">




    <div class="content-interna" style="width:990px; background:white;">

     <div class="centerCursos equalH-meus-cursos bancodetalentos_content" style="width:724px;">

	<div id="busca_bancodetalentos" style="padding:0px; padding-bottom:25px; padding-top:25px;">

  <ul id="menu_busca_bancodetalentos">    
        <li id="busca_empregos" class="active"><span class="title_menu">Buscar Oportunidades</span> <span class="triangulo_branco"></span></li>   
		<li id="busca_curriculo"><span class="title_menu">Buscar Profissionais</span> <span class="triangulo_branco"></span></li>    
  </ul>

  <form id="form_busca_bancodetalentos"  class="form_busca_vagas" method="post" action="<?php echo site_url();?>banco_talentos_vagas">
    <label id="inpt_busca_bancodetalentos" for="">
        
      <input type="text" style="width: 645px;" name="palavra_chave" id="" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       
    </label>
  </form>


  <form id="form_busca_bancodetalentos" style="display:none;" class="form_busca_curriculos" method="post" action="<?php echo site_url();?>banco_talentos_curriculos/curriculo">
    <label id="inpt_busca_bancodetalentos_curriculos" for="">
        <?php //if(!$this->session->userdata('logged_in_Empresa')):?>
            <input style="width: 475px;float: left;" type="text" name="palavra_chave" id="inpt_busca_bancodetalentos_curriculos" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       
       
        <a style="float:left;display:block;color:#333; text-decoration:none;font-size: 14px;margin:-3px 0 0 20px;" href="<?php echo site_url();?>banco_talentos_curriculos/curriculo_busca_avancada">
            
          <span style="width: 150px;">Pesquisa de Currículos</span><br />
          
          <strong>Busca Avançada</strong>
        </a>
          <?php // else:?>
            <!--<span style="text-align: left;width:300px;">Você deve estar logado para a pesquisa de curriculo!</span>-->
         <?php //endif;?>    
    </label>
  </form>




	</div>

	<?php if(isset($pagina) && $pagina): ?>
            <?php echo $pagina->texto; ?>
        <?php endif; ?>

	

      <h1 style="width:100px;">Busca de Currículos</h1>

      <!-- Pra cada candidato, inserir a linha abaixo -->
      <div class="lista-vagas-destaque">
          
     <form id="form_cadastro_de_vagas" method="post" action="">
     <div style="width: 706px;" class="centerCursos equalH-meus-cursos bancodetalentos_content <?php echo $curriculos['qtd_registros']<1?'no-border': '';?>">
      <?php if(isset($curriculos)):?>
            <?php if($curriculos['qtd_registros']>1):?> 
               <h1>Foram encontrados <?php echo $curriculos['qtd_registros'];?> currículos para o perfil solicitado</h1>
           <?php else:?> 
               <div style="width: 740px;">
                 <h1><center><?php echo $curriculos['qtd_registros']<1?'Não foi encontrado currículo com o perfil pesquisado!': 'Foi encontrado 1 currículo para o perfil solicitado';?></center></h1>
               </div>
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
      
      <div style="float:right;width: 585px; margin-left:50px;">
      <h3>Pacote de</h3>
      
      <h4><?php echo $curriculos['qtd_registros'];?> currículos completos</h4>
      <p>Uma vasta gama de cursos abertos ao público, são programados e realizados anualmente no Auditório da MB Consultoria, nas áreas da Qualidade, Comportamental, Desenvolvimento Gerencial, Logística e Produtividade.</p>
      </div>
       <?php if($this->session->userdata('SessionIdAluno')):?> 
         <a href="" style="float: right;margin: 23px 0 10px;">
             <img src="<?php echo base_url();?>assets/img/btn-comprar.png">
        </a>
       <?php else:?> 
         <a href="<?php echo site_url();?>carrinho/adicionar/<?php echo $curriculos['qtd_registros'];?>/BT/<?php echo  $curriculos['id_curriculos_compra'];?>/J" style="float:right;margin-top:10px;">
             <img src="<?php echo base_url();?>assets/img/btn-comprar.png">
         </a>
          <?php endif;?> 
      
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
  
                
        <div class="vejaTambem">					
            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'veja-tambem-Business-store.php';
                ?>
        </div>
                <?php
                   // include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'box-destaques-blog.php';
                ?>
          
      </div>
      <!-- Pra cada candidato, inserir a linha acima -->
      
      

      

     </div>

     <!-- Right Sidebar -->
     <div class="right">         
           <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'servicos-home.php';
            ?>
     </div>

   </div>


 </div>

            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
            ?>

