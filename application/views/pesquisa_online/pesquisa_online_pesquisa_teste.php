<?php
include $_SERVER['DOCUMENT_ROOT'] . URL_VIEW_INCLUDES . 'topo.php';
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . URL_VIEW_INCLUDES . 'banner-interna.php';
?>


<div class="content">

    <div class="content-interna" style="background: #fff;">
        <div class="breadcrumb" style="padding: 0 10px;">
            <ul>
                <li><a href="<?php echo site_url(); ?>">Home ></a></li>
                <li><a>Pesquisa Online ></a></li>
                <li><a><?php echo $pesquisa->titulo; ?></a></li>
            </ul>
        </div>
        <div class="miolo-interna pesquisa_online" style="width: 710px;overflow: hidden;padding: 0 11px;">

            <h3 style="color:#F7931E;"><?php echo $pesquisa->titulo; ?></h3>
<?php if(isset($perguntas)): ?>
            <div class="box-form-pesquisa-online clear-both">
                <form action="#" id="pesquisa-online-pesquisa" class="clear-both <?php if(!isset($pesquisa_sugestao)) echo 'validate'; ?>" method="post">
                    <ul class="clear-both">
                        <li class="clear-both">
                            <div class="enterprise-infos-two-cols">
                                <div class="clear-both obs">
                                    <p>Gentileza confirmar ou preencher os campos de contato acima</p>
                                </div> 
                                <div class="the-col">
                                    <label class="enterprise-infos-label" for="pesquisa_on_empresa">
                                        <span>Empresa</span>
                                        <input type="text" <?php echo isset($pesquisa_sugestao)?'':'name="empresa"'?> value="<?php echo isset($pesquisado->empresa)?$pesquisado->empresa:'Nome Empresa';?>" id="pesquisa_on_empresa">
                                    </label>
                                    <label class="enterprise-infos-label" for="pesquisa_on_responsavel">
                                        <span class="enterprise-infos-label">Responsável</span>
                                        <input type="text" <?php echo isset($pesquisa_sugestao)?'':'name="nome"'?>  value="<?php echo isset($pesquisado->nome)?$pesquisado->nome:'nome';?>" id="pesquisa_on_responsavel">
                                    </label>
                                    <label class="enterprise-infos-label" for="pesquisa_on_email">
                                        <span class="enterprise-infos-label">E-mail</span>
                                        <input type="text" <?php echo isset($pesquisa_sugestao)?'':'name="email"'?> id="pesquisa_on_email" value="<?php echo isset($pesquisado->email)? $pesquisado->email:'email';?>">
                                    </label>
                                    <label class="enterprise-infos-label" for="pesquisa_on_tel">
                                        <span class="enterprise-infos-label">Telefone</span>
                                        <input type="text" <?php echo isset($pesquisa_sugestao)?'':'name="telefone"'?> id="pesquisa_on_tel" value="<?php echo isset($pesquisado->telefone)? $pesquisado->telefone:'';?>"  class="telMaskMB">
                                    </label>

                                </div>
                                <div class="the-col">
                                    <label class="enterprise-infos-label" for="pesquisa_on_cargo">
                                        <span class="enterprise-infos-label">Cargo/Área</span>
                                        <input type="text" <?php echo isset($pesquisa_sugestao)?'':'name="cargo"'?>  value="<?php echo isset($pesquisado->cargo)?$pesquisado->cargo:'Cargo/Área';?>" id="pesquisa_on_cargo">
                                    </label>
                                   <!-- <label class="enterprise-infos-label" for="pesquisa_on_data_apresentacao">
                                        <span class="enterprise-infos-label">Data de Apresentação</span>
                                        <input type="text" name="pesquisa_on_data_apresentacao" id="pesquisa_on_data_apresentacao">
                                    </label>-->
                                    <div class="img-logos">                                        
                                        <img src="<?php echo site_url(); ?><?php echo$pesquisa->logo==''? 'assets/img/logo-do-cliente.png':'assets/uploads/logo/'.$pesquisa->logo;?>" width="145" alt="">
                                        <img src="<?php echo site_url(); ?>assets/img/logo-black.png" width="145" alt="">
                                    </div>
                                </div>                              
                            </div>
                        </li>

<hr>
<?php $i = 1 ?>
<?php foreach($perguntas as $pergunta): ?>
			<div class="input text">

	 			<?php if($pergunta->tipo == 'RAD'): ?><!--radio-->
	 				<?php if(isset($pergunta->opcoes) && $pergunta->opcoes): ?>
                                            <li class="clear-both">                                                
                                                 <div class="label-el-box"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></div>                                                   
                                                        <div class="el-box">
                                                           
                                                        <?php foreach($pergunta->opcoes as $opcao): ?>                                                           
                                                           
                                                            <label class="el" for="<?php echo $pergunta->id_pesquisas_perguntas; ?>">
                                                                <input class="required" <?php echo isset($pesquisa_sugestao)?'disabled="disabled"':'' ?> type="radio" value="<?php echo $opcao->id_pesquisas_perguntas_opcoes; ?>" name="<?php echo isset($pesquisa_sugestao)?'':$pergunta->id_pesquisas_perguntas; ?>"><?php echo $opcao->opcao; ?>
                                                            </label>         
                                                         
                                                        <?php endforeach; ?>
                                                        </div>
                                            </li>
                                            
                                            <?php if(isset($pesquisa_sugestao)):?>
                                                Se necessário, registre aqui sua sugestão ou revisão para esta pergunta:
                                                <input type="text" name="<?php echo $pergunta->id_pesquisas_perguntas; ?>" size="100">
                                                <hr>
                                            <?php endif;?>
		 			<?php endif; ?>

	 			<?php elseif($pergunta->tipo == 'CHE'): ?><!--Ok-->
	 				<?php if(isset($pergunta->opcoes) && $pergunta->opcoes): ?>
                                            
                                             <li class="clear-both">
                                                <div class="label-el-box"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></div>
                                                <div class="el-box">
                                                    <?php foreach($pergunta->opcoes as $opcao): ?>
                                                        <label class="el" for="">
                                                                <input type="checkbox" <?php echo isset($pesquisa_sugestao)?'disabled="disabled"':'' ?> name="<?php echo isset($pesquisa_sugestao)?'':$pergunta->id_pesquisas_perguntas; ?>" value="<?php echo $opcao->id_pesquisas_perguntas_opcoes; ?>">
                                                                    <?php echo $opcao->opcao; ?>
                                                        </label>



                                                    <?php endforeach; ?>
                                                </div>
                                                <?php if(isset($pesquisa_sugestao)):?>
                                                   Se necessário, registre aqui sua sugestão ou revisão para esta pergunta:
                                                   <input type="text" name="<?php echo $pergunta->id_pesquisas_perguntas; ?>" size="100">
                                                   <hr>
                                               <?php endif;?>
		 			<?php endif; ?>

	 			<?php elseif($pergunta->tipo == 'P05'): ?><!--Ok-->
	 				<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
                                               
                                            <div class="label-el-box"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></div>
                                            <div class="box-radios-levels">
                                                <ul class="box-radios-level-ul-first">
                                                    <li class="box-radios-level-li-first">
                                                        <span class="box-radios-levels-label">Avaliação (Clique com o mouse no círculo referente à opção desejada)</span>
                                                    </li>
                                                    <li class="box-radios-level-li-first">
                                                        <ul class="box-radios-level-ul-second" style="float:right;">
                                                            <li class="box-radios-level-li-second">
                                                                <small>Fraco</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>Ruim</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>Regular</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>Bom</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>Ótimo</small>
                                                            </li>
                                                        </ul>
                                                    </li>                                                       
                                                            <?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
                                                                <li class="box-radios-level-li-first">
                                                                    <span class="box-radios-level-label"><?php echo $subpergunta->pergunta; ?></span>
                                                                        <ul class="box-radios-level-ul-second">                                                    
                                                                                                                                           
                                                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                                                <li class="box-radios-level-li-second">
                                                                                    <input class="required" <?php echo isset($pesquisa_sugestao)?'disabled="disabled"':'' ?> type="radio"  name="<?php echo isset($pesquisa_sugestao)?'':$subpergunta->id_pesquisas_perguntas; ?>" value="<?php echo $i; ?>" id="">
                                                                                    
                                                                                </li>
                                                                            <?php endfor; ?>
                                                                        </ul>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                
                                            <?php if(isset($pesquisa_sugestao)):?>
                                               Se necessário, registre aqui sua sugestão ou revisão para esta pergunta:
                                               <input type="text" name="<?php echo $pergunta->id_pesquisas_perguntas; ?>" size="100">
                                               <hr>
                                           <?php endif;?>
                                               
		 			<?php endif; ?><br>                                                

                                               
	 			<?php elseif($pergunta->tipo == 'P10'): ?><!--Ok-->
	 				<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
	 					<div class="label-el-box"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></div>
                                            <div class="box-radios-levels">
                                                <ul class="box-radios-level-ul-first">
                                                    <li class="box-radios-level-li-first">
                                                        <span class="box-radios-levels-label">Avaliação (Clique com o mouse no círculo referente à opção desejada)</span>
                                                    </li>
                                                    <li class="box-radios-level-li-first">
                                                        <ul class="box-radios-level-ul-second" style="float:right;">
                                                            <li class="box-radios-level-li-second">
                                                                <small>1</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>2</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>3</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>4</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>5</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>6</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>7</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>8</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>9</small>
                                                            </li>
                                                            <li class="box-radios-level-li-second">
                                                                <small>10</small>
                                                            </li>
                                                        </ul>
                                                    </li>      
						<?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
                                                    <li class="box-radios-level-li-first">
                                                        <span class="box-radios-level-label"><?php echo $subpergunta->pergunta; ?></span>
                                                             <ul class="box-radios-level-ul-second">          
                                                                <?php for($i = 1; $i <= 10; $i++): ?>
									<li class="box-radios-level-li-second">
                                                                                    <input type="radio" <?php echo isset($pesquisa_sugestao)?'disabled="disabled"':'' ?>  name="<?php echo isset($pesquisa_sugestao)?'':$subpergunta->id_pesquisas_perguntas; ?>" value="<?php echo $i; ?>" id="">
                                                                                    
                                                                        </li>
								<?php endfor; ?>
                                                          </ul>
                                                   </li>							
		 				<?php endforeach; ?>
                                          </ul>
                                            </div>
                                            <?php if(isset($pesquisa_sugestao)):?>
                                               Se necessário, registre aqui sua sugestão ou revisão para esta pergunta:
                                               <input type="text"  name="<?php echo $pergunta->id_pesquisas_perguntas; ?>" size="100">
                                               <hr>
                                           <?php endif;?>
		 			<?php endif; ?>

                                                
	 			<?php elseif($pergunta->tipo == 'CLA'): ?><!--ok-->
	 				<?php if(isset($pergunta->sub_perguntas) && $pergunta->sub_perguntas): ?>
                                                 <li class="clear-both">
                                                    <div class="label-el-box"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></div>
                                                        <div class="el-box">                                             
	 					
                                                            <?php foreach($pergunta->sub_perguntas as $subpergunta): ?>
                                                                    <div class="el-box">
                                                                            <?php echo $subpergunta->pergunta; ?>
                                                                        
                                                                            <select <?php echo isset($pesquisa_sugestao)?'disabled="disabled"':'' ?> class="required input" name="<?php echo isset($pesquisa_sugestao)?'':$subpergunta->id_pesquisas_perguntas; ?>">
                                                                                    <option value="">--</option>
                                                                                    <?php for($i = 1; $i <= $pergunta->total_sub_perguntas; $i++): ?>
                                                                                            <option value="<?php echo $i; ?>" ><?php echo $i; ?></value>
                                                                                    <?php endfor; ?>
                                                                            </select>&nbsp;&nbsp;
                                                                        </span>
                                                                    </div>
                                                            <?php endforeach; ?>
                                                       </div>
                                                </li> 
                                                <?php if(isset($pesquisa_sugestao)):?>
                                                       Se necessário, registre aqui sua sugestão ou revisão para esta pergunta:
                                                       <input type="text" name="<?php echo $pergunta->id_pesquisas_perguntas; ?>" size="100">

                                                       <hr>
                                              <?php endif; ?> 
		 			<?php endif; ?>                                                
	 			<?php else: ?>
                                         <li class="clear-both">
                                            <div class="label-el-box"><?php echo($i) ?> - <?php echo $pergunta->pergunta; ?></div>
                                                <div class="el-box">
                                                    <label class="el el-textarea" for="">
                                                        <textarea <?php echo isset($pesquisa_sugestao)?'disabled="disabled"':'' ?> class="required" name="<?php echo isset($pesquisa_sugestao)?'':$pergunta->id_pesquisas_perguntas; ?>" id=""></textarea>
                                                    </label>
                                                </div>
                                         </li>
                                         <?php if(isset($pesquisa_sugestao)):?>
                                            Se necessário, registre aqui sua sugestão ou revisão para esta pergunta:
                                            <input type="text" name="<?php echo $pergunta->id_pesquisas_perguntas; ?>" size="100">
                                            <hr>
                                        <?php endif;?>
                                         
	 			<?php endif; ?>
                                         
                               
			</div>
			<?php $i++; ?>
			<?php endforeach; ?>

                        <?php if(isset($pesquisa_sugestao)):?> 
                                              
            
                            <div class="botoes-pesquisa">
                                <a href="javascript: $('#acao').val('nao'); $('#pesquisa-online-pesquisa').submit();" class="nao-aprovar"><img src="<?php echo site_url(); ?>assets/img/icon-delete-x.gif" alt="Não aprovar" height="16" title="Não aprovar" width="14" />Não Aprovar</a>
                                <a href="javascript: $('#acao').val('sim'); $('#pesquisa-online-pesquisa').submit();" class="botao-solicitar-alteracoes nao-aprovar" title="Solicitar alterações"><img src="<?php echo site_url(); ?>assets/img/icon-pen.png" alt="Solicitar alterações" height="16" title="Solicitar alterações" width="14" />Solicitar alterações</a>


                                <a href="<?php echo site_url('/pesquisa_online/aprovar/'.$pesquisa->id_pesquisas) ?>" class="botao-aprovar-pesquisa"><img src="<?php echo site_url(); ?>assets/img/botao-aprovar-pesquisa.png" alt="Aprovar" height="15" title="Aprovar" width="200" /></a>

								<div class="clear-both"></div>   
                            </div>


                        <?php else:?> 
                                <li class="clear-both">
                                    <div class="label-el-box"></div>
                                    <div class="el-box" style="float: right;margin-right: 30px;">
                                        <a class="pesquisa_online_formulario-btns salvar-e-mais-tarde-bt" href="<?php echo site_url() ?>" style="padding-top: 45px;">Cancelar</a>
                                        <input class="pesquisa_online_formulario-btns finalizar-enviar-bt" type="submit" value="Enviar">
                                    </div>
                                </li>
                        <?php endif;?>

                    </ul>
                    <input type="hidden" name="pesquisa_id" value="<?php echo $pesquisa->id_pesquisas; ?>" />
                    <input type="hidden" name="contato_id" value="<?php echo isset($pesquisado->id_pesquisas_contatos)? $pesquisado->id_pesquisas_contatos:''; ?>" />
                </form>
            </div>
<?php endif;?>

        </div>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . URL_VIEW_INCLUDES . 'box-destaques.php';
        ?>
    </div>
    <div class="right">
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . URL_VIEW_INCLUDES . 'servicos-home.php';
        ?>
    </div>

</div>


<?php
include $_SERVER['DOCUMENT_ROOT'] . URL_VIEW_INCLUDES . 'rodape.php';
?>