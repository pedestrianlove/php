<?php
/**
 * Rule interface
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: IRule.php 2 2011-12-13 14:52:07Z cku $
 */


interface IRule
{

	/**
	 * Get the name of the rule
	 *
	 * @return	string
	 */
	public function getName();

	/**
	 * Get the ChallengeResponse
	 *
	 * @param	string $captchaId	Optional captcha id
	 * @return	ChallengeResponse
	 */
	public function getResponse($captchaId=null);

	/**
	 * Set the language
	 *
	 * @param	string $locale
	 */
	public function setLocale($locale);

	/**
	 * Set the image output directory
	 *
	 * @param	string $directory
	 */
	public function setOutputDir($directory);

}
