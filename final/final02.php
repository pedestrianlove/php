<html>
<body>
<form method="post" action="final02.php">
	請輸入課程帳號：<br />
	<input name="id" type = "text"> <br />
	<input type="submit" value="送出資料" name="send">
</form>
</fieldset>
</body>
</html>
<?php
	// header
	header("Content-Type:text/html;charset=utf8");

	// variables
	if (isset ($_POST["send"])) {
		$id = $_POST["id"];
	}
	else
		throw new Exception('CHECK YOUR INPUT'.PHP_EOL);

	// get the data
	$fp=fopen("../../data/math172u.txt","r") or die("檔案讀取失敗！");
	while($userinfo = fscanf($fp,"%s\t%s\t%s\n"))
        	 list ($num[],$name[],$email[]) = $userinfo;
   	fclose($fp);
   	
	// search for id
	for ($i = 0; $i < count ($num); $i++) {
		if (strcmp ($num[$i], $id) == 0) {
			printf ("%s %s %s",  $num[$i],$name[$i],$email[$i]);
			exit ();
			break;
		}
	}
	
	echo "USER NOT FOUND! <br />";
?>
