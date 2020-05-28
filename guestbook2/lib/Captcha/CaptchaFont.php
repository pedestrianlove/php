<?php
/**
 * CaptchaFont
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: CaptchaFont.php 2 2011-12-13 14:52:07Z cku $
 */

require_once dirname(__FILE__).'/CaptchaFontsize.php';
require_once dirname(__FILE__).'/CaptchaAngle.php';

class CaptchaFont
{

	/**
	 * @var array
	 */
	protected $fonts = array();

	/**
	 * Constructor
	 *
	 * @param	array $fontfileArr
	 */
	public function __construct($fontfileArr) {
		if (is_array($fontfileArr)) {
			$this->fonts = $fontfileArr;
		}
	}

	/**
	 * Get a font file by a optional given name
	 *
	 * @param	string $filename	optional filename
	 * 								if not not set, returns a random font file
	 */
	public function getFontFile($filename = null) {
		if ($filename == null) {
			$total = count($this->fonts);
			if ($total > 0) {
				if ($total == 1) {
					return reset($this->fonts);
				}
				$tmpArr = $this->fonts;
				shuffle($tmpArr);
				return $tmpArr[0];
			}
		} else {
			$filename = trim($filename);
			if (isset($this->fonts[$filename])) {
				return $this->fonts[$filename];
			}
		}
		return null;
	}

}

