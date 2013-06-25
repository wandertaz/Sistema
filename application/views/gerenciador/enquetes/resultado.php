<style>

.completude { width:400px; float:left; height:16px; background:#DDDDDD; margin-top:5px;}
.completude span { float:left; }
.completude p { margin:0 2px; float:left; color:#fff; width: 500px;}

</style>
<div id="tabela">

	<?php if($registro && $alternativas): ?>


		<div id="cima">
			<div class="adicionar">
				<p>Resultado da Enquete: <br /> <strong><?php echo $registro->pergunta; ?></strong></p>
			</div><!--/adicionar -->
		</div><!--/cima -->

		<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

		<div class="input text">
		<?php foreach($alternativas as $alternativa): ?>
			<div class="input text">
				<p style="width: 500px; "><?php echo $alternativa->resposta; ?> - <i><?php echo $alternativa->votos.' voto(s)' ?></i></p>
			    <div class="completude">
			     	<span style="<?php echo 'width:'.$alternativa->porcentagem.'%;';?> height:16px; background:#AE432E; position: relative;">
			     	<p><?php echo $alternativa->porcentagem.'%'; ?></p></span>
			    </div>
		    </div>
		<?php endforeach; ?>
		</div>


	<?php endif; ?>

</div><!--/tabela -->