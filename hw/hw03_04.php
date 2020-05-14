<html>
<body>
<form method="post" action="hw03_04.php">
	選擇運算：
	<input name = "TYPE" type = "radio" VALUE = "a">a
	<input name = "TYPE" type = "radio" VALUE = "b">b
	<input name = "TYPE" type = "radio" VALUE = "c">c <br />
	選擇大小：
	<input name = "SIZE" type = "text"> <br />
	<input type="submit" value="送出資料" name="send">
</form>
</fieldset>
</body>
</html>
<?php
	// function area
	function type_a ()
	{
		$sum = 0;
		for ($i = 1; $i <= 31; $i+=2)
			$sum += $i;
		printf ("%d".PHP_EOL, $sum);
	}
	function type_b ($size)
	{
		$base = 0.06;
		$sum = $base*((1-pow($base, $size))/(1-$base));
		printf ("%f".PHP_EOL, $sum);
	}
	function type_c ($size)
	{
		$sum = 1;
		for ($i = 2; $i <= $size; $i++) {
			$sum *= (($i-1)/$i);
		}
		printf ("%f".PHP_EOL, $sum);
	}

	// input variable
	if (isset($_POST["send"]))
		$type = $_POST["type"];
	else
		throw new Exception ("Check your input".PHP_EOL);

	// FLOW
	switch ($type) {
		case 'a':
			type_a ();
			break;
		case 'b':
			if (isset ($_POST["SIZE"])) 	$size = $_POST["SIZE"];
			else				throw new Exception ("Check your input".PHP_EOL)
			type_b ($size);
			break;
		case 'c':
			if (isset ($_POST["SIZE"])) 	$size = $_POST["SIZE"];
			else				throw new Exception ("Check your input".PHP_EOL)
			type_c ($size);
			break;
		default:
			printf ("CHECK YOUR TYPES".PHP_EOL);
	}
?>
