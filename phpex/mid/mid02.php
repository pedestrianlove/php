<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      	<title>mid02 - Decimal to Binary</title>
</head>
<body>
      	<h1><center>Decimal ---> Binary</center><h1>
      	<form action="mid02.php" method="post">
	請輸入十進位的數字：	
		<input type=text name=decimal value=0><br />
		<input type="submit" value="送出資料" name=send>
		<input type="reset" value="重新填寫">
	</form>
</body>
</html>
<?php
	$decimal = $_POST["decimal"];
	printf ("<pre>");
	printf ("Decimal = %d ---> Binary = %s", $decimal, decbin ($decimal));
	printf ("</pre>");
?>
