<?php
/*
   程式檔名：member.php
   程式功能：利用php來處理表單(會員註冊)
   改版原因：將表單資料儲存至檔案(member.txt)
   程式設計：H.T. Wang
   設計日期：2014-09-24
   程式版本：1.1
*/
   header('Content-Type:text/html;charset=utf-8');
   if($_POST['send']){ 
      if($_POST["password1"]<>$_POST["password2"]){
         header('Refresh:3;url=member.html');
         exit("兩次密碼不一致，請重新填寫！");} ?>
      <p><B>目前註冊的會員資料如下：<B><p><table border=1>
      <tr><td>課程帳號<td> <?php echo $_POST["cn"]; ?>
      <tr><td>密　　碼<td> <?php echo $_POST["password1"]; ?>
      <tr><td>會員名稱<td> <?php echo $_POST["username"]; ?>
      <tr><td>電子郵件<td> <?php echo $_POST["email"]; ?>      
      </table>
   <?php
   //指定寫入檔案的名稱，確記存放位置不要在「網站根目錄內」
   $filename = "../../data/member.txt";
   $handle = fopen($filename, "a") or die("$filename 開啟檔案失敗！");
   //指定寫入檔案的內容，包括換行符號
   $contents .= $_POST["cn"]." ";
   $contents .= $_POST["password1"]." ";
   $contents .= $_POST["username"]." "; 
   $contents .= $_POST["email"]." \r\n";
   $num = fwrite($handle, $contents);  //寫入檔案
   fclose($handle);                              //關閉檔案
   echo "成功寫入".$num."個位元組";   //寫入完畢顯示成功訊息
}; 
?>