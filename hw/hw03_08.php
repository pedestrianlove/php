<html>
<body>
<form method="post" action="hw03_08.php">
	請輸入字串：
	<input name="string" type = "text"> <br />
	<input type="submit" value="送出資料" name="send">
</form>
</fieldset>
</body>
<?php
	// input
	if (isset($_POST["send"]))
		$string_input = $_POST["string"];
	else
		throw new Exception ("WATCH YOUR INPUT".PHP_EOL);

	// process
	$string_array = explode (",", $string_input);

	// output
	foreach ($string_array as $substring)
		printf ("%s <br />".PHP_EOL, $substring);
?>
