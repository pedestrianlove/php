<?php
/**
 * CaptchaTextLine
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: CaptchaTextLine.php 2 2011-12-13 14:52:07Z cku $
 */

require_once dirname(__FILE__).'/CaptchaText.php';

class CaptchaTextLine
{

	/**
	 * @var int
	 */
	protected $height;

	/**
	 * @var int
	 */
	protected $width;

	/**
	 * @var array
	 */
	protected $textChunks = array();

	/**
	 * @var float
	 */
	protected $letterSpacing = 1;

	/**
	 * @var int
	 */
	protected $lineSpacing = 0;

	/**
	 * @var array
	 */
	private $textInfo = array();

	/**
	 * Constructor
	 *
	 * @param	int $lineSpacing	optional line spacing
	 * @param	int $letterSpacing	optional letter spacing
	 */
	public function __construct($lineSpacing = null, $letterSpacing = null) {
		if ($letterSpacing != null) {
			$this->letterSpacing = intval($letterSpacing);
		}
		if ($lineSpacing != null) {
			$this->lineSpacing = floatval($lineSpacing);
		}
	}

	/**
	 * Get the text height
	 *
	 * @return	int
	 */	
	public function getHeight() {
		$this->getTTFBox();
		$charHeight = 0;
		for ($i=0; $i<count($this->textInfo); $i++) {
			$charY1 = abs($this->textInfo[$i][5] - $this->textInfo[$i][1]);
			$charY2 = abs($this->textInfo[$i][7] - $this->textInfo[$i][3]);
			if ($charY1 > $charHeight) {
				$charHeight = $charY1;
			}
			if ($charY2 > $charHeight) {
				$charHeight = $charY2;
			}
		}
		return ($charHeight + $this->lineSpacing);
	}

	/**
	 * Get the text width
	 *
	 * @return	int
	 */		
	public function getWidth() {
		$this->getTTFBox();
		$total = count($this->textInfo);
		$width = 0;
		for ($i=0; $i<$total; $i++) {
			$chunk = $this->textInfo[$i];
			if ($chunk) {
				$width += $this->getBoxWidth($chunk);
			}
		}
		return ceil($width);
	}

	/**
	 * Get the letter spacing
	 *
	 * @return	int
	 */		
	public function getLetterSpacing() {
		return $this->letterSpacing;
	}

	/**
	 * Get the line spacing
	 *
	 * @return	int
	 */			
	public function getLineSpacing() {
		return $this->lineSpacing;
	}

	/**
	 * Set the letter spacing
	 *
	 * @param	int $letterSpacing
	 */		
	public function setLetterSpacing($letterSpacing) {
		$this->letterSpacing = abs(intval($letterSpacing));
	}

	/**
	 * Set the line spacing
	 *
	 * @param	int $lineSpacing
	 */		
	public function setLineSpacing($lineSpacing) {
		$this->lineSpacing = abs(intval($lineSpacing));
	}

	/**
	 * Add text
	 *
	 * @param	string $text
	 */	
	public function addText($text) {
		if ($text instanceof CaptchaText) {
			$this->textChunks[] = $text;
			$this->textInfo = null;
		}
	}

	/**
	 * Write the text
	 *
	 * @param	Resource# $imgRes	image resource
	 * @param	int $xOrdinate		x-ordinate
	 * @param	int $yOrdinate		y-ordinate
	 */	
	public function writeText(&$imgRes, $xOrdinate, $yOrdinate) {
		$total = count($this->textChunks);
		if ($total > 0) {
			$this->getTTFBox();
			$xPos = $xOrdinate;
			for ($i=0; $i<$total; $i++) {
				$text = $this->textChunks[$i];
				$textInfo = $this->textInfo[$i];
				$textColor = $text->getColor();
				imagettftext(
					$imgRes,
					$text->getFontSize(),
					$text->getAngel(),
					$xPos,
					$yOrdinate,
					imagecolorallocate(
						$imgRes,
						$textColor[0],
						$textColor[1],
						$textColor[2]
					),
					$text->getFont(),
					$text->getText()
				);
				$xPos += $this->getBoxWidth($textInfo);
			}
		}
	}

	/**
	 * Get all defined text objects
	 *
	 * @return	array
	 */		
	public function getTextChunks() {
		return $this->textChunks;
	}

	/**
	 * Get the text of the line
	 *
	 * @return	string
	 */		
	public function __toString() {
		$text = "";
		if (count($this->textChunks)>0) {
			foreach ($this->textChunks as $cText) {
				$text .= $cText;
			}
		}
		return $text;
	}	
	
	/**
	 * Get the width for a bounding box of a text 
	 *
	 * @param	int &$imgBox	bounding box of a text 
	 * @return	int
	 */		
	protected function getBoxWidth(&$imgBox) {
		$width = 0;
		$charX1 = abs($imgBox[4] - $imgBox[0]);
		$charX2 = abs($imgBox[2] - $imgBox[6]);
		$charWidth = ($charX2 > $charX1) ? $charX2 : $charX1;
		$charWidth = ($this->letterSpacing * $charWidth);
		$width += $charWidth;
		return ceil($width);
	}

	/**
	 * Get the bounding box
	 *
	 */		
	private function getTTFBox() {
		if (is_array($this->textInfo)) {
			return;
		}
		$this->textInfo = array();
		$total = count($this->textChunks);
		if ($total > 0) {
			for ($i=0; $i<$total; $i++) {
				$chunk = $this->textChunks[$i];
				$this->textInfo[] = $chunk->getTextWidth();
			}
		}
	}
	
}

