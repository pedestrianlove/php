<html>
<body>
<form method="post" action="hw03_02.php">
	選擇形狀：
	<input name = "TYPE" type = "radio" VALUE = "a">Z
	<input name = "TYPE" type = "radio" VALUE = "b">A
	<input name = "TYPE" type = "radio" VALUE = "c">X
	<input name = "TYPE" type = "radio" VALUE = "d">V
	<input name = "TYPE" type = "radio" VALUE = "e">N <br />
	輸入大小(5<=N<100)：
	<input name="SIZE" type = "text"> <br />
	<input type="submit" value="送出資料" name="send">
</form>
</fieldset>
</body>
</html>

<?php
	// INPUT
	if (isset ($_POST["send"])) {
		$TYPE = $_POST["TYPE"];
		$SIZE = $_POST["SIZE"];
	}
	else
		throw new Exception ("CHECK YOUR INPUT".PHP_EOL);
	
	switch ($TYPE) {
		case 'a':
			for ($i = 0; $i < $SIZE; $i ++) {
				for ($j = 0; $j < $SIZE; $j ++) {
					if ($i == 0 ||$i == $SIZE || $i+$j==$SIZE)
						printf ("*");
					else
						printf (" ");
				}
				printf ("<br />".PHP_EOL);
			}
			break;
		case 'b':
			$mid = floor ($SIZE/2);
			for ($i = 0; $i < $SIZE; $i ++) {
				for ($j = 0; $j < $SIZE; $j ++) {
					if (2*$j+$i==$SIZE || $SIZE+$i == 2*$j || ($i==$mid&& 2*$j > $SIZE-$i && 2*$j < $i-$SIZE))
						printf ("*");
					else
						printf (" ");
					
				}
				printf ("<br />".PHP_EOL);
			}

			break;
		case 'c':
			for ($i = 0; $i < $SIZE; $i ++) {
				for ($j = 0; $j < $SIZE; $j ++) {
					if ($i==$j || $i+$j == $SIZE)
						printf ("*");
					else
						printf (" ");
				}
				printf ("<br />".PHP_EOL);
			}

			break;
		case 'd':
			for ($i = 0; $i < $SIZE; $i ++) {
				for ($j = 0; $j < $SIZE; $j ++) {
					if ($j==2*$i || 2*$j+$i==2*$SIZE)
						printf ("*");
					else
						printf (" ");
				}
				printf ("<br />".PHP_EOL);
			}
			break;
		case 'e':
			for ($i = 0; $i < $SIZE; $i ++) {
				for ($j = 0; $j < $SIZE; $j ++) {
					if ($j == 0 || $j == $SIZE || $i == $j)
						printf ("*");
					else
						printf (" ");
				}
				printf ("<br />".PHP_EOL);
			}
			break;
		default:
			printf ("UNIDENTIFIED TYPE".PHP_EOL);

	}
	printf (PHP_EOL);

?>
