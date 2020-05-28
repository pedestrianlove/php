<?php
/**
 * CaptchaFontsize
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: CaptchaFontsize.php 2 2011-12-13 14:52:07Z cku $
 */

class CaptchaFontsize
{

	/**
	 * @var array
	 */
	protected $fontSizeRange;

	/**
	 * Constructor
	 *
	 * @param	array $fontSizeRange
	 */
	public function __construct($fontSizeRange) {
		if (is_array($fontSizeRange) && count($fontSizeRange) == 2) {
			$min = intval($fontSizeRange[0]);
			$max = intval($fontSizeRange[1]);
			if ($min <= 0 ) {
				$min = 1;
			}
			if ($max <= 0 ) {
				$max = 1;
			}
			$this->fontSizeRange = array($min, $max);
		} else {
			$this->fontSizeRange = array(15,15);
		}
	}

	/**
	 * Get a font size value
	 *
	 * @return	int
	 */
	public function getFontSize() {
		if ($this->fontSizeRange[0] == $this->fontSizeRange[1]) {
			return $this->fontSizeRange[0];
		}
		$index = mt_rand($this->fontSizeRange[0], $this->fontSizeRange[1]);
		return $this->fontSizeRange[$index];
	}
	
}

