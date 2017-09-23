<!DOCTYPE html>
<html>
<head>
	<title>caesar</title>
</head>
<body>
<h1>Baca pesan</h1>
	<form method="post" action="<?php echo base_url() ?>index.php/Home/libraryRead">
		<table>
		<tr>
			<td>Masukan Key</td>
			<td>:</td>
			<td><input type="text" name="key" value="Bandung"> </td>
		</tr>
		<tr>
			<td>Masukan Pesan</td>
			<td>:</td>
			<td><textarea name="pesan">äÃ‡Ø¼Ä€ˮ!ˆ®ÎÔ³ZÚ¶</textarea></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" value="baca pesan"></td>
		</tr>
		</table>		
	</form>
</body>
</html>