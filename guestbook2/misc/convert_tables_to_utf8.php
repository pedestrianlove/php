<?php
// Convert all guestbook tables to UTF-8

$include_path = dirname(dirname(__FILE__));
require_once $include_path."/admin/config.inc.php";

$DB_HOST = $GB_DB['host'];
$DB_USER = $GB_DB['user'];
$DB_PASSWORD = $GB_DB['pass'];
$DB_DATABASE = $GB_DB['dbName'];

$tables = array();
$tables_with_fields = array();

echo "<pre>\n";
$link_id = mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD) or die('Error establishing a database connection');
echo 'Connected' ."\n";
mysql_select_db($DB_DATABASE, $link_id);
echo 'Selected database' ."\n";

echo 'Getting tables:' ."\n";
$resource = mysql_query("SHOW TABLES", $link_id);
while ( $result = mysql_fetch_row($resource) ) {
	if (in_array($result[0], $GB_TBL)) {
		$tables[] = $result[0];
		echo ' - ' . $result[0] ."\n";
	}
}

if ( !empty($tables) ) {
	echo 'Starting process' ."\n";
	foreach ( (array) $tables as $table ) {
		echo 'Working on table "' . $table . '"';
		$resource = mysql_query("EXPLAIN $table", $link_id);
		while ( $result = mysql_fetch_assoc($resource) ) {
			if ( preg_match('/(char)|(text)|(enum)|(set)/', $result['Type']) )
				$tables_with_fields[$table][$result['Field']] = $result['Type'] . " " . ( "YES" == $result['Null'] ? "" : "NOT " ) . "NULL " .  ( !is_null($result['Default']) ? "DEFAULT '". $result['Default'] ."'" : "" );
				echo '.';
		}
		echo "\n";
	}

	// Change all text/string fields of the tables to their corresponding binary text/string representations.
	echo 'Altering tables to binary character set';
	foreach ( (array) $tables as $table ) {
		mysql_query("ALTER TABLE $table CONVERT TO CHARACTER SET binary", $link_id);
		echo '.';
	}
	echo "\n";

	// Change database and tables to UTF-8 Character set.
	echo 'Altering tables to utf8 character set';
	mysql_query("ALTER DATABASE " . $DB_DATABASE . " CHARACTER SET utf8", $link_id);
	foreach ( (array) $tables as $table ) {
		mysql_query("ALTER TABLE $table CONVERT TO CHARACTER SET utf8", $link_id);
		echo '.';
	}
	echo "\n";

	// Return all binary text/string fields previously changed to their original representations.
	echo 'Altering binary text/string fields to original representation';
	foreach ( (array) $tables_with_fields as $table => $fields ) {
		foreach ( (array) $fields as $field_type => $field_options ) {
			mysql_query("ALTER TABLE $table MODIFY $field_type $field_options", $link_id);
		}
		echo '.';
	}
	echo "\n";

	// Optimize tables and finally close the mysql link.
	echo 'Optimizing tables' . "\n";
	foreach ( (array) $tables as $table )
		mysql_query("OPTIMIZE TABLE $table", $link_id);
	mysql_close($link_id);
	echo "DONE\n\n";
	echo "Please remove this script from your server!";
} else {
	die('There are no tables?');
}
?>