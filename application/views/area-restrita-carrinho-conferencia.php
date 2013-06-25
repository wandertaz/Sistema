<?php
	include("includes/topo.php");
?>


          <?php include("includes/banner-interna.php"); ?>

<script type="text/javascript">
	function enviaForm() {
          
		$.post('<?php echo site_url('carrinho/salva_inscricao'); ?>', $('#form_pagamento').serialize(), function(data){
			if(data == 'erro'){
				alert('Não foi possível finalizar a compra.');
				return false;
			}
			else if(data == 'confirmacao'){
				location.href = '<?php echo site_url('carrinho/confirmacao'); ?>';
			}
			else{
				$('#reference').val(data);
				$('#form_pagamento').submit();
				return true;
			}
		});
		return false;
	}
</script>
            <div class="content">
              <div class="content-interna">

                <div class="left-internas2">
                  <div class="breadcrumb">
                       <ul>
                        <li><a href="<?php echo site_url()?>">Home ></a></li>                   
                        <li><a href="<?php echo site_url()?>carrinho">Meu carrinho</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3>&nbsp;</h3>
                    <div class="txt-interna-servicos">

                     <ul class="carrinho-progresso">
                     	<li class="selected"><h1>Carrinho</h1></li>
                        <li class="selected"><h1>Identificação</h1></li>
                        <li class="selected"><h1>Conferência</h1></li>
                        <li><h1>Pagamento</h1></li>
                        <li><h1>Confirmação</h1></li>
                     </ul>

                    </div>
                    <h3>Conferência</h3>

                    <div class="txt-interna-servicos" style="margin-left:-10px; margin-top:30px;">
                    <div class="centerCursos" style="border-top:none; width:700px;">

					   <?php if($carrinho && !empty($carrinho)): ?>

							<table width="100%" border="0" class="tabelaAreaRestrita" style="border-top:0px;">
		                  	<tbody>
		                    <tr>
		                        <td style="border:none;"><h6>Descrição</h6></td>
		                        <td style="border:none;"><h6><center>Preço</center></h6></td>
		                        <!--<td style="border:none;"><h6><center>Excluir</center></h6></td>-->
		                 	</tr>

		                 	<?php $total = 0; ?>
		                 	<?php foreach($carrinho as $item): ?>
                                        
                                       
			                    <!-- Para cada item no carrinho, exibir o código abaixo -->
			                      <tr>
			                        <td class="descricao-carrinho" width="65%">
			                        <div>
			                        	<!--<div style="float:left; width:150px; position:relative; top:20px;">
			                            <img src="<?php echo base_url(); ?>assets/img/check-active.png" align="top"><span class="tituloItem">Novo item adicionadoa</span>
			                            </div>
			                            -->

			                            <div>
			                            <!--<img src="<?php echo base_url(); ?>assets/img/video-thumb-sample.png" width="80">-->
			                            <h2><?php echo $tipos_cursos[$item['tipo']]; ?></h2>
			                            <h3><?php echo $item['titulo']; ?></h3>
			                            <?php if($item['turma_data']): ?>
			                            	<h3>Turma: <?php echo br_date($item['turma_data']); ?></h3>
			                            <?php endif; ?>
			                            </div>
			                        </div>
			                        </td>
			                        <td class="tabela-carrinho-preco"><center>R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?></center></td>
			                        <!--<td style="border-left:none !important;"><center><a href="<?php echo site_url('carrinho/excluir/'.$item['curso_id'].'/'.$item['tipo']); ?>"><img src="<?php echo base_url(); ?>assets/img/icon-delete-x.gif" border="0"></a></center></td>-->
			                      </tr>
			                    <!-- Fim para cada item no carrinho, exibir o código acima -->
			                    <?php $total += $item['valor']; ?>
		                    <?php endforeach; ?>
                                            
                                             <?php //print_r($total);
                                       
                                        ?>
                                            
		                    <!-- Total-->
		                      <tr>
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

	                      </div>

	                    </div>

	                    <!-- Carrinho zerado (Somente um curso, e gratuito) -->
	                    <?php if($total == 0): ?>

	                    	<div style="font-size:12px; display:inline-block;">

	                    		<form target="_parent" method="post" action="" id="form_pagamento">
							    	<input type="hidden" name="total" value="<?php echo number_format($total, 2, '.', ''); ?>">
								</form>

	                    		<a href="#" onclick="return enviaForm();"><img src="<?php echo base_url(); ?>assets/img/btn-finalizar-compra.gif" align="right"></a>
	                    	</div>

		                <?php else: ?>

							<h3 style="border-top:none;">SELECIONE A FORMA DE PAGAMENTO</h3>
		                    <div style="font-size:12px; display:inline-block;">
		                    <p>Para sua maior segurança, todo o pagamento eletrônico é realizado através do Sistema PagSeguro da UOL.</p>
		                    <p>O usuário poderá optar pelas seguintes formas de pagamento:<br/>
		                    - Cartão de Crédito: Validação imediata.<br/>
		                    - Boleto bancário: Validação no 1o dia útil subsequente.</p>
		                    <p>Para concluirmos sua compra, é necessário portanto iniciarmos uma transação com o Sistema PagSeguro.</p>

		                        <!-- Declaração do formulário -->
							    <form target="_parent" method="post" action="https://pagseguro.uol.com.br/v2/checkout/payment.html" id="form_pagamento">

							        <!-- Campos obrigatórios -->
							        <input type="hidden" name="receiverEmail" value="adriana@netmb.com.br">
							        <input type="hidden" name="currency" value="BRL">
							        <input type="hidden" name="total" value="<?php echo number_format($total, 2, '.', ''); ?>">

							        <!-- Itens do pagamento (ao menos um item é obrigatório) -->
							        <?php $i = 1; ?>
							        <?php foreach($carrinho as $item): ?>
							        	<?php if($item['valor'] > 0): ?>
									        <input type="hidden" name="itemId<?php echo $i; ?>" value="<?php echo $item['tipo'].'-'.$item['curso_id']; ?>">
									        <input type="hidden" name="itemDescription<?php echo $i; ?>" value="<?php echo $item['titulo']; ?>">
									        <input type="hidden" name="itemAmount<?php echo $i; ?>" value="<?php echo $item['valor']; ?>">
									        <input type="hidden" name="itemQuantity<?php echo $i; ?>" value="1">
								        	<?php $i++; ?>
								        <?php endif; ?>
							        <?php endforeach; ?>

							        <!-- Código de referência do pagamento no seu sistema (opcional)-->
							        <input type="hidden" name="reference" id="reference" value="">

							        <!-- Dados do comprador (opcionais) -->
							        <input type="hidden" name="senderName" value="<?php echo $this->session->userdata('SessionTipoPessoa')=='F'? $this->session->userdata('SessionNomeAluno'):$this->session->userdata('SessionNomeEmpresa'); ?>">
							        <input type="hidden" name="senderAreaCode" value="<?php echo $this->session->userdata('SessionTipoPessoa')=='F'? $this->session->userdata('SessionIdAluno'):$this->session->userdata('SessionIdEmpresa'); ?>">
							        <input type="hidden" name="senderEmail" value="<?php echo $this->session->userdata('SessionTipoPessoa')=='F'?$this->session->userdata('SessionEmailAluno'):$this->session->userdata('SessionEmailEmpresa'); ?>">

							    </form>

		                    	<a href="#" onclick="return enviaForm();"><img src="<?php echo base_url(); ?>assets/img/continuar-pag-seguro.jpg" align="right"></a>
		                    </div>

		                <?php endif; ?>

                    <?php else: ?>
						<p>Nenhum item adicionado ao carrinho.</p>
                      <?php endif; ?>

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