<?php
/**
 * ----------------------------------------------
 * Advanced Guestbook 2.4.4 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

class guestbook_vars extends gbook_sql {

    public $VARS;
    public $LANG;
    public $table = array();
    public $GB_TPL = array();
    public $SMILIES;
    public $template;
	
	/* TODO */
	public static $langMapping = array(
		'english'	=> 'en',
		'german'	=> 'de'
	);

	public static function getLocale($langname) {
		if (isset(self::$langMapping[$langname])) {
			return self::$langMapping[$langname];
		}
		return null;
	}
	
    public function guestbook_vars($path='') {
        global $GB_TPL,$GB_TBL;
        $this->table = &$GB_TBL;
        $this->GB_TPL = &$GB_TPL;
        $this->gbook_sql();
        $this->connect();
        $this->template = new gb_template($path);
    }

    public function getVars() {
        global $_COOKIE;
        $this->VARS = $this->fetch_array($this->query("SELECT * FROM ".$this->table['cfg']));
        $this->free_result($this->result);
        if (isset($_COOKIE['lang']) && !empty($_COOKIE['lang'])) {
            $this->template->set_lang($_COOKIE['lang']);
        } else {
            $this->template->set_lang($this->VARS["lang"]);
        }
        $this->LANG = $this->template->get_content();
        return $this->VARS;
    }

    public function emotion($message) {
        global $GB_PG;
        if (!isset($this->SMILIES)) {
            $this->query("SELECT * FROM ".$this->table['smile']);
            while ($this->fetch_array($this->result)) {
                $this->SMILIES[$this->record['s_code']] = "<img src=\"$GB_PG[base_url]/img/smilies/".$this->record['s_filename']."\" width=\"".$this->record['width']."\" height=\"".$this->record['height']."\">";
            }
        }
        if (isset($this->SMILIES)) {
            for(reset($this->SMILIES); $key=key($this->SMILIES); next($this->SMILIES)) {
                $message = str_replace("$key",$this->SMILIES[$key],$message);
            }
        }
        return $message;
    }

    public function DateFormat($timestamp) {
        $timestamp += $this->VARS["offset"]*3600;
        list($wday,$mday,$month,$year,$hour,$minutes,$hour12,$ampm) = explode(' ',date("w j n Y H i h A",$timestamp));
        if ($this->VARS["tformat"] == "AMPM") {
            $newtime = " $hour12:$minutes $ampm";
        } else {
            $newtime = " $hour:$minutes";
        }
        if ($this->VARS["dformat"] == "USx") {
            $newdate = " $month-$mday-$year";
        } elseif ($this->VARS["dformat"] == "US") {
            $month -= 1;
            $newdate = $this->template->WEEKDAY[$wday].", ".$this->template->MONTHS[$month]." $mday, $year";
        } elseif ($this->VARS["dformat"] == "Euro") {
            $month -= 1;
            $newdate = $this->template->WEEKDAY[$wday].", $mday. ".$this->template->MONTHS[$month]." $year";
        } else {
            $newdate = "$mday.$month.$year";
        }
        return ($newdate=$newdate.$newtime);
    }

    public function AGCode($string) {
        $string = preg_replace(
                array(
                    '/\[img\](https?:\/\/[^\[]+)\[\/img\]/i',
                    '/\[b\]([^\[]*)\[\/b\]/i',
                    '/\[i\]([^\[]*)\[\/i\]/i',
                    '/\[email\]([^\[]*)\[\/email\]/i',
                    '/\[url\]www.([^\[]*)\[\/url\]/i',
                    '/\[url\]([^\[]*)\[\/url\]/i',
                    '/\[url=((https?):\/\/[^\[]+)\]([^\[]*)\[\/url\]/i'
                ),
                array(
                    '<img src="\1" border="0">',
                    '<b>\1</b>',
                    '<i>\1</i>',
                    '<a href="mailto:\1">\1</a>',
                    '<a href="http://www.\1" target="_blank">\1</a>',
                    '<a href="\1" target="_blank">\1</a>',
                    '<a href="\1" target="_blank">\3</a>'
                ),
                $string);
        return $string;
    }

    public function FormatString($strg) {
        $strg = trim($strg);
        $strg = preg_replace('/ +/', ' ', $strg);
        return $strg;
    }

    public function CheckWordLength($strg) {
        $word_array = preg_split('/[ |\n]/', $strg);
        for ($i=0;$i<sizeof($word_array);$i++) {
            if (preg_match('/^\[[a-z]{3,5}\].+\]/', $word_array[$i])) {
                if (strlen($word_array[$i]) > 200) {
                    return false;
                }
            } elseif (strlen($word_array[$i]) > $this->VARS["max_word_len"]) {
                return false;
            }
        }
        return true;
    }

    public function isBannedIp($ip) {
        $this->query("SELECT * from ".$this->table['ban']);
        if (!$this->result) {
            return false;
        }
        while ($row = $this->fetch_array($this->result)) {
            if (substr($ip, 0, strlen($row['ban_ip'])) === $row['ban_ip']) {
                return true;
            }
        }
        return false;
    }

    public function FloodCheck($ip) {
        $the_time = time()-$this->VARS["flood_timeout"];
        $this->query("DELETE FROM ".$this->table['ip']." WHERE (timestamp < $the_time)");
        $this->query("SELECT * FROM ".$this->table['ip']." WHERE (guest_ip = '$ip')");
        $this->fetch_array($this->result);
        return ($this->record) ? true : false;
    }

    public function CensorBadWords($strg) {
        $replace = "#@*%!";
        $this->query("select * from ".$this->table['words']);
        while ($row = $this->fetch_array($this->result)) {
        	$row['word'] = preg_quote($row['word'], '/');
			$strg = preg_replace('/'.$row['word'].'/i', $replace, $strg);
        }
        return $strg;
    }

    public function gb_error($ERROR) {
        global $GB_PG;
        $LANG = &$this->LANG;
        $VARS = &$this->VARS;
        $error_html = "";
        eval("\$error_html .= \"".$this->template->get_template($this->GB_TPL['header'])."\";");
        eval("\$error_html .= \"".$this->template->get_template($this->GB_TPL['error'])."\";");
        eval("\$error_html .= \"".$this->template->get_template($this->GB_TPL['footer'])."\";");
        return $error_html;
    }

	public function encryptEmail($email) {
		$email = trim($email);
		$retVal = "";
		if (!empty($email)) {
			for($i=0; $i<strlen($email); $i++) {
				$retVal .= dechex(ord($email[$i]));
			}	
		}
		return $retVal;
	}

}
