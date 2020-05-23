<?php
  function create_connection()
  {
    $link = mysqli_connect("sql205.byethost13.com", "b13_25362198", "joyce0920", "b13_25362198_guestbook")
      or die("無法建立資料連接<br /><br />" . mysqli_error());
	  
    mysql_query("SET NAMES 'utf8'");
			   	
    return $link;
  }
	
  function execute_sql($db_name, $sql_command, $sql_link)
  {
    $db_selected = mysqli_select_db($db_name, $sql_link)
      or die("開啟資料庫失敗<br /><br />" . mysqli_error($sql_link));
						 
    $result = mysqli_query($sql_command, $sql_link);
		
    return $result;
  }
?>
