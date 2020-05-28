<?php
/**
 * Interface for CaptchaService DataSource
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: IDataSource.php 2 2011-12-13 14:52:07Z cku $
 */

interface IDataSource
{

	/**
	 * Set a key value pair
	 *
	 * @param	string $key		key
	 * @param	mixed $value	value
	 */
	public function set($key, $value);

	/**
	 * Get a value for a key
	 *
	 * @param	string $key		unique key
	 * @return	mixed
	 */
	public function get($key);

	/**
	 * Check if the key exists
	 *
	 * @return	boolean
	 */
	public function keyExists($keyname);

	/**
	 * Remove a value
	 *
	 * @param	string $key
	 */
	public function remove($key);

	/**
	 * Set the timeout 
	 *
	 * @param	int $seconds
	 */
	public function setTimeout($seconds);

	/**
	 * Check if the key has expired
	 *
	 * @param	string $key
	 * @return	boolean
	 */
	public function hasExpired($key);

	/**
	 * Get all defined keys
	 *
	 * @return	array
	 */
	public function getDefinedKeys();

	/**
	 * Get the instance
	 *
	 * @return	IDataSource
	 */
	public static function getInstance();

}
