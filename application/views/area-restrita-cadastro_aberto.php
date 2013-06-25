        <?php include("includes/topo.php"); ?>
          <?php include("includes/banner-interna.php"); ?>
           
            <div class="content">
              <div class="content-interna">
             
                <div class="left-internas2">
                  <div class="breadcrumb">
                       <ul>
                           <li><a href="<?php echo site_url();?>">Home ></a></li>
                        <li><a href="">Cadastro</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">
                  
                    <div class="txt-interna-servicos">
                     
                     
                    </div>
                    <h3>Cadastro</h3>
                  	
                    <div class="txt-interna-servicos">
                    <p>Após a submissão do cadastro, você receberá um e-mail com a confirmação do seu registro. Campos com * são de preenchimento obrigatório.</p>
                    
                    <form id="frmCadastro" name="frmCadastro" class="form-cadastro" method="post" action="<?php echo site_url('meucadastro/inserircadastro_aberto');?>">
                      
                      <div class="fieldEmail"><p>E-mail*</p> <input type="text" name="email" id="email" size="50" value="<?php echo $ativo['ativo']==1?$aluno[0]->email:'';?>"></div>
                      
                      <div class="fieldSenha"><p>Senha*</p> <input type="text" name="senha" id="senha" size="15" maxlength="8"> 
                      <label for="cpf" class="error erroSenha" style=""></label>
                          <div style="display:inline-block; margin-left:12px;">Confirmar senha* <input type="text" name="confirmar-senha" id="confirmar-senha" size="15" maxlength="8"></div></div>
                      
                      <div class="fieldNome"><p>Nome completo</p> <input type="text" name="nome" id="nome" size="50" value="<?php echo $ativo['ativo']==1?$aluno[0]->nome:'';?>"></div>
                      
                      <div class="fieldCPF" ><p>CPF*</p>
                        <input type="text" name="cpf_cnpj" id="cpf" data-format="cnpj_cpf"<?php echo $ativo['ativo']==1?'disabled':'';?> size="20" value="<?php echo $ativo['ativo']==1?$aluno[0]->cpf_cnpj: '';?>">
                        <label for="cpf" class="error erroPass" style=""></label>
                      <div style="display:inline-block; margin-left:10px;">Data de nascimento* <input type="text" name="data_nascimento" id="data-nascimento" size="13" value="<?php echo $ativo['ativo']==1?br_date($aluno[0]->data_nascimento):'';?>"></div></div>
                      <div class="fieldSexo"><p>Sexo</p>
                        <select name="sexo" id="sexo">
                            <option value="M" <?php echo $ativo['ativo']==1? $aluno[0]->sexo=='M'?'selected':'':'';?>>Masculino</option>
                            <option value="F" <?php echo $ativo['ativo']==1? $aluno[0]->sexo=='F'?'selected':'':'';?>>Feminino</option>
                        </select>
                      </div>
                      <div class="fieldTelefone"><p>Telefone fixo</p> <input type="text" name="telefone" id="telefoneFixo" size="15" value="<?php echo $ativo['ativo']==1?$aluno[0]->telefone:'';?>">
                      <div style="display:inline-block; margin-left:17px;">Telefone Celular <input type="text" name="Celular" id="telefoneCelular" size="15" value="<?php echo $ativo['ativo']==1?$aluno[0]->celular:'';?>"></div></div>
                      
                      <hr>
                    <div class="frmCEP"><p>CEP*</p> <input type="text" name="cep" id="cep" size="15" value="<?php echo $ativo['ativo']==1?$aluno[0]->cep:'';?>"> <img id="loading-cep" style="display:none" src="<?php echo base_url(); ?>assets/img/loading-cep.gif" alt=""> </div>
                   
                      <div class="frmEndereco"><p>Endereço*</p> <input type="text" name="endereco" id="endereco" size="50" value="<?php echo $ativo['ativo']==1?$aluno[0]->endereco:'';?>"></div>
                      <div class="frmNumero"><p>Número*</p> <input type="text" name="numero" id="numero" size="15" value="<?php echo $ativo['ativo']==1?$aluno[0]->numero:'';?>">
                      <div style="display:inline-block; margin-left:29px;">Complemento <input type="text" name="complemento" id="complemento" size="15" value="<?php echo $ativo['ativo']==1?$aluno[0]->complemento:'';?>"></div></div>
                      
                      <div class="frmBairro"><p>Bairro*</p> <input type="text" name="bairro" id="bairro" size="50" value="<?php echo $ativo['ativo']==1?$aluno[0]->bairro:'';?>"></div>
                      
                      <div class="frmCidade"><p>Cidade*</p> <input type="text" name="cidade" id="cidade" size="15" value="<?php echo $ativo['ativo']==1?$aluno[0]->cidade:'';?>"> 
                          <div style="display:inline-block; margin-left:67px;">Estado <input type="text" name="estado" id="estado" maxlength="2" size="15" value="<?php echo $ativo['ativo']==1?$aluno[0]->estado:'';?>"></div></div>
                      
                      
                      <hr>
                      
                      <div class="frmProfissao"><p>Profissão*</p> <input type="text" name="profissao" id="profissao" size="20" value="<?php echo $ativo['ativo']==1?$aluno[0]->profissao:'';?>"></div>
                      <?if ($ativo['ativo']==10):?>
                      
                      <div class="frmMbConsultoria"><p>Como conheceu a MB Consultoria?</p>
                        <textarea name="como_conheceu" id="como_conheceu" class=""><?php echo $ativo['ativo']==1?$aluno[0]->como_conheceu:'';?></textarea>
                          
                      </div>  
                  
                      
                      <?php endif;?>
                      <hr>
                      <input type="hidden" name="tipo_pessoa" value="F">
                      <input type="submit" class="btn-enviar-cadastro">
                                       
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