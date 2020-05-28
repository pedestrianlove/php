<?php
/**
 * CaptchaService
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: CaptchaService.php 6 2012-02-04 19:21:06Z cku $
 */

require_once dirname(__FILE__).'/AbstractCaptchaRule.php';
require_once dirname(__FILE__).'/IRule.php';
require_once dirname(__FILE__).'/ChallengeResponse.php';
require_once dirname(__FILE__).'/IDataSource.php';
require_once dirname(__FILE__).'/CaptchaImage.php';

class CaptchaService
{

	/**
	 * Static var, holding all CacheEngine instances
	 *
	 * @var array
	 */
	protected $loadedRules = array();

	/**
	 * @var string
	 */
	protected $imageDir;

	/**
	 * @var IDataSource
	 */
	protected $dataSource;

	/**
	 * @var string
	 */
	protected $currentDir;

	/**
	 * @var string
	 */
	protected $ruleDir = "_Rules";

	/**
	 * @var string
	 */
	protected $locale = "en";

	/**
	 * Timeout in seconds
	 * 
	 * @var int
	 */
	protected $timeout = 600;


	/**
	 * Constructor
	 *
	 * @param	IDataSource $dataSource       data source for storing generated challenges
	 */
	public function __construct($dataSource = null) {
		$this->imageDir = dirname(__FILE__);
		$this->currentDir = $this->imageDir;
		$this->setDataSource($dataSource);
	}

	/**
	 * Load all rules in $ruleDir
	 *
	 */
	public function loadRules() {
		$ruleDir = $this->currentDir.'/'.$this->ruleDir;
		if (is_dir($ruleDir)) {
			$fh = opendir($ruleDir);
			if ($fh !== false) {
				while (($file = readdir($fh)) !== false) {
					if ($file == "." || $file == "..") {
						continue;
					}
					$matches = array();
					if (preg_match("/([0-9a-zA-Z_]+Rule)\.php$/", $file, $matches)) {
						if (isset($matches[1])) {
							include_once $ruleDir.'/'.$file;
							$class = $matches[1];
							$rule = new $class();
							$this->addRule($rule);
						}
					}
				}
				closedir($fh);
			}
		}
	}

	/**
	 * Load a rule by a given name in $ruleDir
	 *
	 * @param	string $ruleName       rule name
	 * @return	boolean
	 */
	public function loadRule($ruleName) {
		preg_match("/([0-9a-z_]+)/i", $ruleName, $matches);
		if (isset($matches[1])) {
			$ruleName = $matches[1];
			if (!isset($thia->loadedRules[$ruleName])) {
				$ruleFilename = $ruleName.'.php';
				$ruleFile = $this->currentDir.'/'.$this->ruleDir.'/'.$ruleFilename;
				if (is_file($ruleFile)) {
					include_once $ruleFile;
					$rule = new $ruleName();
					return $this->addRule($rule);
				}
			}
		}
		return false;
	}

	/**
	 * Add a rule
	 *
	 * @param	IRule $rule
	 * @return	boolean
	 */
	public function addRule($rule) {
		if ($rule instanceof IRule) {
			$ruleName = $rule->getName();
			if (!isset($this->loadedRules[$ruleName])) {
				$this->loadedRules[$ruleName] = $rule;
				return true;
			}
		}
		return false;
	}

	/**
	 * Get a loaded rule
	 *
	 * @param	string $ruleName	the name of the rule
	 * @return	IRule
	 */
	public function getRule($ruleName) {
		if (isset($this->loadedRules[$ruleName])) {
			return $this->loadedRules[$ruleName];
		}
		return null;
	}

	/**
	 * Get all loaded rules
	 *
	 * @return	array
	 */
	public function getLoadedRules() {
		return array_keys($this->loadedRules);
	}

	/**
	 * Get a new challlenge ID
	 *
	 * @return	string $captchaId
	 */
	public function getChallengeId() {
		$max = $this->getTotalLoadedRules() - 1;
		if ($max >= 0 && $this->dataSource != null) {
			$randIndex = mt_rand(0, $max);
			$keys = array_keys($this->loadedRules);
			$ruleName = $keys[$randIndex];
			$rule = $this->getRule($ruleName);
			$rule->setLocale($this->locale);
			$rule->setOutputDir($this->imageDir);
			$response = $rule->getResponse();
			if ($response instanceof ChallengeResponse) {
				$this->dataSource->set($response->getId(), $response);
				return $response->getId();
			}
		}
		return null;
	}

	/**
	 * Get a new challlenge response
	 *
	 * @param	string $captchaId	captcha token
	 * @return	ChallengeResponse
	 */	
	public function createResponseForCaptchaId($captchaId) {
		if (preg_match("/[a-z0-9]{32}/i", $captchaId)) {
			$response = $this->getResponseChallengeForId($captchaId);
			if ($response == null) {
				$max = $this->getTotalLoadedRules() - 1;
				if ($max >= 0 && $this->dataSource != null) {
					$randIndex = mt_rand(0, $max);
					$keys = array_keys($this->loadedRules);
					$ruleName = $keys[$randIndex];
					$rule = $this->getRule($ruleName);
					$rule->setLocale($this->locale);
					$rule->setOutputDir($this->imageDir);
					$response = $rule->getResponse($captchaId);
					if ($response instanceof ChallengeResponse) {
						$this->dataSource->set($response->getId(), $response);
						return $response;
					}
				}
			} else {
				return $response;
			}
		}
		return null;
	}

	/**
	 * Get ChallengeResponse for a given challlenge ID
	 *
	 * @param	string $captchaId	the challenge id
	 * @return	ChallengeResponse	response for a given challenge id
	 */
	public function getResponseChallengeForId($captchaId) {
		$captchaId = trim($captchaId);
		if (!empty($captchaId) && $this->dataSource != null) {
			if ($this->dataSource->keyExists($captchaId)) {
				$resp = $this->dataSource->get($captchaId);
				if ($resp instanceof ChallengeResponse) {
					if ($this->dataSource->hasExpired($captchaId)) {
						$resp->destroy();
						$this->dataSource->remove($captchaId);
					} else {
						return $resp;
					}
				}
			}
		}
		return null;
	}

	/**
	 * Get the number of loaded rules
	 *
	 * @return	int
	 */
	public function getTotalLoadedRules(){
		return count($this->loadedRules);
	}

	/**
	 * Check if the result is valid
	 *
	 * @param	string $captchaId
	 * @param	string $text
	 * @return boolean
	 */			
	public function isValidResponse($captchaId, $text) {
		if (!empty($captchaId)) {
			$resp = $this->getResponseChallengeForId($captchaId);
			if ($resp instanceof ChallengeResponse) {
				if ($text == $resp->getResponseText()) {
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Set the data source
	 *
	 * @param	IDataSource $dataSource
	 */		
	public function setDataSource($dataSource) {
		if ($dataSource instanceof IDataSource) {
			$this->dataSource = $dataSource;
			$this->dataSource->setTimeout($this->timeout);
			$lang = $this->dataSource->get(__CLASS__."-locale");
			if ($lang != null) {
				$this->setLocale($lang);
			}
		}
	}

	/**
	 * Set the image output directory 
	 *
	 * @param	string $directory
	 */		
	public function setImageDir($directory) {
		if (is_dir($directory)) {
			$this->imageDir = $directory;
		}
	}

	/**
	 * Set the timeout 
	 *
	 * @param	int $seconds
	 */	
	public function setTimeout($seconds) {
		$seconds = intval($seconds);
		if ($seconds>0) {
			$this->timeout = $seconds;
		}
	}

	/**
	 * Get the timeout in seconds
	 *
	 * @return	int
	 */		
	public function getTimeout() {
		return $this->timeout;
	}

	/**
	 * Delete a captcha challenge by a given id
	 *
	 * @param	string $captchaId
	 */	
	public function removeChallenge($captchaId) {
		$resp = $this->getResponseChallengeForId($captchaId);
		if ($resp instanceof ChallengeResponse) {
			$resp->destroy();
			$this->dataSource->remove($captchaId);
		}
	}

	/**
	 * Delete all captcha challenges
	 *
	 */	
	public function clearAllChallenges() {
		if ($this->dataSource == null) {
			return;
		}
		$keys = $this->dataSource->getDefinedKeys();
		foreach ($keys as $captchaId => $val) {
			$this->removeChallenge($captchaId);
		}
	}

	/**
	 * Set the language
	 *
	 * @param	string $locale
	 */
	public function setLocale($locale) {
		preg_match("/([0-9a-zA-Z_]+)/", $locale, $matches);
		if (isset($matches[1])) {
			$this->locale = strtolower($matches[1]);
		} else {
			$this->locale = "en";
		}
		$this->dataSource->set(__CLASS__."-locale", $this->locale);
	}

	/**
	 * Get a current language
	 *
	 * @return	string
	 */	
	public function getLocale() {
		return $this->locale;
	}

	/**
	 * Get a current image output directory
	 *
	 * @return	string
	 */	
	public function getImageDir() {
		return $this->imageDir;
	}

	/**
	 * Remove expired images
	 *
	 */
	public function removedExpiredChallenges() {
		if (is_dir($this->imageDir)) {
			$fh = opendir($this->imageDir);
			if ($fh !== false) {
				$now = time();
				while (($file = readdir($fh)) !== false) {
					if ($file == "." || $file == "..") {
						continue;
					}
					$matches = array();
					if (preg_match("/[a-z0-9]{32}\.(gif|jpg|png)$/i", $file, $matches)) {
						$filetime = filemtime($this->imageDir.'/'.$file) + $this->timeout;
						if ($now > $filetime) {							
							unlink($this->imageDir.'/'.$file);
						}
					}
				}
				closedir($fh);
			}
		}
	}

}



