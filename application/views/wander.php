<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo form_open('wander/salvar',array('name'=>'atividade','enctype'=>'multipart/form-data'));?>
<div class="line-box activity-grid">
			<div class="small-box">
				<span>Objetivos, temário, programação</span><br>
				<input type="file" class="small-custom-file-jquery-ui" name="ArquivoObjetivos" id="">
			</div>
			<div class="small-box">
				<span>Bibliografia</span><br>
				<input style="margin-left: -11px;" type="file" class="small-custom-file-jquery-ui" name="ArquivoBibliografia" id="">
			</div>
			<div class="small-box">
				<span>Outras informações</span><br>
				<input style="margin-left: -11px;" type="file" class="small-custom-file-jquery-ui" name="OutrasInformacoes" id="">
			</div>
			<div class="small-box">
				<span>Folha de rosto/modelo do trabalho escrito:</span><br>
				<input style="margin-left: -11px;" type="file" class="small-custom-file-jquery-ui" name="ArquivoFolhaRosto" id="">
			</div>
    <input type="text" name="teste">
    <input type="submit"  name="enviar" id="" value="Enviar">
			<hr class="hr_sep big">
</div>
</form>

</body>
</html>