<html>
<body>
<form method="post" action="hw03_06.php">
	請輸入一個正整數：
	<input name="n" type = "text"> <br />
	<input type="submit" value="送出資料" name="send">
</form>
</fieldset>
</body>
</html>

<?php
	// variables
	if (isset ($_POST["send"]))
		$decimal = $_POST["n"];
	else
		throw new Exception ('CHECK YOUR INPUT'.PHP_EOL);

	// FLOW
	if ($decimal > 0)
		printf ("%s".PHP_EOL, decbin ($decimal));
	else
		printf ("Your number needs to be greater than 0.".PHP_EOL);
?>
