<html>
<body>
<form method="post" action="final01.php">
	分別輸入兩正整數：<br />
	<input name="m" type = "text"> <br />
	<input name="n" type = "text"> <br />
	<input type="submit" value="送出資料" name="send">
</form>
</fieldset>
</body>
</html>
<?php
	// function area
	function gcd($m, $n)
	{
		if ($m*$n == 0)
			if ($m == 0)
				return $n;
			else
				return $m;
		if ($m < $n)
			return gcd ($n, $m);
		else
			return gcd ($n, $m%$n);
	}

	// variables
	if (isset ($_POST["send"])) {
		$m = $_POST["m"];
		$n = $_POST["n"];
	}
	else
		throw new Exception('CHECK YOUR INPUT'.PHP_EOL);

	// FLOW
	$gcd = gcd ($m, $n);
	$lcm = $gcd*($m/$gcd)*($n/$gcd);
	printf ("您分別輸入了%d和%d <br />".PHP_EOL, $m, $n);
	printf ("(GCD, LCM) = (%4d, %4d)".PHP_EOL, $gcd, $lcm);
?>
