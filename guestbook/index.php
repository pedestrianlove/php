<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>訪客留言表</title>
    <script type="text/javascript">
      function check_data()
      {
        if (document.myForm.author.value.length == 0)
          alert("作者欄位不可以空白哦！");
        else if (document.myForm.subject.value.length == 0)
          alert("主題欄位不可以空白哦！");
        else if (document.myForm.content.value.length == 0)
          alert("內容欄位不可以空白哦！");
        else
          myForm.submit();
      }
    </script>
  </head>
  <body>
    <p align="center"><img src="fig.jpg"></p>
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
      $sql = "SELECT * FROM message ORDER BY date DESC";	
      $result = execute_sql("guestbook", $sql, $link);

      //取得記錄數
      $total_records = mysql_num_rows($result);

      //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);

      //計算本頁第一筆記錄的序號
      $started_record = $records_per_page * ($page - 1);

      //將記錄指標移至本頁第一筆記錄的序號
      mysql_data_seek($result, $started_record);

      //使用 $bg 陣列來儲存表格背景色彩
      $bg[0] = "#D9D9FF";
      $bg[1] = "#FFCAEE";
      $bg[2] = "#FFFFCC";
      $bg[3] = "#B9EEB9";
      $bg[4] = "#B9E9FF";

      echo "<table width='800' align='center' cellspacing='3'>";

      //顯示記錄
      $j = 1;
      while ($row = mysql_fetch_assoc($result) and $j <= $records_per_page)
      {
        echo "<tr bgcolor='" . $bg[$j - 1] . "'>";
        echo "<td width='120' align='center'>
              <img src='" . mt_rand(0, 9) . ".gif'></td>";
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
      mysql_free_result($result);
      mysql_close($link);
    ?>
    <form name="myForm" method="post" action="post.php">
      <table border="0" width="800" align="center" cellspacing="0">
        <tr bgcolor="#0084CA" align="center">
          <td colspan="2">
            <font color="#FFFFFF">請在此輸入新的留言</font></td>
        </tr>
        <tr bgcolor="#D9F2FF">
          <td width="15%">作者</td>
          <td width="85%"><input name="author" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#84D7FF">
          <td width="15%">主題</td>
          <td width="85%"><input name="subject" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#D9F2FF">
          <td width="15%">內容</td>
          <td width="85%"><textarea name="content" cols="50" rows="5"></textarea></td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="button" value="張貼留言" onClick="check_data()">　
            <input type="reset" value="重新輸入">
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>