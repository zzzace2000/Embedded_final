<html>
<head>
<title>Download Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('welcome/do_download');?>

<input type="text" id="userfile" name="userfile" />

<br /><br />

<input type="submit" value="download" />

</form>

</body>
</html>
