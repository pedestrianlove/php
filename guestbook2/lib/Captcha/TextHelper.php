<?php
/**
 * TextHelper
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: TextHelper.php 2 2011-12-13 14:52:07Z cku $
 */

class TextHelper
{

	/**
	 * @var array
	 */
	public static $alpha = array(
		"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"
	); 

	/**
	 * @var array
	 */	
	public static $digits = array(
		"0", "1", "2", "3", "4", "5", "6", "7", "8", "9"
	);
	
	/**
	 * @var string
	 */	
	public static $alphaNum = "023456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	
	/**
	 * @var string
	 */	
	public static $alphaMixed = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	
	
	/**
	 * Get a random character
	 *
	 * @return	string
	 */		
	public static function getRandomCharacter() {
		$size = count(self::$alpha)-1;
		$randIndex = mt_rand(0, $size);
		return self::$alpha[$randIndex];
	}

	/**
	 * Get a random text with numbers and letters
	 *
	 * @param	int $minLength	minimum length
	 * @param	int $maxLength	maximum length
	 * @return	string
	 */		
	public static function getRandomAlphaNumText($minLength=4, $maxLength=6) {
		$length = mt_rand($minLength, $maxLength);
		$text = "";
		$size = strlen(self::$alphaNum)-1;
		for ($i=0; $i<$length; $i++) {
			$randPos = mt_rand(0, $size);
			$text .= self::$alphaNum[$randPos];
		}
		return $text;
	}

	/**
	 * Get a random text without numbers
	 *
	 * @param	int $minLength	minimum length
	 * @param	int $maxLength	maximum length
	 * @return	string
	 */	
	public static function getRandomAlphaText($minLength=4, $maxLength=6) {
		$length = mt_rand($minLength, $maxLength);
		$text = "";
		$size = strlen(self::$alphaMixed)-1;
		for ($i=0; $i<$length; $i++) {
			$randPos = mt_rand(0, $size);
			$text .= self::$alphaMixed[$randPos];
		}
		return $text;
	}
	
	/**
	 * Get random phrase
	 *
	 * @param	int $minLength
	 * @param	int $maxLength
	 * @return	string
	 */		
	public static function getPhrase($minLength=4, $maxLength=6) {
		$randLength = mt_rand($minLength, $maxLength);
		$size = count(self::$alpha)-1;
		$text = "";
		for ($i=0; $i<$randLength; $i++) {
			$randIndex = mt_rand(0, $size);
			$text .= self::$alpha[$randIndex];
		}
		return $text;
	}
	
	/**
	 * Get random text
	 *
	 * @param	int $count
	 * @param	int $minLength
	 * @param	int $maxLength
	 * @return	array
	 */	
	public static function getRandomText($count=1, $minLength=4, $maxLength=6) {
		$ret = array();
		if ($count == 0) {
			return $ret;
		}
		for ($i=1; $i<=$count; $i++) {
			$ret[] = self::getPhrase($minLength, $maxLength);
		}
		return $ret;
	}

	/**
	 * Get random text with numbers and characters
	 *
	 * @param	int $count
	 * @param	int $minLength
	 * @param	int $maxLength
	 * @return	array
	 */		
	public static function getRandomMixedText($count=1, $minLength=4, $maxLength=6) {
		$ret = array();
		if ($count == 0) {
			return $ret;
		}
		for ($i=1; $i<=$count; $i++) {
			$ret[] = self::getRandomAlphaText($minLength, $maxLength);
		}
		return $ret;
	}

}

