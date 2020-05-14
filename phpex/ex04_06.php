<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>表單實作範例3</title>
</HEAD>
<BODY>
<FORM action="ex04_06.php" method="POST">
<fieldset style="width:40%"><legend><font color="blue" size=5>表單實作範例 form03.html</font></legend>
	<p>名字：<INPUT name="myname" size=10 maxlength=20 value="大明星"></p>
	
	<p>密碼：<INPUT name="passwd" type=password size=10 maxlength=8></p>
	
	<p>性別：
	<INPUT name="sex" type=radio value="男">男
        <INPUT name="sex" type=radio value="女" checked>女</p>
   	
	<p>嗜好（可複選）：
        <INPUT name="f1" type=checkbox value="book">閱讀
        <INPUT name="f2" type=checkbox value="sport" checked>運動
        <INPUT name="f3" type=checkbox value="music" checked>音樂
        <INPUT name="f4" type=checkbox value="sleep">睡覺
        <INPUT name="f5" type=checkbox value="talk">聊天</p>
   
	<p><INPUT type="submit" value="送出表單" name="send">
	<INPUT type="reset" value="重新輸入"></p>
</fieldset>
</FORM>
<?php
   	if(isset ($_POST['send'])){ ?>
      		<hr><h3>     感謝您的填寫資料!!您所填寫的資料如下:</h3>
      		<table width=50% border=5>
         	<tr><td>姓名：<?php echo $_POST['myname']; ?></td>
         	<td>密碼：<?php echo $_POST['passwd']; ?></td>
         	</tr>
         	<tr><td>性別：<?php echo $_POST['sex']; ?></td>
         	<td>嗜好：<?php echo $_POST['f1']; ?> <?php echo $_POST['f2']; ?> <?php echo $_POST['f3']; ?> <?php echo $_POST['f4']; ?> <?php echo $_POST['f5']; ?></td>
         	</tr>
      	</table><br />
   <?php }; 
?>

</BODY>
</HTML>
