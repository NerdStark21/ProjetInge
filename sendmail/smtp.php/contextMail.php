<html>
<head>
	<title>Simple Send Mail </title>
</head>
<body>
	<h1>Mail Form</h1>
	<form name="form1" method="post" action="mail.php">
	<table>
		<tr><td><b>To</b></td><td>
			<input type="text" name="mailto" size="35">
		</td></tr>
		<tr><td><b>Subject</b></td>
			<td><input type="text" name="mailsubject" size="35"></td>
		</tr>
		<tr><td><b>Message</b></td>
		<td>
			<textarea name="mailbody" cols="50" rows="7"></textarea>
		</td>
	</tr>
<tr><td colspan="2">
<input type="submit" name="Submit" value="Send">
</td>
</tr>
</table>
</form>
</body>
</html>