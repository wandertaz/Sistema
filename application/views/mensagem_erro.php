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
                        <li><a> Mensagem</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">
                    <h3><?php echo $title ;?>:</h3>

                    <div class="txt-interna-servicos" style="margin-left:-10px; margin-top:0px;">
                    <div class="centerCursos" style="border-top:none; width:700px;">

                    <div class="boxLogin">
                      
                        <div>
                            <b style="font-size:14px;">
                                <?php if(isset($mensagem) && $mensagem): ?>
                                    <?php echo $mensagem; ?>
                                <?php endif; ?> 
                            </b>
                        </div> 
                        <div>
                            <form action="<?php echo site_url('loginlogout/index');?>">
                                <?php if(!$this->session->userdata('SessionIdEmpresa')&& !$this->session->userdata('SessionIdAluno')):?>                             
                                        <input type="submit" name="Fazer Login" value="Fazer login">                                                 
                                <?php endif; ?>
                                        <input type="button" name="Voltar" value="Voltar" onclick="history.back();">
                           </form>
                       </div>
                    	
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