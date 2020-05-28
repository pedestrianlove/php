<?php
   header('Content-Type:text/html;charset=utf-8');
   if($_POST['send']) 
      if($_POST["password1"]<>$_POST["password2"]){
         header('Refresh:3;url=ex08_04.html');
         exit("兩次密碼不一致，請重新填寫！");
      } 
?>
      <p><B>目前註冊的會員資料如下：<B><p><table border=1>
      <tr><td>課程帳號<td> <?php echo $_POST["cn"]; ?>
      <tr><td>密　　碼<td> <?php echo $_POST["password1"]; ?>
      <tr><td>會員名稱<td> <?php echo $_POST["username"]; ?>
      <tr><td>電子郵件<td> <?php echo $_POST["email"]; ?>      
      </table>
   
<?php
	// init link
    	$sql_link = mysqli_connect("localhost", "root", "math.315", "tryDB")
		or die("無法建立資料連接<br /><br />" . mysqli_error());
	mysqli_query ($sql_link, "SET NAMES 'utf8'");

   
   
   	$course_name = $_POST["cn"];
   	$password = $_POST["password1"];
   	$username = $_POST["username"]; 
   	$email = $_POST["email"];

  	// insert data
	$sql_command = "INSERT INTO member (course_name, username, password, email)
		VALUES ('$course_name', '$username', '$password', '$email')";
	$result = mysqli_query ($sql_link, $sql_command);

	mysqli_close ($sql_link);
?>
