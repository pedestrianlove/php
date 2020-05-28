<?php
$include_path = dirname(__FILE__);
require_once $include_path."/admin/config.inc.php";
require_once $include_path."/lib/$DB_CLASS";
require_once $include_path."/lib/image.class.php";
require_once $include_path."/lib/template.class.php";
require_once $include_path."/lib/vars.class.php";
require_once $include_path."/lib/gb.class.php";

$gb = new guestbook($include_path);
$entry = (isset($_GET["entry"])) ? $_GET["entry"] : 0;
$entry = (isset($_POST["entry"])) ? $_POST["entry"] : $entry;
echo $gb->show_entries(intval($entry));


