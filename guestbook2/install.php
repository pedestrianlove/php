<?php
require_once "./admin/config.inc.php";
require_once "./lib/$DB_CLASS";
if (preg_match("/WIN/i",PHP_OS)) {
	$sep = "\\";
} else {
	$sep = "/";
}

if (!preg_match("/^5\./",PHP_VERSION)) {
    echo "<html><body><h2>This script requires PHP 5 or higher!</h2></body></html>";
    exit();
}

$install = new gbook_sql();
if (!isset($_POST['action'])) {
  $_POST['action'] ='';
}

$sqlquery[]= "CREATE TABLE $GB_TBL[auth] (
  `ID` smallint(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(60) NOT NULL DEFAULT '',
  `session` varchar(32) NOT NULL DEFAULT '',
  `last_visit` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sqlquery[]= "CREATE TABLE $GB_TBL[ban] (
  `ban_ip` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sqlquery[]= "CREATE TABLE $GB_TBL[com] (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `comments` text NOT NULL,
  `host` varchar(255) NOT NULL DEFAULT '',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`com_id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sqlquery[]= "CREATE TABLE $GB_TBL[cfg] (
  `config_id` smallint(4) NOT NULL AUTO_INCREMENT,
  `agcode` smallint(1) NOT NULL DEFAULT '0',
  `allow_html` smallint(1) NOT NULL DEFAULT '0',
  `offset` varchar(5) NOT NULL DEFAULT '0',
  `smilies` smallint(1) NOT NULL DEFAULT '1',
  `dformat` varchar(6) NOT NULL DEFAULT '',
  `tformat` varchar(4) NOT NULL DEFAULT '24hr',
  `admin_mail` varchar(50) NOT NULL DEFAULT '',
  `notify_private` smallint(1) NOT NULL DEFAULT '0',
  `notify_admin` smallint(1) NOT NULL DEFAULT '0',
  `notify_guest` smallint(1) NOT NULL DEFAULT '0',
  `notify_mes` varchar(150) NOT NULL DEFAULT '',
  `entries_per_page` int(6) NOT NULL DEFAULT '10',
  `show_ip` smallint(1) NOT NULL DEFAULT '0',
  `pbgcolor` varchar(7) NOT NULL DEFAULT '0',
  `text_color` varchar(7) NOT NULL DEFAULT '0',
  `link_color` varchar(7) NOT NULL DEFAULT '0',
  `width` varchar(4) NOT NULL DEFAULT '0',
  `tb_font_1` varchar(7) NOT NULL DEFAULT '',
  `tb_font_2` varchar(7) NOT NULL DEFAULT '',
  `font_face` varchar(60) NOT NULL DEFAULT '',
  `tb_hdr_color` varchar(7) NOT NULL DEFAULT '',
  `tb_bg_color` varchar(7) NOT NULL DEFAULT '',
  `tb_text` varchar(7) NOT NULL DEFAULT '',
  `tb_color_1` varchar(7) NOT NULL DEFAULT '',
  `tb_color_2` varchar(7) NOT NULL DEFAULT '',
  `lang` varchar(30) NOT NULL DEFAULT '',
  `min_text` smallint(4) NOT NULL DEFAULT '0',
  `max_text` int(6) NOT NULL DEFAULT '0',
  `max_word_len` smallint(4) NOT NULL DEFAULT '0',
  `comment_pass` varchar(50) NOT NULL DEFAULT '',
  `need_pass` smallint(1) NOT NULL DEFAULT '0',
  `censor` smallint(1) NOT NULL DEFAULT '0',
  `flood_check` smallint(1) NOT NULL DEFAULT '0',
  `banned_ip` smallint(1) NOT NULL DEFAULT '0',
  `flood_timeout` smallint(5) NOT NULL DEFAULT '0',
  `allow_icq` smallint(1) NOT NULL DEFAULT '0',
  `allow_aim` smallint(1) NOT NULL DEFAULT '0',
  `allow_gender` smallint(1) NOT NULL DEFAULT '0',
  `allow_img` smallint(1) NOT NULL DEFAULT '0',
  `max_img_size` int(10) NOT NULL DEFAULT '0',
  `img_width` smallint(5) NOT NULL DEFAULT '0',
  `img_height` smallint(5) NOT NULL DEFAULT '0',
  `thumbnail` smallint(1) NOT NULL DEFAULT '0',
  `thumb_min_fsize` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`config_id`)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sqlquery[]= "CREATE TABLE $GB_TBL[data] (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `gender` char(1) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `date` int(11) NOT NULL DEFAULT '0',
  `location` varchar(100) NOT NULL DEFAULT '',
  `host` varchar(255) NOT NULL DEFAULT '',
  `browser` tinytext,
  `comment` text NOT NULL,
  `icq` int(11) NOT NULL DEFAULT '0',
  `aim` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sqlquery[]= "CREATE TABLE $GB_TBL[ip] (
  `guest_ip` varchar(15) NOT NULL DEFAULT '',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  KEY `guest_ip` (`guest_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sqlquery[]= "CREATE TABLE $GB_TBL[pics] (
  `msg_id` int(11) NOT NULL DEFAULT '0',
  `book_id` int(11) NOT NULL DEFAULT '0',
  `p_filename` varchar(100) NOT NULL DEFAULT '',
  `p_size` int(11) unsigned NOT NULL DEFAULT '0',
  `width` int(11) unsigned NOT NULL DEFAULT '0',
  `height` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `msg_id` (`msg_id`),
  KEY `book_id` (`book_id`)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sqlquery[]= "CREATE TABLE $GB_TBL[priv] (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `gender` char(1) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `date` int(11) NOT NULL DEFAULT '0',
  `location` varchar(100) NOT NULL DEFAULT '',
  `host` varchar(255) NOT NULL DEFAULT '',
  `browser` tinytext,
  `comment` text NOT NULL,
  `icq` int(11) NOT NULL DEFAULT '0',
  `aim` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sqlquery[]= "CREATE TABLE $GB_TBL[smile] (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_code` varchar(20) NOT NULL DEFAULT '',
  `s_filename` varchar(60) NOT NULL DEFAULT '',
  `s_emotion` varchar(60) NOT NULL DEFAULT '',
  `width` smallint(6) unsigned NOT NULL DEFAULT '0',
  `height` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$sqlquery[]= "CREATE TABLE $GB_TBL[words] (
  `word` varchar(50) NOT NULL DEFAULT ''
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$tbl_data[]  = "INSERT INTO ".$GB_TBL['ban']." VALUES ('000.000.000.000')";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['cfg']." VALUES (1, 1, 0, '0', 1, 'Euro', '24hr', 'root@localhost', 0, 0, 0, 'Thank you for signing the guestbook!', 10, 1, '#FFFFFF', '#000000', '#006699', '95%', '11px', '10px', 'Verdana, Arial, Helvetica, sans-serif', '#7878BE', '#000000', '#FFFFFF', '#E8E8E8', '#F7F7F7', 'english', 6, 2500, 300, 'comment', 0, 1, 0, 1, 80, 1, 1, 1, 1, 512, 320, 90, 1, 20)";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['words']." VALUES ('fuck')";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['smile']." (id, s_code, s_filename, s_emotion, width, height) VALUES (1, ':-)', 'a1.gif', 'smile', 15, 15)";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['smile']." (id, s_code, s_filename, s_emotion, width, height) VALUES (2, ':-(', 'a2.gif', 'frown', 15, 15)";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['smile']." (id, s_code, s_filename, s_emotion, width, height) VALUES (3, ';-)', 'a3.gif', 'wink', 15, 15)";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['smile']." (id, s_code, s_filename, s_emotion, width, height) VALUES (4, ':o', 'a4.gif', 'embarrassment', 15, 15)";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['smile']." (id, s_code, s_filename, s_emotion, width, height) VALUES (5, ':D', 'a5.gif', 'big grin', 15, 15)";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['smile']." (id, s_code, s_filename, s_emotion, width, height) VALUES (6, ':p', 'a6.gif', 'razz (stick out tongue)', 15, 15)";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['smile']." (id, s_code, s_filename, s_emotion, width, height) VALUES (7, ':cool:', 'a7.gif', 'cool', 21, 15)";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['smile']." (id, s_code, s_filename, s_emotion, width, height) VALUES (8, ':rolleyes:', 'a8.gif', 'roll eyes (sarcastic)', 15, 15)";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['smile']." (id, s_code, s_filename, s_emotion, width, height) VALUES (9, ':mad:', 'a9.gif', '#@*%!', 15, 15)";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['smile']." (id, s_code, s_filename, s_emotion, width, height) VALUES (10, ':eek:', 'a10.gif', 'eek!', 15, 15)";
$tbl_data[]  = "INSERT INTO ".$GB_TBL['smile']." (id, s_code, s_filename, s_emotion, width, height) VALUES (11, ':confused:', 'a11.gif', 'confused', 15, 22)";

?>
<html>
<head>
<title>Advanced Guestbook</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.table {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; color: #000000}
body {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; color: #000000}
-->
</style>
</head>
<body bgcolor="#FFFFFF">

<?php

if ($_POST['action'] == "") {
$SELF = basename($_SERVER['PHP_SELF']);
?>
<br>
<form method="post" action="<?php echo $SELF; ?>">
  <table width="95%" border="0" cellspacing="1" cellpadding="4" align="center">
    <tr bgcolor="#9999CC">
      <td colspan="2" class="table" height="35"><b>Advanced Guestbook Setup</b></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td width="33%" class="table">Your database:</td>
      <td width="67%"><input type="text" name="db"></td>
    </tr>
    <tr bgcolor="#DDDDDD">
      <td width="33%" class="table">Your MySQL host:</td>
      <td width="67%"><input type="text" name="host" value="<?php echo $GB_DB["host"]; ?>"></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td width="33%" class="table">Your MySQL username:</td>
      <td width="67%"><input type="text" name="name"></td>
    </tr>
    <tr bgcolor="#DDDDDD">
      <td width="33%" class="table">Your MySQL password:</td>
      <td width="67%"><input type="password" name="pass"></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td width="33%" class="table">Your Guestbook username:</td>
      <td width="67%"><input type="text" name="gb_name" value="admin"></td>
    </tr>
    <tr bgcolor="#DDDDDD">
      <td width="33%" class="table">Your Guestbook password:</td>
      <td width="67%"><input type="text" name="gb_pass" value="pass"></td>
    </tr>
    <tr>
      <td width="33%">&nbsp;</td>
      <td width="67%">
        <input type="submit" name="action" value="Create table">
        <input type="submit" name="action" value="Create new DB and table">
        <input type="reset" value="Reset">
      </td>
    </tr>
  </table>
<?php
$baseDir = dirname(__FILE__);
$uploadDir = $baseDir.$sep.$GB_UPLOAD;
if (!is_writable($uploadDir)) {
	echo "Warning: $uploadDir is not writeable<br>\n";
}
$uploadTmp = $baseDir.$sep.$GB_TMP;
if (!is_writable($uploadTmp)) {
	echo "Warning: $uploadTmp is not writeable<br>\n";
}
if (extension_loaded("gd") == false) {
	echo "Warning: gd is not installed. Captcha will not work.<br>\n";
}
if (!function_exists("imagettftext")) {
	echo "Warning: FreeType Support is missing. Captcha will not work.<br>\n";
}

?>
</form>

<?php }

elseif ($_POST['action'] == "Create table") {
  if (get_magic_quotes_gpc()) {
  	$_POST['gb_name'] = stripslashes($_POST['gb_name']);
  	$_POST['gb_pass'] = stripslashes($_POST['gb_pass']);
  }
  $tbl_data[]  = "INSERT INTO ".$GB_TBL['auth']." VALUES (1,'".addslashes($_POST['gb_name'])."',PASSWORD('".addslashes($_POST['gb_pass'])."'), '".md5(microtime())."', '".time()."')";
  $serverid  = mysql_connect($_POST['host'], $_POST['name'], $_POST['pass']) or $install->sql_error("Cannot connect to database");
  @mysql_select_db($_POST['db'],$serverid) or $install->sql_error("Unable to select database: <b>{$_POST['db']}</b>");
  for ($i=0;$i<sizeof($sqlquery);$i++) {
    mysql_query($sqlquery[$i],$serverid) or $install->sql_error("Database Error");
  }
  for ($i=0;$i<sizeof($tbl_data);$i++) {
    mysql_query($tbl_data[$i],$serverid) or $install->sql_error("Database Error");
  }
?>
<font face="Verdana, Arial" size="3" color="#000099"><b>Advanced Guestbook</b></font>
<hr size="1" width="400" align="left">
<font face="Verdana, Arial" size="2">Tables were created successfully!</font>
<br><br><ul><font face="Verdana,Arial" size="2">
Your selected database: <b><?php echo "$_POST[db]"; ?></b><br>
Your MySQL host: <b><?php echo "$_POST[db]"; ?></b><br>
Your MySQL username: <b><?php echo "$_POST[name]"; ?></b><br><br>
</ul>
<a href="admin.php">Click now here to setup the guestbook admin...</a>
</font>

<?php }

elseif ($_POST['action'] == "Create new DB and table") {
  if (get_magic_quotes_gpc()) {
  	$_POST['gb_name'] = stripslashes($_POST['gb_name']);
  	$_POST['gb_pass'] = stripslashes($_POST['gb_pass']);
  }
  $tbl_data[]  = "INSERT INTO ".$GB_TBL['auth']." VALUES (1,'".addslashes($_POST['gb_name'])."',PASSWORD('".addslashes($_POST['gb_pass'])."'), '".md5(microtime())."', '".time()."')";  
  $serverid  = mysql_connect($_POST['host'], $_POST['name'], $_POST['pass']) or $install->sql_error("Cannot connect to database");
  $retval = mysql_query("CREATE DATABASE {$_POST['db']}") or $install->sql_error("Cannot create new database: <b>$db</b>");
  if ($retval) {
    mysql_select_db($_POST['db'],$serverid) or $install->sql_error("Unable to select database: <b>$db</b>");
    for ($i=0;$i<sizeof($sqlquery);$i++) {
        mysql_query($sqlquery[$i],$serverid) or $install->sql_error("Database Error");
    }
    for ($i=0;$i<sizeof($tbl_data);$i++) {
        mysql_query($tbl_data[$i],$serverid) or $install->sql_error("Database Error");
    }
  } else {
    echo mysql_error();
    exit();
  }
?>
<font face="Verdana, Arial" size="3" color="#000099"><b>Advanced Guestbook</b></font>
<hr size="1" width="400" align="left">
<font face="Verdana, Arial" size="2">Database and Tables were created successfully!</font>
<br><br><ul><font face="Verdana,Arial" size="2">
Your new database: <b><?php echo "$_POST[db]"; ?></b><br>
Your MySQL host: <b><?php echo "$_POST[host]"; ?></b><br>
Your MySQL username: <b><?php echo "$_POST[name]"; ?></b><br><br>
</ul>
<a href="admin.php">Click now here to setup the guestbook admin...</a>
</font>
<?php } ?>
</body>
</html>
