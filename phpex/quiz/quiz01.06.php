<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
	function grading ($grade) {
		switch (floor ($grade/10)) {
			case 10: 
				return "A";
				break;
			case 9: 
				return "A";
				break;
			case 8:
				return "A";
				break;
			case 7:
				return "B";
				break;
			case 6:
				return "C";
				break;
			case 5:
				return "D";
				break;
			case 4:
				return "E";
				break;
			default:
				return "F";
				break;
		}
	}
	?>
<html>
<body>
<form method="post" action="quiz01.06.php">
   請輸入成績: <input name="grade" type="text" />
   <p><input type="submit" value="送出資料" name="send"/>
</form>
</fieldset>
<?php
   	if(isset ($_POST['send'])){ 
      		if($_POST["grade"]>100 || $_POST["grade"] < 0){
         		header('Refresh:3;url=quiz01.06.php');
         		exit("請輸入0-100的數字");
         	}
         	$gpa = grading ($_POST["grade"]);
         	printf ("等第%s <br />", $gpa);
	}
	
?>
</body>
</html>
