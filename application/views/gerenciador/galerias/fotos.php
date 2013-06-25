<?php if(isset($large_photo_exists) && $thumb_photo_exists == NULL): ?>
   	<link rel="stylesheet" href="<?php echo base_url();?>assets/multitools/css/imgareaselect/imgareaselect-animated.css" type="text/css" media="screen" />
	<script src="<?php echo base_url();?>assets/multitools/js/jquery.imgareaselect.js"></script>
   	<script src="<?php echo base_url();?>assets/multitools/js/jquery.imgpreview.js"></script>
    <script type="text/javascript">
    // <![CDATA[
        var thumb_width    = <?php echo $thumb_width ;?> ;
        var thumb_height   = <?php echo $thumb_height ;?> ;
        var image_width    = <?php echo $img_info[0] ;?> ;
        var image_height   = <?php echo $img_info[1] ;?> ;
    // ]]>
    </script>
<?php endif; ?>

<div id="tabela">

	<h1><?php echo $h1; ?></h1>
	<br />

	<div id="msg" style="font-size:16px; color: orange;"><?php if(isset($error) && $error) :?><?php echo $error ;?><?php endif ;?></div>
	<div id="msg" style="font-size:16px; color: orange;"><?php echo $this->session->flashdata('msg');?></div>

	<?php if(isset($large_photo_exists) && $thumb_photo_exists == NULL) :?>

		<h2>Criar miniatura da foto</h2>
		<p>Clique na foto abaixo e arraste para selecionar a miniatura desejada. </p>
		<div align="center">
	        <img src="<?php echo base_url() . $upload_path.'temp/'.$img['file_name'];?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />
	        <div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
	            <img src="<?php echo base_url() . $upload_path.'temp/'.$img['file_name'];?>" style="position: relative;" alt="Thumbnail Preview" />
	        </div>
	        <br style="clear:both;"/>
	        <form name="thumbnail" action="<?php echo site_url().$controller.'/salvar_fotos';?>" method="post">
                <input type="hidden" name="x1" value="" id="x1" />
                <input type="hidden" name="y1" value="" id="y1" />
                <input type="hidden" name="x2" value="" id="x2" />
                <input type="hidden" name="y2" value="" id="y2" />
                <input type="hidden" name="file_name" value="<?php echo $img['file_name'] ;?>" />
                <?php echo form_hidden('id', $id );?>
                <input type="submit" name="upload_thumbnail" value="Salvar Miniatura" id="save_thumb" />
	        </form>
		</div>

		<hr />
	<?php else: ?>

		<?php if(isset($id) && $id): ?>

			<br />
			<h2>Selecionar foto</h2>
			<form name="photo" enctype="multipart/form-data" action="<?php echo site_url().$controller.'/salvar_fotos';?>" method="post">
				Foto
				<input type="file" name="image" size="30" />
				<?php echo form_hidden('id', $id );?>
				<input type="submit" name="upload" value="Upload" />
			</form>

			<?php if($registros): ?>

				<br />
				<h2>Fotos Cadastradas</h2>
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<th class="marcado-th" width="294"><a href="#">Foto</a></th>
						<th class="actions">Ações</th>
					</tr>
					<?php foreach($registros as $row):?>
					<tr class="altrow">
						<td><img src="<?php echo base_url();?>assets/uploads/thumb_<?php echo $row->foto;?>" width="84" height="85" /></td>
						<td class="actions">
						    <?php echo anchor($controller.'/excluir_foto/'.$row->id.'-'.$id, 'Excluir', array("onclick"=>"return confima_exclusao('Foto')"));?>
						</td>
					</tr>
					<?php endforeach;?>
				</table>
			<?php else: ?>
				Nenhuma foto cadastrada.
			<?php endif; ?>

		<?php endif; ?>

	<?php endif ?>

</div>