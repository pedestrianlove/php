<?php
  require_once("dbtools.inc.php");
	
  $author = $_POST["author"];
  $subject = $_POST["subject"];
  $content = $_POST["content"];
  $current_time = date("Y-m-d H:i:s");
  
  // CAPTCHA
  Session_start();
  if( $_SESSION["Checknum"] == $_POST['checknum'] )
  {
  	$msg = "您所輸入的驗證碼正確！";
  }
  else
  {
 	echo $msg = "您所輸入的驗證碼錯誤！請回上一頁重新輸入。 ";
  	header("location:../index.php");
	exit ();
	
  }
  
  
  //建立資料連接
  $link = create_connection();

  //執行 SQL 命令
  $sql = "INSERT INTO message(author, subject, content, date)
          VALUES('$author', '$subject', '$content', '$current_time')";
  $result = execute_sql("b13_25362198_guestbook", $sql, $link);

  //關閉資料連接
  mysqli_close($link);

  //將網頁重新導向到 index.php
  header("location:../index.php");
  exit();
?>
