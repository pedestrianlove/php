<?php
  function create_connection()
  {
    $link = mysqli_connect("learn.math.nthu.edu.tw", "dbuser", "try.123#T", "tryDB")
      or die("無法建立資料連接<br /><br />" . mysqli_error());
	  
    mysqli_query("SET NAMES 'utf8'");
    echo "Created database connection successifully.";
			   	
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
