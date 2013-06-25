<div id="tabela">

	<script type="text/javascript">
		function confima_liberacao(){
			if(confirm('Tem certeza que deseja liberar o certificado?') == true)
				return true;
			else
				return false;
		}
	</script>

	<div id="cima">

		<?php echo form_open($controller.'/buscar', array('id' => 'UserIndexForm', 'method' => 'get'));?>
			<div class="busca">
				<span class="buscar-span">Buscar</span>
				<input type="hidden" name="tipo" id="tipo" value="<?php echo $tipo;  ?>" />
				<input type="text" name="s" class="busca-input" id="s" value="<?php echo ( ! isset($_GET['s'])) ? '' : $_GET['s'];?>" />
				<input type="submit" value="" class="btn-busca" />
			</div><!--/busca -->
		<?php echo form_close();?>

	</div><!--/cima -->

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(!count($registros)): ?>
		<div id="msg">Nenhum registro encontrado.</div>
	<?php else: ?>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><a href="#">Curso</a></th>
			<th>Inscrito</th>
			<th>Nota</th>
			<th class="actions">Ações</th>
		</tr>
		<?php foreach($registros as $row):?>
			<tr class="altrow">
				<?php $curso = array('AB' => $row->titulo_AB, 'IN' => $row->titulo_IN, 'AL' => $row->titulo_AL, 'DE' => $row->titulo_DE, 'EL' => $row->titulo_EL); ?>
				<td><?php echo $row->data_inicial ? $curso[$row->tipo_curso].' - Turma: '.br_date($row->data_inicial) : $curso[$row->tipo_curso];?></td>
				<td><?php echo $row->inscrito; ?></td>
				<td><?php echo $row->nota ? $row->nota.'/'.$row->valor : '0/0'; ?></td>
				<td class="actions">
					<?php echo anchor($controller.'/liberar/'.$row->id, 'Liberar Certificado', array("onclick"=>"return confima_liberacao()"));?>
				</td>
			</tr>
		<?php endforeach;?>
	</table>

	<div class="baixo">
		<?php if( isset($paginacao)):?>
			<div class="paginacao"><?php echo $paginacao;?></div><!--/paginacao -->
		<?php endif;?>
	</div><!--/baixo -->

	<?php endif; ?>

</div><!--/tabela -->