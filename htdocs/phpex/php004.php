<?php
   header("Content-Type:text/html;charset=utf-8");

// 預設常數
   print  "php 程式的目錄 : ".__DIR__ . "<br />";   // 顯示預定變數__DIR__
   print  "php 程式的檔名 : ". __FILE__ . "<br />";  // 顯示預定變數__FILE__
// 常數宣告
   define("PI", 3.1415926);  // 定義數值常數PI
   define("AREA", "面積");   // 定義字串常數AREA
// 使用常數計算圓面積
   print "圓半徑12的" . AREA . ": " . PI*12*12 . "<br />";
   print "圓半徑30的" . AREA . ": " . PI*30*30 . "<br />";

?>