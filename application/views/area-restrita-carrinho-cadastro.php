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
                            <li><a href="<?php echo site_url();?>verifica_identificacao">Meu carrinho</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3>&nbsp;</h3>
                    <div class="txt-interna-servicos">

                     <ul class="carrinho-progresso">
                     	<li class="selected"><h1>Carrinho</h1></li>
                        <li class="selected"><h1>Identificação</h1></li>
                        <li><h1>Conferência</h1></li>
                        <li><h1>Pagamento</h1></li>
                        <li><h1>Confirmação</h1></li>
                     </ul>

                    </div>
                    <h3>Cadastro</h3>

                    <div class="txt-interna-servicos">
                    <p>Após a submissão do cadastro, você receberá um e-mail com a confirmação do seu registro. Campos com * são de preenchimento obrigatório.</p>

                    <form action="<?php echo site_url('carrinho/cadastro'); ?>" id="frmCadastro" name="frmCadastro" method="post">

						<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

                      <div class="fieldEmail"><p>E-mail*</p> <input type="text" name="email" id="email" size="59" value="<?php echo (isset($email) && $email ? $email : ''); ?>"></div>
                      <div class="fieldSenha"><p>Senha* <small style="display: block;float: left;color: red;width: 120px;">O mínimo de caracteres é 6</small></p> <input type="password" name="senha" id="senha" size="15">
                          <label for="cpf" class="error erroSenha" style=""></label>
                      <div style="display:inline-block; margin-left:12px;">Confirmar senha* <input type="password" name="confirmar-senha" id="confirmar-senha" size="15"></div></div>

                      <div class="fieldNome"><p>Nome completo ou razão social*</p> <input type="text" name="nome" id="nome" size="59"></div>

                      <div class="fieldCPF"><p>CNPJ/CPF*</p> <input type="text" data-format="cnpj_cpf" name="cpf_cnpj" id="cpf" size="15">
                          <label for="cpf" class="error erroPass" style=""></label>
                      <div style="display:inline-block; margin-left:10px;">Data de nascimento* <input type="text" name="data_nascimento" id="data-nascimento" size="13"></div></div>
                      <div class="fieldSexo"><p>Sexo*</p>
                        <select name="sexo" id="sexo">
                        	<option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                      </div>
                      <div class="fieldTelefone"><p>Telefone fixo</p> <input type="text" name="telefone" id="telefoneFixo" size="15">
                      <div style="display:inline-block; margin-left:17px;">Telefone Celular <input type="text" name="celular" id="telefoneCelular" size="15"></div></div>

                      <hr>

                      <div class="frmCEP"><p>CEP*</p> <input type="text" name="cep" id="cep" size="15">  <img id="loading-cep" style="display:none" src="<?php echo base_url(); ?>assets/img/loading-cep.gif" alt=""> </div>

                      <div class="frmEndereco"><p>Endereço*</p> <input type="text" name="endereco" id="endereco" size="59"></div>
                      <div class="frmNumero"><p>Número*</p> <input type="text" name="numero" id="numero" size="15">
                      <div style="display:inline-block; margin-left:29px;">Complemento <input type="text" name="complemento" id="complemento" size="15"></div></div>

                      <div class="frmBairro"><p>Bairro*</p> <input type="text" name="bairro" id="bairro" size="59"></div>

                      <div class="frmCidade"><p>Cidade*</p> <input type="text" name="cidade" id="cidade" size="15">
                      <div style="display:inline-block; margin-left:67px;">Estado <input type="text" name="estado" id="estado" size="2" maxlength="2"></div></div>

                      <hr>

                      <div class="frmProfissao"><p>Profissão*</p> <input type="text" name="profissao" id="profissao" size="59"></div>
                      <div class="frmMbConsultoria"><p>Como conheceu a MB Consultoria?</p>
                      <select name="como_conheceu" id="como-conheceu">
                      	<option value="Opção A">Opção A</option>
                        <option value="Opção B">Opção B</option>
                        <option value="Opção C">Opção C</option>
                      </select>
                      </div>

                      <hr>

                      <div class="frmCheckTermos"><input name="receberNews" id="receberNews" type="checkbox" value="S"> Quero receber as atualizações de Newsletters.</div>


                      <!--<div class="frmProfissao"><p>Contrato</p> <textarea id="contrato" name="contrato" rows="10" cols="54"></textarea></div>

                      <div class="frmCheckTermos"><input name="checkTermos" id="checkTermos" type="checkbox" value="T"> Aceito as condições do contrato acima</div>
						-->

                      <input type="submit" class="btn-enviar-cadastro" name="enviar" value="">

                    </form>

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