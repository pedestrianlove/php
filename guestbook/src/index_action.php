<?php
      require_once("dbtools.inc.php");
			
      //指定每頁顯示幾筆記錄
      $records_per_page = 5;

      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;

      //建立資料連接
      $link = create_connection();
			
      //執行 SQL 命令
      $sql_command = "SELECT * FROM message ORDER BY date DESC";	
      $result = execute_sql("b13_25362198_guestbook", $sql_command, $sql_link);

      //取得記錄數
      $total_records = mysqli_num_rows($result);

      //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);

      //計算本頁第一筆記錄的序號
      $started_record = $records_per_page * ($page - 1);

      //將記錄指標移至本頁第一筆記錄的序號
      mysqli_data_seek($result, $started_record);

      //使用 $bg 陣列來儲存表格背景色彩
      $bg[0] = "#D9D9FF";
      $bg[1] = "#FFCAEE";
      $bg[2] = "#FFFFCC";
      $bg[3] = "#B9EEB9";
      $bg[4] = "#B9E9FF";

      echo "<table width='800' align='center' cellspacing='3'>";

      //顯示記錄
      $j = 1;
      while ($row = mysqli_fetch_assoc($result) and $j <= $records_per_page)
      {
        echo "<tr bgcolor='" . $bg[$j - 1] . "'>";
        echo "<td width='120' align='center'>
              <img src='../img/" . mt_rand(0, 9) . ".gif'></td>";
        echo "<td>作者：" . $row["author"] . "<br>";
        echo "主題：" . $row["subject"] . "<br>";
        echo "時間：" . $row["date"] . "<hr>";
        echo $row["content"] . "</td></tr>";
        $j++;
      }
      echo "</table>" ;

      //產生導覽列
      echo "<p align='center'>";

      if ($page > 1)
        echo "<a href='index.php?page=". ($page - 1) . "'>上一頁</a> ";

      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='index.php?page=$i'>$i</a> ";
      }

      if ($page < $total_pages)
        echo "<a href='index.php?page=". ($page + 1) . "'>下一頁</a> ";
      echo "</p>";

      //釋放記憶體空間
      mysqli_free_result($result);
      mysqli_close($link);
    ?>

