<?php
/**
 * Abstract class AbstractCaptchaRule
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: AbstractCaptchaRule.php 5 2011-12-18 11:33:40Z cku $
 */

require_once dirname(__FILE__).'/TextHelper.php';

abstract class AbstractCaptchaRule
{

	/**
	 * @var string
	 */
	protected $name;	
	
	/**
	 * @var ChallengeResponse
	 */
	protected $response;

	/**
	 * @var string
	 */
	protected $captchaId;

	/**
	 * @var string
	 */
	protected $imageBasename;

	/**
	 * @var string
	 */
	protected $outputDir;

	/**
	 * @var string
	 */
	protected $locale;

	/**
	 * @var string
	 */
	protected static $defaultLocale = "en";

	/**
	 * @var array
	 */
	protected $lang = array();

	/**
	 * @var string
	 */
	protected $langdir;

	/**
	 * Constructor
	 *
	 */
	public function __construct() {
		$this->name = get_class($this);
	}	

	/**
	 * Get the name of the rule
	 *
	 * @return	string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Get a random id
	 *
	 * @return	string
	 */	
	public function getRandomId(){
		return md5(uniqid(mt_rand(), true));
	}

	/**
	 * Set the language
	 *
	 * @param	string $locale
	 */	
	public function setLocale($locale) {
		preg_match("/([0-9a-zA-Z_]+)/", $locale, $matches);
		if (isset($matches[1])) {
			$locale = strtolower($matches[1]);
		} else {
			$locale = "en";
		}
		$this->langdir = dirname(__FILE__).'/_language';
		$this->loadLanguageFile($this->getName(), $locale);
	}

	/**
	 * Set the image output directory 
	 *
	 * @param	string $directory
	 */		
	public function setOutputDir($directory) {
		$this->outputDir = $directory;
	}

	/**
	 * Get the current language
	 *
	 * @return	string
	 */		
	public function getLocale() {
		return $this->locale;
	}

	/**
	 * Get a random number
	 *
	 * @param	int $count
	 * @return	int
	 */		
	protected function getRandomIndex($count) {
		$max = $count - 1;
		if ($max >= 0) {
			$randIndex = mt_rand(0, $max);
			return $randIndex;
		}
		return 0;
	}

	/**
	 * Init default values
	 *
	 * @param	string $captchaId
	 */	
	protected function init($captchaId=null) {
		if (preg_match("/[a-z0-9]{32}/i", $captchaId)) {
			$this->captchaId = $captchaId;
		} else {
			$this->captchaId = $this->getRandomId();
		}
		if ($this->locale == null) {
			$this->setLocale(self::$defaultLocale);
		}
		$this->imageBasename = $this->outputDir.'/'.$this->captchaId;
	}

	/**
	 * Get a new ChallengeResponse
	 *
	 * @param	string $responseText
	 * @param	string $imagefile
	 * @return	ChallengeResponse
	 */	
	protected function newChallengeResponse($responseText, $imagefile) {
		$this->response = new ChallengeResponse();
		$this->response->setId($this->captchaId);
		$this->response->setResponseText($responseText);
		$this->response->setImageFile($imagefile);
		return $this->response;
	}

	/**
	 * Get locale text
	 *
	 * @param	string $key
	 * @return	string
	 */		
	protected function getLang($key) {
		if (isset($this->lang[$key])) {
			$langText = $this->lang[$key];
			if (is_array($langText)) {
				$size = count($langText);
				if ($size > 0) {
					$index = mt_rand(0, $size-1);
					return  $langText[$index];
				} else {
					return $langText[0];
				}
			} else {
				return $langText;
			}
		}
	}

	/**
	 * Load a language file
	 *
	 * @param	string $class	class name
	 * @param	string $locale	locale
	 */		
	protected function loadLanguageFile($class, $locale) {
		$langFile = $this->langdir.'/'.$locale.'/'.$class.'.php';
		$this->locale = $locale;
		if (!$this->includeLanguageFile($langFile)) {
			$langFileDefault = $this->langdir.'/'.self::$defaultLocale.'/'.$class.'.php';
			$this->locale = self::$defaultLocale;
			if (!$this->includeLanguageFile($langFileDefault)) {
				$langCommon = $this->langdir.'/'.$locale.'/common.php';
				if (!$this->includeLanguageFile($langCommon)) {
					$this->includeLanguageFile($this->langdir.'/'.self::$defaultLocale.'/common.php');
				}
			}
		}
	}

	/**
	 * Include a file
	 *
	 * @param	string $langFile	filename
	 * @return boolean
	 */			
	protected function includeLanguageFile($langFile) {
		if (is_file($langFile)) {
			include $langFile;
			if (isset($lang)) {
				$this->lang = &$lang;
				return true;
			}
		}
		return false;
	}

	/**
	 * Generate an enumeration
	 *
	 * @param	CaptchaImage $img
	 * @param	array $words
	 * @param	boolean $decimal
	 * @param	CaptchaColor $color
	 * @param	CaptchaFont $font
	 * @return CaptchaImage
	 */	
	protected function addListing($img, $words, $decimal=false, $color=null, $font=null) {
		$lines = count($words);
		for ($i=0; $i<$lines; $i++) {
			$textline = $img->getTextLine();
			$text = $words[$i];
			if ($decimal == true) {
				$k = $i+1;
				$text = "$k)  ".$text;
			} else {
				$text = "-  ".$text;
			}
			$char = $img->getText($text);
			if ($color instanceof CaptchaColor) {
				$char->setColor($color);
			}
			if ($font instanceof CaptchaFont) {
				$char->setFont($font);
			}
			$textline->addText($char);
			$img->addTextLine($textline);
		}
		return $img;
	}

}
