<?php
	include("includes/topo.php");
?>


          <?php include("includes/banner-interna.php"); ?>

            <div class="content">
              <div class="content-interna">

                <div class="left-internas2">
                  <div class="breadcrumb">
                       <ul>
                        <li><a href="<?php echo site_url();?>">Home ></a></li>
                        <li><a href="<?php echo site_url();?>carrinho">Carrinho ></a></li>
                        <li><a href="<?php echo site_url();?>carrinho">Meu carrinho</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3>&nbsp;</h3>
                    <div class="txt-interna-servicos">

                     <ul class="carrinho-progresso">
                     	<li class="selected"><h1>Carrinho</h1></li>
                        <li><h1>Identificação</h1></li>
                        <li><h1>Conferência</h1></li>
                        <li><h1>Pagamento</h1></li>
                        <li><h1>Confirmação</h1></li>
                     </ul>

                    </div>
                    <h3>Carrinho</h3>

                    <div class="txt-interna-servicos" style="margin-left:-10px; margin-top:30px;">
                    <div class="centerCursos" style="border-top:none; width:700px;">

	                <?php if($carrinho && !empty($carrinho)): ?>
						<table width="100%" border="0" class="tabelaAreaRestrita" style="border-top:0px;">
	                  	<tbody>
	                    <tr>
	                        <td style="border:none;"><h6 style="margin-left:20px;">Tipo</h6></td>
	                        <td style="border:none;"><h6>Descrição</h6></td>
	                        <td style="border:none;"><h6><center>Preço</center></h6></td>
	                        <td style="border:none;"><h6><center>Excluir</center></h6></td>
	                 	</tr>

	                 	<?php $total = 0; ?>
	                 	<?php foreach($carrinho as $item): ?>
		                    <!-- Para cada item no carrinho, exibir o código abaixo -->
		                      <tr>
		                      	<td>
		                      		<h2 style="margin:20px;"><?php echo $tipos_cursos[$item['tipo']]; ?></h2>
		                      	</td>
		                        <td class="descricao-carrinho" width="65%">
		                        <div>
		                        	<!--<div style="float:left; width:150px; position:relative; top:20px;">
		                            <img src="<?php echo base_url(); ?>assets/img/check-active.png" align="top"><span class="tituloItem">Novo item adicionadoa</span>
		                            </div>
		                            -->

		                            <div>
		                            <!--<img src="<?php echo base_url(); ?>assets/img/video-thumb-sample.png" width="80">-->
		                            
		                            <h3 class="meu_carrinho"><?php echo $item['titulo']; ?></h3>
		                            <?php if($item['turma_data']): ?>
		                            	<h3>Turma: <?php echo br_date($item['turma_data']); ?></h3>
		                            <?php endif; ?>
		                            </div>
		                        </div>
		                        </td>
		                        <td class="tabela-carrinho-preco" width="10%"><center>R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?></center></td>
		                        <td style="border-left:none !important;"><center><a href="<?php echo site_url('carrinho/excluir/'.$item['curso_id'].'/'.$item['tipo']); ?>"><img src="<?php echo base_url(); ?>assets/img/icon-delete-x.gif" border="0"></a></center></td>
		                      </tr>
		                    <!-- Fim para cada item no carrinho, exibir o código acima -->
		                    <?php $total += $item['valor']; ?>
	                    <?php endforeach; ?>

	                    <!-- Total-->
	                      <tr>
	                      	<td></td>
	                        <td class="descricao-carrinho" width="65%">
	                        <div>
	                            <div style="float:right; width:50px; height:35px; position:relative; top:10px; left:-10px;">
	                            <h7 class="total-carrinho">Total</h7>
	                            </div>
	                        </div>
	                        </td>
	                        <td class="tabela-carrinho-preco"><center><font class="preco-total-curso">R$ <?php echo number_format($total, 2, ',', '.'); ?></font></center></td>
	                        <td style="border-left:none !important;"></td>
	                      </tr>
	                    <!-- Fim Total -->

	                      </tbody>
	                      </table><br/>

	                      <div style="float:right;">
	                      <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-continuar-comprando.png"></a>
	                      <a href="<?php echo site_url('carrinho/identificacao'); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-finalizar-compra.png"></a>
	                      </div>

	                  <?php else: ?>
                               <div style="float:right;">
	                      <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-continuar-comprando.png"></a>
                             
                              <img src="<?php echo base_url(); ?>assets/img/btn-finalizar-compra.png">
                            
	                      </div>
                              
                              
						<p>Nenhum item adicionado ao carrinho.</p>
                      <?php endif; ?>


                      </div>

                    </div>



                  </div>
                </div>

					<?php include("includes/box-destaques.php");?>
              </div>
              <div class="right">
                	<?php
						include("includes/servicos-home.php");
					?>
              </div>





            </div>

<?php
	include("includes/rodape.php");
?>