<?php
  function create_connection()
  {
    $link = mysqli_connect("sql205.byethost.com", "b13_25362198", "joyce0920", "b13_25362198_guestbook")
      or die("無法建立資料連接<br /><br />" . mysqli_error());
	  
    mysqli_query($link, "SET NAMES 'utf8'");
			   	
    return $link;
  }
	
  function execute_sql($db_name, $sql_command, $sql_link)
  {
    $db_selected = mysqli_select_db($sql_link, $db_name)
      or die("開啟資料庫失敗<br /><br />" . mysqli_error($sql_link));
						 
    $result = mysqli_query($sql_link, $sql_command);
		
    return $result;
  }
?>
