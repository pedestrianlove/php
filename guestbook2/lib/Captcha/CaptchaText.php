<?php
/**
 * CaptchaText
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: CaptchaText.php 2 2011-12-13 14:52:07Z cku $
 */

require_once dirname(__FILE__).'/CaptchaFont.php';
require_once dirname(__FILE__).'/CaptchaColor.php';

class CaptchaText
{

	/**
	 * @var string
	 */
	protected $font;

	/**
	 * @var int
	 */
	protected $fontSize = 15;

	/**
	 * @var int
	 */
	protected $angle = 0;

	/**
	 * RGB color
	 *
	 * @var array
	 */
	protected $color = array(0,0,0);

	/**
	 * @var string
	 */
	protected $text = "";

	/**
	 * Constructor
	 *
	 * @param	string $text
	 */
	public function __construct($text=null) {
		if ($text != null) {
			$this->setText($text);
		}
	}

	/**
	 * Get the bounding box of the text
	 *
	 * @return	array
	 */
	public function getTextWidth() {
		if ($this->text != "") {
			return imagettfbbox($this->fontSize, $this->angle, $this->font, $this->text);
		}
		return false;
	}

	/**
	 * Set the font size
	 *
	 * @param	CaptchaFontsize $size
	 */
	public function setFontSize($fontsize) {
		if ($fontsize instanceof CaptchaFontsize) {
			$this->fontSize = $fontsize->getFontSize();
		}
	}

	/**
	 * Get the text size
	 *
	 * @return	int
	 */
	public function getFontSize() {
		return $this->fontSize;
	}

	/**
	 * Set the angle
	 *
	 * @param	CaptchaAngle $angle
	 */
	public function setAngel($angle) {
		if ($angle instanceof CaptchaAngle) {
			$this->angle = $angle->getAngle();
		}
	}

	/**
	 * Get the angle
	 *
	 * @return	int
	 */		
	public function getAngel() {
		return $this->angle;
	}

	/**
	 * Set the font
	 *
	 * @param	CaptchaFont $font
	 */		
	public function setFont($font) {
		if ($font instanceof CaptchaFont) {
			$this->font = $font->getFontFile();
		}
	}

	/**
	 * Get the font file
	 *
	 * @return	string
	 */			
	public function getFont() {
		return $this->font;
	}

	/**
	 * Set the color
	 *
	 * @param	CaptchaColor $color
	 */
	public function setColor($color) {
		if ($color instanceof CaptchaColor) {
			$this->color = $color->getImageColor();
		}
	}

	/**
	 * Get the RGB text color
	 *
	 * @return	array
	 */		
	public function getColor() {
		return $this->color;
	}

	/**
	 * Set the text
	 *
	 * @param	string $text
	 */			
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * Get the text
	 *
	 * @return	string
	 */		
	public function getText() {
		return $this->text;
	}

	/**
	 * Get the text
	 *
	 * @return	string
	 */		
	public function __toString() {
		return $this->text;
	}
	
}

