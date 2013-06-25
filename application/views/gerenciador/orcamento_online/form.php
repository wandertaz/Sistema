<script type="text/javascript">
	$(document).ready(function() {
		$("#form").validate();
	});
</script>
<div id="tabela">

	<h3 class="inserir-noticia-titulo"><?php echo $h1;?></h3>

	<?php echo form_open_multipart($controller.'/salvar', array("id" => "form"));?>

	  	<fieldset>
                    <div style="float:right;">
                            <label for="inscritos_id">Valor Orçamento:<i></i></label>
                                <?php echo $registro->valor_orcamento>0?'R$ '.$registro->valor_orcamento:'-';?><br>
                        </div><br>
                   <fieldset>
                        <legend>Contato:</legend>
                        <div class="input text">
                                <label for="inscritos_id">Nome Empresa: <br /><i></i></label>
                               <?php echo $registro->nome_empresa;?>
                        </div>
                        <div class="input text">
                                <label for="inscritos_id">Email Resposta: <br /><i></i></label>
                               <?php echo $registro->email_resposta;?>
                        </div>

                        <div class="input text">
                                <label for="inscritos_id">Nome Responsável: <br /><i></i></label>
                               <?php echo $registro->nome_responsavel;?>
                        </div>

                         <div class="input text">
                                <label for="inscritos_id">Cargo Responsável: <br /><i></i></label>
                               <?php echo $registro->cargo_responsavel;?>
                        </div>

                        <div class="input text">
                                <label for="inscritos_id">Cnpj: <br /><i></i></label>
                               <?php echo $registro->cnpj;?>
                        </div>

                        <div class="input text">
                                <label for="inscritos_id">Celular: <br /><i></i></label>
                               <?php echo $registro->celular;?>
                        </div>
                         <div class="input text">
                                <label for="inscritos_id">Telefone: <br /><i></i></label>
                               <?php echo $registro->telefone;?>
                        </div>
                        <?php if($registro->tipo_orcamento=='OP'):?>             
                            <div class="input text">
                                    <label for="inscritos_id">Mensagem: <br /><i></i></label>
                                   <?php echo $registro->mensagem;?>
                            </div>
                        <?php endif;?>
                        
                    </fieldset>

                        <div style="float:right;">
                            <label for="inscritos_id">Tipo Orçamento:<i></i></label>
                               <?php if($registro->tipo_orcamento=='AI'):
                                            echo'Auditoria Interna';
                                        elseif($registro->tipo_orcamento=='PB'):
                                            echo'Orcamento On Line PBQP-h';
                                        elseif($registro->tipo_orcamento=='GA'):
                                            echo 'Sistema Gestão Ambiental ISO 14001';
                                        elseif($registro->tipo_orcamento=='SQ'):
                                            echo 'Sistema Gestão da Qualidade ISO 9001';
                                       elseif($registro->tipo_orcamento=='GS'):
                                           echo'Sistema Gestão Responsabilidade Social';
                                       elseif($registro->tipo_orcamento=='SS'):
                                           echo 'Sistema Saúde e Segurança';
                                       elseif($registro->tipo_orcamento=='TR'):
                                           echo'Treinamento';
                                        elseif($registro->tipo_orcamento=='OP'):
                                           echo'Orçamento Personalizado';
                                       endif;
                                 ?>
                               <br>
                        </div><br>

                    <fieldset>
                      
                        <legend>Dados do Orçamento:</legend>

                        <?php if(isset($dados_formulario)): ?>
                        	<?php foreach($dados_formulario as $campo => $valor): ?>
                        		<div class="input text">
                                	<label><?php echo $campo; ?>: </label>
                                        <?php if(is_array($valor)):?>
                                            <?php foreach($valor as $valor_array):?>
                                                <?php echo $valor_array ;?>&nbsp;
                                            <?php endforeach;?>
                                        <?php else:?>
                                            <?php echo $valor;?>
                                        <?php endif;?>
                        		</div>
                        	<?php endforeach; ?>
                         <?php else: ?>
                              <h2>O intessado não concluiu o orçamento!</h2>
                        <?php endif; ?>

                    </fieldset>

			<div class="submit">
                <input type="button" value="voltar" onclick="history.back()" />
			</div>

		</fieldset>

	<?php echo form_close();?>

</div>