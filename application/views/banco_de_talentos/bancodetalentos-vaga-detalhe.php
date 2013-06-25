<?php
include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>

<?php
   include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>


<?php //include("includes/banner-interna.php"); ?>

<div class="content">

    <div class="menuAreaRestrita">
    <h1>Área Restrita</h1>
    <!--<ul>
      <li><a href="#">Cursos</a></li>
      <li class="selected"><a href="#">Banco de Talentos</a></li>
      <li><a href="#">Auto Diagnóstico</a></li>

      <li><a href="#">Central de Downloads</a></li>
      <li><a href="#">Gerenciamento de Usuários</a></li>
      <li><a href="#">Armazenamento na Nuvem</a></li>

    </ul>-->
        <?php
            include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
        ?>
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
		 <div class="centerCursos equalH-meus-cursos bancodetalentos_content" style="padding: 15px 0 0 15px;">
	     <?php if($vaga): ?>
		     <h2 style="float:left;" class="titulo-cargo"><?php echo $vaga->titulo_cargo; ?></h2>

		     	<?php if($this->session->userdata('logged_in_Aluno')): ?>
                                <?php if(valida_candidatura($vaga->id_vaga)==0):?>
                                        <a style="float:right;margin-right:8px;" class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>candidatura/vaga/<?php echo $vaga->id_vaga;?>"><img src="<?php echo base_url() ?>/assets/img/cadastrar-vaga.png" alt=""></a>
                                 <?php else: ?>
          <a  style="float:right;margin-right:8px;" href="<?php echo site_url();?>bancodetalentos/remover_candidatura/<?php echo $vaga->id_vaga;?>/<?php echo(retorno_id_curriculo());?>"> <img src="<?php echo base_url() ?>assets/img/bt-remover-candidatura.png" alt=""></a>
          <?php endif;?>
			<?php endif; ?>

		     <h3 class="empresa-this-vaga clear-both"><?php echo $vaga->empresa; ?><br /><span><?php echo $vaga->quantidade_vagas; ?> Vagas</span></h3>

		     <h1>Dados da Vaga</h1>
		     <ul id="description-vaga">
		       <li><strong>Faixa Salarial: </strong><span><?php echo $vaga->faixa_salarial && $vaga->exibir_faixa_salarial == 'S' ? $vaga->faixa_salarial->pretencaosalarial_nome : 'Confidencial';  ?></span></li>
		       <li><strong>Nível: </strong><span><?php echo $vaga->nome_nivel; ?></span></li>

			   <?php if(isset($vaga->areas_atuacao) && $vaga->areas_atuacao): ?>
				   <li><strong>Área de Atuação: </strong>
			       	<span>
					  	<?php foreach($vaga->areas_atuacao as $area_atuacao): ?>
					  		<?php echo $area_atuacao->nome_area; ?><br />
					  	<?php endforeach; ?>
					</span></li>
			       <li><strong></strong><span></span></li>
			   <?php endif; ?>

		       <?php if($vaga->grau_formacao): ?>
		       	<li><strong>Grau de Formação: </strong><span><?php echo $graus_formacao[$vaga->grau_formacao]; ?></span></li>
		       <?php endif; ?>

			   <?php if($vaga->curso_formacao): ?>
			   	<li><strong>Curso(s) de Formação: </strong><span><?php echo $vaga->curso_formacao; ?></span></li>
		       <?php endif; ?>

			   <?php if($vaga->experiencia): ?>
			   	<li><strong>Experiência: </strong><span><?php echo $vaga->experiencia; ?></span></li>
		       	<li><strong></strong><span></span></li>
		       <?php endif; ?>

		       <?php if($vaga->conhecimentos_necessarios): ?>
		       	<li><strong>Habilidades e Conhecimentos Necessários: </strong><span><?php echo $vaga->conhecimentos_necessarios; ?></span></li>
		       	<li><strong></strong><span></span></li>
		       <?php endif; ?>

		       <?php if(isset($vaga->idiomas) && $vaga->idiomas): ?>
			       <li><strong>Idiomas: </strong>
			       	<span>
						<?php foreach($vaga->idiomas as $idioma): ?>
							<?php echo $idioma->nome_idioma; ?>
								 (Leitura: <?php echo $idioma->nivel_leitura==''?'B': $niveis_idiomas[$idioma->nivel_leitura]; ?>,
								 Escrita: <?php echo $idioma->nivel_leitura==''?'B': $niveis_idiomas[$idioma->nivel_escrita]; ?>,
								 Conversação: <?php echo $idioma->nivel_leitura==''?'B': $niveis_idiomas[$idioma->nivel_conversacao]; ?>)
								<br />
						<?php endforeach; ?>
					</span></li>
					<li><strong></strong><span></span></li>
			   <?php endif; ?>

		       <?php if($vaga->beneficios): ?>
		       	<li><strong>Benifícios Oferecidos: </strong><span><?php echo $vaga->beneficios; ?></span></li>
		       <?php endif; ?>

		       <?php if($vaga->regime_contratacao): ?>
			   	<li><strong>Regime de Contratação: </strong><span><?php echo $tipos_contrato[$vaga->regime_contratacao]; ?></span></li>
			   <?php endif; ?>

			   <?php if($vaga->horario): ?>
		       	<li><strong>Horário de Trabalho: </strong><span><?php echo $vaga->horario; ?></span></li>
		       	<li><strong></strong><span></span></li>
		       <?php endif; ?>

		       <?php if($vaga->informacoes_adicionais): ?>
		      	 <li><strong>Informações Adicionais: </strong><span><?php echo $vaga->informacoes_adicionais; ?></span></li>
		      	<?php endif; ?>
		     </ul>

		     <?php if($this->session->userdata('logged_in_Aluno')): ?>
			     <ul id="actions-vaga">
			       <li><a  class=" indicar-vaga no-border various" data-fancybox-type="iframe" href="<?php echo site_url();?>gerenciamento_email/indicar_vaga_amigo/<?php echo $vaga->id_vaga;?>">Indicar vaga a um amigo</a></li>
                               <?php if(valida_candidatura($vaga->id_vaga)==0):?>
                                    <li style="margin: 27px 0 0 224px;"><a class="various" data-fancybox-type="iframe" href="<?php echo site_url();?>candidatura/vaga/<?php echo $vaga->id_vaga;?>"><img src="<?php echo base_url() ?>/assets/img/cadastrar-vaga.png" alt=""></a></li>
                                                  <?php else: ?>
                                  <li style="margin: 27px 0 0 224px;">  <a href="<?php echo site_url();?>bancodetalentos/remover_candidatura/<?php echo $vaga->id_vaga;?>/<?php echo(retorno_id_curriculo());?>"> <img src="<?php echo base_url() ?>assets/img/bt-remover-candidatura.png" alt=""></a></li>
                                <?php endif; ?>
			     </ul>
			 <?php endif; ?>

		  <?php else: ?>
			Vaga não encontrada
		  <?php endif; ?>
		  	</div>
		</form>
     <!-- Right Sidebar -->
     <div class="rightMeusCursos">
         <?php include("includes/banco_de_talentos/menu_right.php"); ?>
     </div>

   </div>


 </div>

   <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php';
            ?>