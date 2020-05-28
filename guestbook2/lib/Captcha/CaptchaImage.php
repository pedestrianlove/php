<?php
/**
 * CaptchaImage
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: CaptchaImage.php 7 2013-03-01 00:41:53Z cku $
 */

require_once dirname(__FILE__).'/CaptchaTextLine.php';

class CaptchaImage
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
	 * @var Resource#
	 */
	protected $imgRes;

	/**
	 * @var array
	 */
	protected $textLines;

	/**
	 * @var string
	 */
	protected $fontDir;

	/**
	 * @var boolean
	 */
	protected $hasGDSupport;

	/**
	 * @var boolean
	 */
	protected $hasTTFSupport;

	/**
	 * @var array
	 */
	protected $supportedImagesTypes = array();

	/**
	 * @var array
	 */
	protected $loadedFonts = array();

	/**
	 * @var CaptchaColor
	 */
	protected $backgroundColor;

	/**
	 * @var CaptchaFontsize
	 */
	protected $textSize;

	/**
	 * @var CaptchaColor
	 */
	protected $textColor;

	/**
	 * @var CaptchaFont
	 */
	protected $font;

	/**
	 * @var CaptchaAngle
	 */
	protected $angle;

	/**
	 * @var int
	 */
	protected $lineSpacing;

	/**
	 * @var int
	 */
	protected $padding;

	/**
	 * Constructor
	 *
	 * @param	CaptchaColor $textColor			the default text color
	 * @param	CaptchaFontsize $textSize		the default font size
	 * @param	CaptchaColor $backgroundColor	the background color
	 * @param	int $padding					optional value for padding
	 */
	public function __construct($textColor = null, $textSize = null, $backgroundColor = null, $padding = null) {
		$this->fontDir = dirname(__FILE__)."/_fonts";
		$this->imgRes = NULL;
		$this->textLines = array();
		$this->width = 120;
		$this->height = 30;
		$this->hasGDSupport = (extension_loaded("gd")) ? true : false;
		$this->hasTTFSupport = ($this->hasGDSupport && function_exists("imagettftext")) ? true : false;
		if ($this->hasGDSupport) {
			$this->getSupportedImagesTypes();
		}
		if ($this->hasTTFSupport == true) {
			$this->loadFonts();
		}
		$this->angle = new CaptchaAngle(array(0,0));
		if (count($this->loadedFonts)>0) {
			list($key, $val) = each($this->loadedFonts);
			$this->font = new CaptchaFont(array($key => $val));
		} else {
			$this->font = new CaptchaFont(array());
		}
		if ($textColor instanceof CaptchaColor) {
			$this->textColor = $textColor;
		} else {
			$this->textColor = new CaptchaColor(array("000000"));
		}
		if ($backgroundColor instanceof CaptchaColor) {
			$this->backgroundColor = $backgroundColor;
		} else {
			$this->backgroundColor = new CaptchaColor(array("F4F4F4"));
		}
		if ($textSize instanceof CaptchaFontsize) {
			$this->textSize = $textSize;
		} else {
			$this->textSize = new CaptchaFontsize(array(12,12));
		}
		if ($padding != null) {
			$this->setPadding($padding);
		} else {
			$this->padding = 10;
		}
		$this->lineSpacing = 10;
	}

	/**
	 * Get the current padding
	 *
	 * @return	int
	 */
	public function getPadding() {
		return $this->padding;
	}

	/**
	 * Set padding
	 *
	 * @param	int $padding
	 */
	public function setPadding($padding) {
		$this->padding = abs(intval($padding));
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
	 * Set the line spacing
	 *
	 * @param	int $lineSpacing
	 */
	public function setLineSpacing($lineSpacing) {
		$this->lineSpacing = intval($lineSpacing);
	}

	/**
	 * Set the background color
	 *
	 * @param	CaptchaColor $color
	 */
	public function setBackgroundColor($color) {
		if ($color instanceof CaptchaColor) {
			$this->backgroundColor = $color;
		}
	}

	/**
	 * Set the font size
	 *
	 * @param	CaptchaFontsize $size
	 */
	public function setTextSize($size) {
		if ($size instanceof CaptchaFontsize) {
			$this->textSize = $size;
		}
	}

	/**
	 * Get the text size
	 *
	 * @return	CaptchaFontsize
	 */
	public function getTextSize() {
		return $this->textSize;
	}

	/**
	 * Set the color
	 *
	 * @param	CaptchaColor $color
	 */
	public function setTextColor($color) {
		if ($color instanceof CaptchaColor) {
			$this->textColor = $color;
		}
	}

	/**
	 * Set the angle
	 *
	 * @param	CaptchaAngle $angle
	 */
	public function setAngle($angle) {
		if ($angle instanceof CaptchaAngle) {
			$this->angle = $angle;
		}
	}

	/**
	 * Get the text color
	 *
	 * @return	CaptchaColor
	 */
	public function getTextColor() {
		return $this->textColor;
	}

	/**
	 * Get the background color
	 *
	 * @return	CaptchaColor
	 */
	public function getBackgroundColor() {
		return $this->backgroundColor;
	}

	/**
	 * Get the current angle
	 *
	 * @return	CaptchaAngle
	 */
	public function getAngle() {
		return $this->angle;
	}

	/**
	 * Set the font
	 *
	 * @param	CaptchaFont $font
	 */
	public function setFont($font) {
		if ($font instanceof CaptchaFont) {
			$this->font = $font;
		}
	}

	/**
	 * Get the current font
	 *
	 * @return	CaptchaFont
	 */
	public function getFont() {
		return $this->font;
	}

	/**
	 * Set the image width
	 *
	 * @param	int $width
	 * @return	boolean
	 */
	public function setImageWidth($width) {
		$width = intval($width);
		if ($width > 0) {
			$this->width = $width;
			return true;
		}
		return false;
	}

	/**
	 * Set the image height
	 *
	 * @param	int $height
	 * @return	boolean
	 */
	public function setImageHeight($height) {
		$height = intval($height);
		if ($height > 0) {
			$this->height = $height;
			return true;
		}
		return false;
	}

	/**
	 * Add a text line
	 *
	 * @param	CaptchaTextLine $textLine 	A CaptchaTextLine instance
	 */
	public function addTextLine($textLine) {
		if ($textLine instanceof CaptchaTextLine) {
			$this->textLines[] = $textLine;
		}
	}

	/**
	 * Remove a text line at a given index
	 *
	 * @param	in $index 	index in the array $textLines
	 */
	public function removeTextLineAt($index) {
		$index = intval($index);
		if ($index >= 0 && count($this->textLines)>0) {
			$newArr = array();
			foreach ($this->textLines as $key => $val) {
				if ($key != $val) {
					$newArr[] = $val;
				}
			}
			$this->textLines = $newArr;
		}
	}
	
	/**
	 * Output an empty image to browser
	 *
	 */
	public static function createPixel() {
		$date = date("D, d M Y H:i:s");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Pragma: public");
		header("Content-Type: image/png");
		header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
		header("Last-Modified: $date GMT");
		echo base64_decode("iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAABlBMVEX///8AAABVwtN+AAAAB3RJTUUH1gMKDhsHHWK8FQAAAApJREFUeJxjYAAAAAIAAUivpHEAAAAASUVORK5CYII=");
	}

	/**
	 * Send an image file to the browser
	 * 
	 * @param	string $filename 	the image filename
	 */
	public static function sendImage($filename) {
		if (is_file($filename)) {
			$parts = pathinfo($filename);
			if (isset($parts['extension'])) {
				$allowed = array("png", "jpg", "gif");
				if (in_array($parts['extension'], $allowed)) {
					$contentType = array(
						"png" => "image/png",
						"gif" => "image/gif",
						"jpg" => "image/jpg"
					);
					$date = date("D, d M Y H:i:s");
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Pragma: public");
					header("Content-Type: ".$contentType[$parts['extension']]);
					header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
					header("Last-Modified: $date GMT");
					header("Content-Length: ".filesize($filename));
					readfile($filename);
				}
			}
		}
	}

	/**
	 * Write the image to a given filename
	 *
	 * @param	string $filebasename 	The image basename
	 * @param	string $ext 			optional image type
	 * @return	string					returns false on failure or the filename on success
	 */
	public function getImageFile($filebasename, $ext="png") {
		$filename = trim($filebasename);
		$saveDir = dirname($filename);
		if (!is_writable($saveDir)) {
			return false;
		}
		$retVal = "";
		try {
			$this->createImage();
			$ext = strtolower($ext);
			switch ($ext) {
				case "jpeg":
				case "jpg":
					if (isset($this->supportedImagesTypes['jpg'])) {
						$retVal = $filename . '.jpg';
						imagejpeg($this->imgRes, $retVal);
					}
					break;

				case "png":
					if (isset($this->supportedImagesTypes['png'])) {
						$retVal = $filename . '.png';
						imagepng($this->imgRes, $retVal);
					}
					break;

				case "gif":
					if (isset($this->supportedImagesTypes['gif'])) {
						$retVal = $filename . '.gif';
						imagegif($this->imgRes, $retVal);
					}
					break;

				default:
					if (isset($this->supportedImagesTypes['png'])) {
						$retVal = $filename . '.png';
						imagepng($this->imgRes, $retVal);
					}
			}
			imagedestroy($this->imgRes);
			return $retVal;
		} catch (Exception $ex) {
			return false;
		}
	}

	/**
	 * Output image to browser
	 *
	 * @param	string $type 	optional image type
	 * @return	boolean
	 */
	public function getImage($type="png") {
		try {
			$this->createImage();
			$type = strtolower($type);
			switch ($type) {
				case "jpeg":
				case "jpg":
					if (isset($this->supportedImagesTypes['jpg'])) {
						header("Content-Type: image/jpeg");
						imagejpeg($this->imgRes);
					}
					break;

				case "png":
					if (isset($this->supportedImagesTypes['png'])) {
						header("Content-Type: image/png");
						imagepng($this->imgRes);
					}
					break;

				case "gif":
					if (isset($this->supportedImagesTypes['gif'])) {
						header("Content-Type: image/gif");
						imagegif($this->imgRes);
					}
					break;

				default:
					if (isset($this->supportedImagesTypes['png'])) {
						header("Content-Type: image/png");
						imagepng($this->imgRes);
					}
			}
			imagedestroy($this->imgRes);
		} catch (Exception $ex) {
			self::createPixel();
		}
	}

	/**
	 * Get a new CaptchaTextLine instance
	 *
	 * @return	CaptchaTextLine
	 */
	public function getTextLine() {
		return new CaptchaTextLine($this->lineSpacing);
	}

	/**
	 * Get a new CaptchaText instance
	 *
	 * @param	string $textStr
	 * @return	CaptchaText
	 */
	public function getText($textStr = null) {
		$text = new CaptchaText($textStr);
		$text->setAngel($this->angle);
		$text->setColor($this->textColor);
		$text->setFont($this->font);
		$text->setFontSize($this->textSize);
		return $text;
	}

	/**
	 * Load fonts from an optional given directory
	 *
	 * @param	string $fontDir	directory
	 * @return int	number of new loaded fonts
	 */
	public function loadFonts($fontDir = null) {
		$currentfontDir = ($fontDir == null) ?  $this->fontDir : $fontDir;
		$loaded = 0;
		if (is_dir($currentfontDir) && is_readable($currentfontDir)) {
			$fh = opendir($currentfontDir);
			if ($fh !== false) {
				while (($file = readdir($fh)) !== false) {
					if (preg_match("/\.ttf$/i", $file)) {
						$ret = $this->addFontFile($file, $currentfontDir."/$file");
						if ($ret == true) {
							$loaded += 1;
						}
					}
				}
				closedir($fh);
			}
		}
		return $loaded;
	}

	/**
	 * Get the current font directory
	 *
	 * @return	string
	 */
	public function getFontDir() {
		return $this->fontDir;
	}

	/**
	 * Get a new CaptchaFont instance
	 *
	 * @param	string $font	directory or font filename
	 * @return CaptchaFont
	 */	
	public function getNewFont($font) {
		$fontArr = array();
		if (is_file($font)) {
			if (preg_match("/([a-z0-9-_]+\.ttf)$/i", $font, $matches)) {
				if (isset($matches[1])) {
					$fontArr[$matches[1]] = $font;
				}
			}
		} else if (is_dir($font)) {
			$fh = opendir($font);
			if ($fh !== false) {
				while (($file = readdir($fh)) !== false) {
					if (preg_match("/([a-z0-9-_]+\.ttf)$/i", $file, $matches)) {
						if (isset($matches[1])) {
							$fontArr[$matches[1]] = $font.'/'.$file;
						}
					}
				}
				closedir($fh);
			}	
		}
		return new CaptchaFont($fontArr);
	}
	
	/**
	 * Add a new font file
	 *
	 * @param	string $filename	font filename
	 * @param	string $fullpath	fullpath
	 * @return boolean
	 */
	public function addFontFile($filename, $fullpath) {
		$filename = trim($filename);
		if (!isset($this->loadedFonts[$filename])) {
			if (is_file($fullpath)) {
				$this->loadedFonts[$filename] = $fullpath;
				return true;
			}
		}
		return false;
	}

	/**
	 * Get a CaptchaFont instance with the loaded fonts
	 *
	 * @return CaptchaFont
	 */
	public function getLoadedFont() {
		return new CaptchaFont($this->loadedFonts);
	}

	/**
	 * Create an image
	 *
	 * @return Resource#
	 * @throws Exception
	 */
	public function createImage() {
		if ($this->hasGDSupport == false || $this->hasTTFSupport == false) {
			throw new Exception("Required gd and ttf support is missing.");
		}
		$this->adjustImageWidthAndHeight();
		$this->imgRes = imagecreate($this->width, $this->height);
		if (!is_resource($this->imgRes)) {
			throw new Exception("Can't create image resource with imagecreate().");
		}
		$bgColor = $this->backgroundColor->getImageColor();
		imagecolorallocate(
			$this->imgRes,
			$bgColor[0],
			$bgColor[1],
			$bgColor[2]
		);
		$this->writeLines();
		return $this->imgRes;
	}

	/**
	 * Set the final image width and height
	 *
	 */
	protected function adjustImageWidthAndHeight() {
		$total = count($this->textLines);
		$width = 0;
		$height = 0;
		for ($i=0; $i<$total; $i++) {
			$lineWidth = $this->textLines[$i]->getWidth();
			if ($lineWidth > $width) {
				$width = $lineWidth;
			}
			$height += $this->textLines[$i]->getHeight();
		}
		$width = $width + (2*$this->padding);
		if ($width > $this->width) {
			$this->width = $width;
		}
		$height += (3 * $this->padding);
		if ($height > $this->height) {
			$this->height = $height;
		}
	}
	
	/**
	 * Write text lines
	 *
	 */
	protected function writeLines() {
		$total = count($this->textLines);
		if ($total > 0) {
			$yOrdinate = $this->padding;
			for ($i=0; $i<$total; $i++) {
				$yOrdinate += $this->textLines[$i]->getHeight();
				$this->textLines[$i]->writeText($this->imgRes, $this->padding, $yOrdinate);
			}
		}
	}

	/**
	 * Get all supported images types
	 *
	 * @return  array
	 */
	protected function getSupportedImagesTypes() {
		if (count($this->supportedImagesTypes)>0) {
			return $this->supportedImagesTypes;
		}
		if (imagetypes() & IMG_JPG) {
			$this->supportedImagesTypes['jpg'] = true;
		}
		if (imagetypes() & IMG_GIF) {
			$this->supportedImagesTypes['gif'] = true;
		}
		if (imagetypes() & IMG_PNG) {
			$this->supportedImagesTypes['png'] = true;
		}
		return $this->supportedImagesTypes;
	}

}

