<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>

<?php
	include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'banner-interna.php';
?>
          <?php //include("includes/banner-interna.php"); ?>

            <div class="content">
              <div class="content-interna">
                <div class="left-internas" style="width:710px;height: 1056px;">
                   <div class="breadcrumb">
                       <ul>
                        <li><a href="#">Home ></a></li>
                        <li><a href="#">Bussiness Store > </a></li>
                        <li><a href="#">Orçamento On-line</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                  	<h3 style="margin-bottom: 15px;">Faça seu orçamento on-line</h3> 

					<div class="box-alert-orcamento">
                  		<p class="min-paragraph">Ao concluir o preenchimento do formulário de orçamento on line,  você receberá por e-mail uma estimativa de valores para investimento no projeto selecionado, conforme as informações encaminhadas pelo formulário. </p>
						<p class="min-paragraph">Para receber a visita de nossa área comercial e proposta detalhada, com prazos e valores precisos, entre em contato conosco ou clique no botão abaixo para solicitar. Recomendamos que este contato seja feito sempre que a empresa já tiver definido em seu planejamento, a implantação do projeto selecionado.  Neste caso, o consultor deverá realizar um breve diagnóstico,  para que a proposta seja elaborada e apresentada em sua empresa.</p>
						<p class="min-paragraph last-item">Somente empresas (pessoa jurídica) com CNPJ poderão solicitar orçamentos e proposta.</p>
					</div>

                        <form action="<?php  echo site_url('orcamento_online/salva_dados/'.$tipo_orcamento);?>" id="form_tela_inicial" method="post">

				
                                    <div class="bloco-formulario">
						<div class="bloco-formulario-full-col tela_inicial left-col to-left">
							<div class="box-radio to-left">
								<label for="form_tela_inicial_empresa" class="box-input">
									<span class="to-left label-txt-label-width">Empresa:</span>
									<input type="text" name="form_tela_inicial_empresa" id="form_tela_inicial_empresa" class="to-left" value="<?php echo isset($empresa)?$empresa['nome']:'' ;?>">
								</label>

								<label for="form_tela_inicial_cnpj" class="box-input">
									<span class="to-left label-txt-label-width">CNPJ:</span>
									<input type="text" name="form_tela_inicial_cnpj" id="form_tela_inicial_cnpj" class="to-left cnpjMask" value="<?php echo isset($empresa)?$empresa['cnpj']:'' ;?>" >
								</label>

								<label for="form_tela_inicial_responsavel_orcamento" class="box-input last-item">
									<span class="to-left label-txt-label-width">Responsável  pelo orçamento:</span>
									<input type="text" name="form_tela_inicial_responsavel_orcamento" id="form_tela_inicial_responsavel_orcamento" class="to-left" >
								</label>
							</div>
						</div>
					</div>

					<div class="bloco-formulario">
						<div class="bloco-formulario-col tela_inicial left-col to-left">
							<div class="box-radio to-left">
								<label for="form_tela_inicial_cargo_responsavel" class="box-input" style="margin-bottom: 30px;">
									<span class="to-left label-txt-label-width">Cargo do responsável:</span>
									<input type="text" name="form_tela_inicial_cargo_responsavel" id="form_tela_inicial_cargo_responsavel" class="to-left" >
								</label>

								<label for="form_tela_inicial_email" class="box-input">
									<span class="to-left label-txt-label-width">E-mail:</span>
									<input type="text" name="form_tela_inicial_email" id="form_tela_inicial_email" class="to-left" value="<?php echo isset($empresa)?$empresa['email']:'' ?>" >
								</label>
							</div>
						</div>

						<div class="bloco-formulario-col tela_inicial right-col to-right">
							<div class="box-radio to-left">
								<label for="form_tela_inicial_responsavel_tel_direto" class="box-input" style="margin-bottom: 30px;">
									<span class="to-left label-txt-label-width">Telefone Direto:</span>
									<input type="text" name="form_tela_inicial_responsavel_tel_direto" id="form_tela_inicial_responsavel_tel_direto" class="to-left" value="<?php echo isset($empresa)?$empresa['telefone']:'' ?>" >
								</label>

								<label for="form_tela_inicial_responsavel_celular" class="box-input">
									<span class="to-left label-txt-label-width">Celular:</span>
									<input type="text" name="form_tela_inicial_responsavel_celular" id="form_tela_inicial_responsavel_celular" class="to-left" value="<?php echo isset($empresa)?$empresa['celular']:'' ?>" >
								</label>
							</div>
						</div>
					</div>

					<div class="bloco-formulario">
						<div class="right-col to-right">
							<input type="submit" value="" class="input-submit-orcamento tela_inicial">
						</div>
					</div>	

					</form>

					<div class="info-outros-servicos">
						<p>Para informações de outros serviços não disponíveis para orçamento On-line:</p>						
                                                <a class="various" data-fancybox-type="iframe" href="<?php echo site_url('orcamento_online/novo_orcamento');?>"><img src="<?php echo base_url(); ?>assets/img/solicitar-proposta-personalizada.png" alt=""></a>
					</div>

                  </div>
				</div>

               </div>
				<div class="right">
                                    <?php
						//include("includes/servicos-home.php");
					?>
                                    <?php
                                        include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'servicos-home.php';
                                    ?>
                </div>
            </div>

<?php include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'rodape.php'; ?>