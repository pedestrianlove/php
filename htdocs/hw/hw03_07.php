<html>
<body>
<form method="post" action="hw03_07.php">
	請輸入本金：
	<input name="base" type = "text"> <br />
	請輸入年利：
	<input name="rate" type = "text"> <br />
	<input type="submit" value="送出資料" name="send">
</form>
</fieldset>
</body>
<?php
	// GET INPUT
	if (isset($_POST["send"])) {
		$base = $_POST["base"];
		$rate = (float)$_POST["rate"];
	}
	else
		throw new Exception ("CHECK YOUR INPUT".PHP_EOL);
	
	// OUTPUT		
	printf ("本金 %d 元，年利率 %d%%, 其輸出如下：".PHP_EOL, $base, $rate, '%');
	
	$rate = ($rate/100) + 1;
	$rate_bk = $rate;
	printf ("年份\t本利和".PHP_EOL);
	for ($i = 1;; $rate*=$rate_bk, $i++) {
		printf ("%d\t%f".PHP_EOL, $i, $base*$rate);
		if ($rate >= 2)
			break;
	}
?>
