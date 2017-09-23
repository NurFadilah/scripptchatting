<!DOCTYPE html>
<html>
<head>
	<title>caesar</title>
</head>
<body>
	<form method="post" action="<?php echo base_url() ?>index.php/Home/library">
		<table>
		<tr>
			<td>Masukan Key</td>
			<td>:</td>
			<td><input type="text" name="key" value="Bandung"> </td>
		</tr>
		<tr>
			<td>Masukan Pesan</td>
			<td>:</td>
			<td><textarea name="pesan">Indonesia Juara</textarea></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" value="masukan"></td>
		</tr>
		</table>		
	</form>
</body>
</html>