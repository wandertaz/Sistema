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

     <form id="form_cadastro_de_vagas" method="post" action="<?php echo site_url('bancodetalentos_empresa/enviar_solicitacao_processo'); ?>">
	     <div class="centerCursos equalH-meus-cursos bancodetalentos_content">
	      <div id="solicitar-processo-seletivo">
	        <h1>Solicitar processo de Seleção</h1>

	        <?php if($this->session->flashdata('msg')): ?>
	        	<div id="msg" style="color:red; text-transform: uppercase;"><b><?php echo $this->session->flashdata('msg');?></b></div><br />
	        <?php endif; ?>

	        <p></p>
	        <ul id="itens-processo-seletivo">
	          <li><label for=""><input type="radio" name="opcao" id="" value="Busca de profissionais (Anúncio, banco de currículos,hunting)"><strong>Busca de profissionais (Anúncio, banco de currículos,hunting)</strong></label></li>
	          <li><label for=""><input type="radio" name="opcao" id="" value="Entrevistas estruturadas"><strong>Entrevistas estruturadas</strong></label></li>
	          <li><label for=""><input type="radio" name="opcao" id="" value="Referências profissionais estruturadas"><strong>Referências profissionais estruturadas</strong></label></li>
	          <li><label for=""><input type="radio" name="opcao" id="" value="Avaliações e testes psicológicos"><strong>Avaliações e testes psicológicos</strong></label></li>
	          <li><label for=""><input type="radio" name="opcao" id="" value="Testes de Proficiência e Conhecimento Técnico"><strong>Testes de Proficiência e Conhecimento Técnico</strong></label></li>
	          <li>
	            <label for=""><input type="radio" name="opcao" id="" value="Outros"><strong>Outros:</strong>
	            <textarea class="to-right inpt_cadastro_curriculo" name="outros" id="" cols="30" rows="10"></textarea></label>
	          </li>
	          <li>
	            <label for=""><strong>Redigir mensagem:</strong>
	              <textarea class="to-right inpt_cadastro_curriculo" name="mensagem" id="" cols="30" rows="10"></textarea>
	            </label>
	          </li>
	        </ul>
	      </div>

	      <div>
	        <input class="enviar_cadastro_curriculo" type="submit" value="Salvar" />
	      </div>

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