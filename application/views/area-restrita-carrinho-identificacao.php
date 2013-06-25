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
                        <li><a href="<?php echo site_url();?>identificacao">Meu carrinho</a></li>
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
                    <h3>Identificação</h3>

                    <div class="txt-interna-servicos" style="margin-left:-10px; margin-top:30px;">
                    <div class="centerCursos" style="border-top:none; width:700px;">

                    <div class="boxLogin">
                    	<?php if($mensagem): ?>
                    		<p><?php echo $mensagem; ?></p>
                    	<?php endif; ?>
                    	<form action="<?php echo site_url('carrinho/verifica_identificacao'); ?>" method="POST">
							<div>Digite seu email: <input type="text" name="email" id="email" size="20" ></div>
		                    <div>
		                      <table width="300">
		                        <tr>
		                          <td>
		                            <input type="radio" name="tipo" value="cadastro" id="RadioGroup1_0">
		                            <label>Esta é minha primeira compra</label>
		                            <label class="lblTipSenha">(Você criará sua senha no passo seguinte)</label>
		                            </td>
		                        </tr>
		                        <tr>
		                          <td><label>
		                            <input type="radio" name="tipo" value="login" id="RadioGroup1_1">
		                            Já sou cadastrado e minha senha é</label></td>
		                        </tr>
		                      </table>
		                    </div>
		                    <div style="margin-left:100px; margin-top:20px;">
		                    <input type="password" name="senha" id="senha" size="20">
		                    <label>> Esqueci minha senha</label>
		                    </div>

		                      <div>
		                      <input type="submit" name="btn-login" id="btn-login" class="btn-login-area-restrita" value="">
		                      </div>
						</form>
                    </div>


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