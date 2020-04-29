<html>
<body>
<form method="post" action="hw03_09.php">
	請輸入密碼：
	<input name="string" type = "text"> <br />
	<input type="submit" value="送出資料" name="send">
</form>
</fieldset>
</body>

<?php
	function decrypt ($char)
	{
		$alphabet = range('A', 'Z');
		$index = array_search ($char, $alphabet);
		$index = ($index+7)%26;
		
		return $alphabet[$index];
	}

	// INPUT
	if (isset ($_POST["send"]))
		$original_string = $_POST["string"];
	else
		throw new Exception ("CHECK YOUR INPUT".PHP_EOL);

	// PROCESS && OUTPUT
	$string_array = explode (" ", $original_string);
	foreach ($string_array as $string_element) {

		$char_array = str_split ($string_element);
		
		foreach ($char_array as $char) {
			printf ("%s", decrypt ($char));
		}
		printf (" ");
	}
	printf (PHP_EOL);
?>
