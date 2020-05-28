<?php
/**
 * CaptchaAngle
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: CaptchaAngle.php 2 2011-12-13 14:52:07Z cku $
 */

class CaptchaAngle
{

	/**
	 * @var array
	 */
	protected $range;

	/**
	 * Constructor
	 *
	 * @param	array $range 	the angle in degrees
	 */
	public function __construct($range) {
		if (is_array($range) && count($range) == 2) {
			$min = intval($range[0]);
			$max = intval($range[1]);
			$this->range = array($min, $max);
		} else {
			$this->range = array(0,0);
		}
	}

	/**
	 * Get the angle in degrees
	 *
	 * @return	int
	 */
	public function getAngle() {
		if ($this->range[0] == $this->range[1]) {
			return $this->range[0];
		}
		$randVal = mt_rand($this->range[0], $this->range[1]);
		return $randVal;
	}

}

