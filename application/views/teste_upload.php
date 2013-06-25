<html>
<head>
<title>Upload Form</title>
</head>
<body>

    <form method="post" action="<?php echo site_url('downloads/upload_c');?>" enctype="multipart/form-data" />

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>