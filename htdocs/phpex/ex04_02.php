<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<form action="ex04_02.php" method="POST">
  		 請輸入你的成績：
		 <input type=text name=GRADE><br>
		 <input type="submit" value="計算" name="send">
	</form>
	<?php
		if(isset($_POST[send])) {
			// GET GRADE
			$GRADE = $_POST[GRADE];

			// CLASSIFY
			printf ("等第為");
			if ($GRADE >= 80  &&  $GRADE <= 100)
				printf ("A");
			elseif ($GRADE >= 70)
				printf ("B");
			elseif ($GRADE >= 60)
				printf ("C");
			elseif ($GRADE >= 50)
				printf ("D");
			elseif ($GRADE >= 40)
				printf ("E");
			elseif ($GRADE >= 0)
				printf ("F");
			else
				printf ("輸入錯誤!");
			printf ("<br />");
		}
	
	?>
	
</body>
</html>
