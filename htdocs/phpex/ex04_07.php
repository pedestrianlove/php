<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
   
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>會員註冊表單</title>
</head>
<body>
<fieldset style="width:25%">
<legend><font color="blue" size=5>會員註冊表單</font></legend>
<form method="post" action="ex04_07.php">
   <p><table border=1>
   <tr><td>會員名稱<td> <input name="username" type="text" />
   <tr><td>電子郵件<td> <input name="email" type="text" />
   <tr><td>密　　碼<td> <input name="password1" type="password" />
   <tr><td>確認密碼<td> <input name="password2" type="password" />
   </table>
   <p><input type="submit" value="送出資料" name="send"/>
</form>
</fieldset>
<?php
   if(isset ($_POST['send'])){ 
      if($_POST["password1"]<>$_POST["password2"]){
         header('Refresh:3;url=form04t.html');
         exit("兩次密碼不一致，請重新填寫！");} ?>
      <p><B>目前註冊的會員資料如下：<B><p><table border=1>
      <tr><td>會員名稱<td> <?php echo $_POST["username"]; ?>
      <tr><td>電子郵件<td> <?php echo $_POST["email"]; ?>
      <tr><td>密　　碼<td> <?php echo $_POST["password1"]; ?>
      </table>
   <?php }; 
?>
</body>
</html>
