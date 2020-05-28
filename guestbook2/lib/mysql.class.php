<?php
/**
 * ----------------------------------------------
 * Advanced Guestbook 2.4.4 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

class gbook_sql {

    var $conn_id;
    var $result;
    var $record;
    var $db = array();
    var $port;

    function gbook_sql() {
        global $GB_DB;
        $this->db = &$GB_DB;
        if (strpos($this->db['host'], ':') !== FALSE) {
            list($host,$port) = explode(":",$this->db['host']);
            $this->port = $port;
        } else {
            $this->port = 3306;
        }
    }

    function connect() {
        $this->conn_id = mysqli_connect($this->db['host'].":".$this->port,$this->db['user'],$this->db['pass'], $this->db['dbName']);
        if ($this->conn_id == 0) {
            $this->sql_error("Connection Error");
        }
        if (!mysqli_select_db($this->conn_id, $this->db['dbName'])) {
            $this->sql_error("Database Error");
        }
        mysqli_query($this->conn_id, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
        return $this->conn_id;
    }

    function query($query_string) {
        $this->result = mysqli_query($this->conn_id, $query_string);
        if (!$this->result) {
            $this->sql_error("Query Error");
        }
        return $this->result;
    }

    function fetch_array($query_id) {
        $this->record = mysqli_fetch_array($query_id,MYSQL_ASSOC);
        return $this->record;
    }

    function num_rows($query_id) {
        return ($query_id) ? mysqli_num_rows($query_id) : 0;
    }

    function num_fields($query_id) {
        return ($query_id) ? mysqli_num_fields($query_id) : 0;
    }

    function free_result($query_id) {
        return mysqli_free_result($query_id);
    }

    function affected_rows() {
        return mysqli_affected_rows($this->conn_id);
    }

    function close_db() {
        if($this->conn_id) {
            return mysqli_close($this->conn_id);
        } else {
            return false;
        }
    }

    function sql_error($message) {
        global $TEC_MAIL;
        $description = mysqli_error();
        $number = mysqli_errno();
        $error ="MySQL Error : $message\n";
        $error.="Error Number: $number $description\n";
        $error.="Date        : ".date("D, F j, Y H:i:s")."\n";
        $error.="IP          : ".getenv("REMOTE_ADDR")."\n";
        $error.="Browser     : ".getenv("HTTP_USER_AGENT")."\n";
        $error.="Referer     : ".getenv("HTTP_REFERER")."\n";
        $error.="PHP Version : ".PHP_VERSION."\n";
        $error.="OS          : ".PHP_OS."\n";
        $error.="Server      : ".getenv("SERVER_SOFTWARE")."\n";
        $error.="Server Name : ".getenv("SERVER_NAME")."\n";
        echo "<b><font size=4 face=Arial>$message</font></b><hr>";
        echo "<pre>$error</pre>";
        if (!empty($TEC_MAIL)) {
            $headers = "From: $TEC_MAIL\r\nX-Mailer: Advanced Guestbook 2";
            // @mail("$TEC_MAIL","Guestbook - Error","$error","$headers");
        }
        exit();
    }

}
