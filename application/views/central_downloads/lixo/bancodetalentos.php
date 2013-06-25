

<?php
include("includes/topo.php");
?>


<?php include("includes/banner-interna.php"); ?>

<div class="content">




    <div class="content-interna" style="width:990px; background:white;">

     <div class="centerCursos equalH-meus-cursos bancodetalentos_content" style="width:724px;">

	<div id="busca_bancodetalentos" style="padding:0px; padding-bottom:25px; padding-top:25px;">
<!-- 	  <ul id="menu_busca_bancodetalentos">
	    <li><span class="title_menu">Buscar Empregos</span> <span class="triangulo_branco"></span></li>
	    <li><span class="title_menu">Buscar Currículo</span> <span class="triangulo_branco"></span></li>
	  </ul>
	  <form id="form_busca_bancodetalentos" action="">
	    <label id="inpt_busca_bancodetalentos" for="">
	      <input type="text" name="" id="" style="width:610px;" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">
	    </label>
	  </form> -->

  <ul id="menu_busca_bancodetalentos">    
        <li id="busca_empregos" class="active"><span class="title_menu">Buscar Empregos</span> <span class="triangulo_branco"></span></li>   
		<li id="busca_curriculo"><span class="title_menu">Buscar Currículo</span> <span class="triangulo_branco"></span></li>    
  </ul>

  <form id="form_busca_bancodetalentos"  class="form_busca_vagas" method="post" action="<?php echo site_url();?>banco_talentos_vagas">
    <label id="inpt_busca_bancodetalentos" for="">
      <input type="text" style="width: 645px;" name="palavra_chave" id="" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       
    </label>
  </form>


  <form id="form_busca_bancodetalentos" style="display:none;" class="form_busca_curriculos" method="post" action="<?php echo site_url();?>bancodetalentos_busca/curriculo">
    <label id="inpt_busca_bancodetalentos_curriculos" for="">
        <?php if($this->session->userdata('logged_in_Empresa')):?>
            <input style="width: 475px;float: left;" type="text" name="palavra_chave" id="inpt_busca_bancodetalentos_curriculos" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       
       
        <a style="float:left;display:block;color:#333; text-decoration:none;font-size: 14px;margin:-3px 0 0 20px;" href="<?php echo site_url();?>bancodetalentos_busca/curriculo_busca_avancada">
            
          <span style="width: 150px;">Pesquisa de Currículos</span><br />
          
          <strong>Busca Avançada</strong>
        </a>
          <?php else:?>
            <span style="text-align: left;width:300px;">Você deve estar logado para a pesquisa de curriculo!</span>
         <?php endif;?>    
    </label>
  </form>




	</div>

	<p>Programas de maior duração, voltados para o desenvolvimento de competências gerenciais e customizadas às necessidades específicas de
		cada organização. Os programas são divididos em módulos, contendo exercícios, utilização de “cases” e aplicações práticas para melhor
		aprendizagemespecíficas de cada organização. Os programas são divididos em módulosespecíficas de cada organização. </p>

	<hr>

      <h1 style="width:100px;">Vagas em Destaque</h1>

      <!-- Pra cada candidato, inserir a linha abaixo -->
      <div class="lista-vagas-destaque">

      		<?php if($vagas): ?>
      			<?php foreach($vagas as $vaga): ?>
			      <div class="vaga">
			      <h1><?php echo $vaga->titulo_cargo; ?></h1>
			      <h2><?php echo $vaga->empresa; ?></h2> . <span class="quantidade-vagas"><?php echo $vaga->quantidade_vagas; ?> Vaga(s)</span>
			      <p><?php echo $vaga->descricao; ?></p>
				  <span class="nivel">
				  	<h1>Nível</h1>
				  	<h2><?php echo $vaga->nome_nivel; ?></h2>
				  </span>

					<?php if($vaga->exibir_faixa_salarial == 'S' && isset($vaga->faixa_salarial) && $vaga->faixa_salarial): ?>
					  <span class="faixa-salarial">
					  	<h1>Faixa Salarial</h1>
					  	<h2><?php echo $vaga->faixa_salarial->pretencaosalarial_nome; ?></h2>
					  </span>
					<?php endif; ?>
                            <?php if($this->session->userdata('logged_in_Aluno')): ?>
                              <a href="<?php echo site_url(); ?>bancodetalentos/detalhes_vaga/<?php echo $vaga->id_vaga ; ?>">
                                  <img src="<?php echo base_url();?>assets/img/btn-ver-vaga.png">
                              </a>
                               <?php else: ?>
                                <a href="<?php echo site_url('home?msg=3'); ?>">
                                    <img src="<?php echo base_url();?>assets/img/btn-ver-vaga.png">
                                </a>
                              <?php endif; ?>
				  </div>
				<?php endforeach; ?>
			<?php endif; ?>
      </div>
      <!-- Pra cada candidato, inserir a linha acima -->

     </div>

     <!-- Right Sidebar -->
     <div class="right">
         <?php include("includes/servicos-home.php"); ?>
     </div>

   </div>


 </div>

 <?php
 include("includes/rodape.php");
 ?>

