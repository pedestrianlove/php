<?php
/**
 * Interface for CaptchaService DataSource
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: DataSourceSessionImpl.php 3 2011-12-14 00:46:53Z cku $
 */

require_once dirname(__FILE__).'/IDataSource.php';

class DataSourceSessionImpl implements IDataSource
{

	/**
	 * Object instance
	 *
	 * @var object
	 */
	protected static $instance;

	/**
	 * @var int
	 */
	protected $timeout = 600;

	/**
	 * @var array
	 */
	protected $values;

	/**
	 * @var string
	 */
	protected $valueIndexname;

	/**
	 * Constructor
	 *
	 */
	private function __construct() {
		if (!isset($_SESSION) || !is_array($_SESSION)) {
			session_start();
		}
		$this->valueIndexname = __CLASS__.'.'.md5(__FILE__);
		$indexName = $this->valueIndexname;
		if (isset($_SESSION[$indexName]) && is_array($_SESSION[$indexName])) {
			$this->values = &$_SESSION[$indexName];
		} else {
			$_SESSION[$indexName] = array();
			$this->values = &$_SESSION[$indexName];
		}
	}

	/**
	 * Destructor
	 *
	 */
	public function __destruct() {
		$size = count($this->values);
		if ($size > 0) {
			$now = time();
			foreach ($this->values as $key => $val) {
				$expired = $val + $this->timeout;
				if ($now > $expired) {
					$resp = $this->get($key);
					if ($resp instanceof ChallengeResponse) {
						$resp->destroy();
						$this->remove($key);
					} else {
						unset($_SESSION[$key]);
						unset($this->values[$key]);
					}
				}
			}
		}
	}

	/**
	 * Set a key value pair
	 *
	 * @param	string $key		key
	 * @param	mixed $value	value
	 */
	public function set($key, $value) {
		$this->values[$key] = time();
		$_SESSION[$key] = $value;
	}

	/**
	 * Get a value for a key
	 *
	 * @param	string $key		unique key
	 * @return	mixed
	 */
	public function get($key) {
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
		return null;
	}

	/**
	 * Check if the key exists
	 *
	 * @return	boolean
	 */
	public function keyExists($keyname) {
		return (isset($_SESSION[$keyname]));
	}

	/**
	 * Remove a value
	 *
	 * @param	string $key
	 */
	public function remove($key) {
		if (isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
			unset($this->values[$key]);
		}
	}

	/**
	 * Set timeout value
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
	 * Get the instance
	 *
	 * @return	DataSourceSessionImpl
	 */
	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new DataSourceSessionImpl();
		}
		return self::$instance;
	}

	/**
	 * Get all defined keys
	 *
	 * @return	array
	 */
	public function getDefinedKeys() {
		return $this->values;
	}

	/**
	 * Check if the key has expired
	 *
	 * @param	string $key
	 * @return	boolean
	 */
	public function hasExpired($key) {
		if (isset($this->values[$key])) {
			$val = $this->values[$key] + $this->timeout;
			$now = time();
			if ($val < $now) {
				return true;
			}
		}
		return false;
	}

}

