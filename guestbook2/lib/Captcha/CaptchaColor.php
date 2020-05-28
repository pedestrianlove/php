<?php
/**
 * CaptchaColor
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: CaptchaColor.php 2 2011-12-13 14:52:07Z cku $
 */

class CaptchaColor
{

	/**
	 * @var array
	 */
	protected $colors = array();

	/**
	 * @var string
	 */
	protected $defaultColor = "FFFFFF";

	/**
	 * Constructor
	 *
	 * @param	array $htmlColorCodeArr		e.g. array("EEEEEE", "F2F3D3")
	 */
	public function __construct($htmlColorCodeArr) {
		if (is_array($htmlColorCodeArr)) {
			$size = count($htmlColorCodeArr);
			for ($i=0; $i<$size; $i++) {
				if (preg_match('/^[0-9a-fA-F]{6}$/', $htmlColorCodeArr[$i])) {
					$this->colors[] = $htmlColorCodeArr[$i];
				}
			}
		}
	}

	/**
	 * Allocate a random color for an image
	 *
	 * @return  array 	Returns a color identifier representing the color composed of the given RGB components
	 */
	public function getImageColor() {
		$total = count($this->colors);
		if ($total > 0) {
			if ($total == 1) {
				return self::getRGBCode($this->colors[0]);
			}
			$index = mt_rand(0, $total-1);
			$color = $this->colors[$index];
		} else {
			$color = $this->defaultColor;
		}
		return self::getRGBCode($color);
	}

	/**
	 * Allocate a color for an image at a given position
	 *
	 * @param	int $index			position
	 * @return  array 	Returns a color identifier representing the color composed of the given RGB components
	 */
	public function getImageColorAt($index) {
		if (isset($this->colors[$index])) {
			$rgb = self::getRGBCode($this->colors[$index]);
		} else {
			$rgb = self::getRGBCode($this->defaultColor);
		}
		return $rgb;
	}

	/**
	 * Set the default color
	 *
	 * @param	string $color		html color code
	 */
	public function setDefaultColor($color) {
		if (self::getRGBCode($color) != null) {
			$this->defaultColor = $color;
		}
	}

	/**
	 * Get the default color
	 *
	 * @return	array
	 */
	public function getDefaultColor() {
		return self::getRGBCode($this->defaultColor);
	}

	/**
	 * Returns a color identifier representing the color composed of the given RGB components
	 *
	 * @return	array
	 */
	public static function getRGBCode($htmlColorCode) {
		if (preg_match('/^[0-9a-fA-F]{6}$/', $htmlColorCode)) {
			$color = hexdec($htmlColorCode);
			return array(
				($color >> 16) & 0xFF,
				($color >> 8) & 0xFF,
				$color & 0xFF
			);
		}
		return null;
	}
}

