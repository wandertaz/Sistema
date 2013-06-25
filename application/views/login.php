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
                        <li><a> Login</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">
                    <h3>Login</h3>

                    <div class="txt-interna-servicos page-login" style="margin-left:-10px; margin-top:30px;">

                    <div class="boxLogin login-page">
                      	<?php if(isset($mensagem) && $mensagem): ?>
                  		<p style="color:red; font-weight:bold;"><?php echo $mensagem; ?></p>
                    	<?php endif; ?>
                        <?php if(isset($mensagem_sucesso) && $mensagem_sucesso): ?>
                  		<p style="color:green; font-weight:bold;"><?php echo $mensagem_sucesso; ?></p>
                    	<?php endif; ?>
                    <form action="<?php echo site_url('loginlogout/login'); ?>" method="POST">
                    <div class="error-login-page"><span>msg de erro!</span></div>
                     
               
                    <div class="input-login-page"><span>E-mail:</span> <input type="text" value="<?php echo isset($mensagem_sucesso)? isset($dados['email'])?$dados['email']:'':''; ?>" name="usuario" id="email" size="20" ></div>
                    <div class="input-login-page"><span>Senha:</span> <input type="password" value="<?php echo isset($mensagem_sucesso)? isset($dados['senha'])? trim($dados['senha']):'':''; ?>" name="senha" id="senha" size="20" >
                      <input type="hidden" name="url" id="url" value="<?php echo isset($url) && $url ? $url : false; ?>"><br>
                      Novo Cadastro <a class="lightRecovery" href="<?php echo site_url('meucadastro/cadastronovoaberto/F'); ?>">Pessoa física</a> 
                      <a class="lightRecovery" href="<?php echo site_url('meucadastro/cadastronovoaberto/J'); ?>">Pessoa Juridica</a>
                      Esqueci minha senha
                      <a data-fancybox-type="iframe" class="lightRecovery" href="<?php echo site_url('loginlogout/recuperar_senha'); ?>">(recuperar senha)</a>
                    </div>
                    <div class="btn-submit-login-page">
                      <input type="submit" name="btn-login" id="btn-login" class="btn-login-area-restrita" value="">
                    </div>
                    </form>
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