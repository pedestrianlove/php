<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
   
<html>
<head>
   	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   	<title>表單實作範例1--手機使用調查</title>
</head>

<body>
<fieldset style="width:40%">
<legend><font color="blue" size=5>手機使用調查</font></legend>
<FORM method="post" action="ex04_05.php">
   	<P>姓&nbsp;&nbsp;名：<INPUT TYPE="TEXT" NAME="UserName" SIZE="40"></P>
   	
	<P>E-Mail：<INPUT TYPE="TEXT" NAME="UserMail" SIZE="40" VALUE="username@mailserver"></P>
   	
	<P>年&nbsp;&nbsp;齡：
   	<INPUT TYPE="RADIO" NAME="UserAge" VALUE="Age1">未滿20歲
   	<INPUT TYPE="RADIO" NAME="UserAge" VALUE="Age2" CHECKED>20~29
   	<INPUT TYPE="RADIO" NAME="UserAge" VALUE="Age3">30~39
  	<INPUT TYPE="RADIO" NAME="UserAge" VALUE="Age4">40~49
   	<INPUT TYPE="RADIO" NAME="UserAge" VALUE="Age5">50歲以上</P>
   	
	<P>您曾經使用過哪些廠牌的手機？
   	<INPUT TYPE="CHECKBOX" NAME="UserPhone[]" VALUE="IPhone" CHECKED>IPhone
   	<INPUT TYPE="CHECKBOX" NAME="UserPhone[]" VALUE="宏達電">宏達電
   	<INPUT TYPE="CHECKBOX" NAME="UserPhone[]" VALUE="易利信">易利信
   	
	<P>您使用手機時最常碰到哪些問題？</P>
   	<TEXTAREA NAME="UserTrouble" COLS="45" ROWS="4">線路太忙</TEXTAREA></P>
   	<INPUT TYPE="SUBMIT" VALUE="提交" NAME="send">
   	<INPUT TYPE="RESET" VALUE="重新輸入">
</FORM>
</fieldset>

	<?php
   		header('Content-Type:text/html;charset=utf-8');
   		if(isset ($_POST['send'])){
			echo "<br />";
      			echo "<hr><h3>感謝您的填寫資料!!您所填寫的資料如下:</h3>";
      			echo "<ol>";
      			echo "<li>姓&nbsp;&nbsp;名："; echo $_POST['UserName']; echo "</li>";
      			echo "<li>E-Mail:"; echo $_POST['UserMail']; echo"</li>";
      			echo "<li>年&nbsp;&nbsp;齡："; echo $_POST['UserAge']; echo "</li>";
      			echo "<li>您曾經使用過哪些廠牌的手機？"; echo join(' ',$_POST['UserPhone']); echo "</li>";
      			echo "<li>您使用手機時最常碰到哪些問題？";
			echo '<br />'.nl2br($_POST['UserTrouble']); echo "</li>";
		}
	?>
</body>
</html>
