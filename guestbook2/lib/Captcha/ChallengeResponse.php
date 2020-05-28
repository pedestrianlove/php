<?php
/**
 * ChallengeResponse
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: ChallengeResponse.php 2 2011-12-13 14:52:07Z cku $
 */
 
 
class ChallengeResponse  
{

	/**
	 * @var string
	 */		
	protected $responseText;

	/**
	 * @var string
	 */			
	protected $imageFile;

	/**
	 * @var string
	 */			
	protected $id;

	/**
	 * Constructor
	 *
	 */	
	public function __construct() {
		$this->responseText = "";
		$this->imageFile = null;
	}

	/**
	 * Get the text
	 *
	 * @return	string
	 */	
	public function getResponseText(){
		return $this->responseText;
	}

	/**
	 * Set the text
	 *
	 * @param	string $text
	 */		
	public function setResponseText($text) {
		$this->responseText = $text;
	}

	/**
	 * Get the image file
	 *
	 * @return string		Path to the file
	 */		
	public function getImageFile() {
		if (is_file($this->imageFile)) {
			return $this->imageFile;
		}
		return null;
	}

	/**
	 * Set the image file
	 *
	 * @param	string $file		Path to the file
	 */	
	public function setImageFile($file) {
		if (is_file($file) && preg_match("/[a-z0-9_-]+\.(gif|jpg|png)$/i", $file)) {
			$this->imageFile = $file;
		}
	}

	/**
	 * Set the id
	 *
	 * @param	string $id		challenge id
	 */	
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * Get the id
	 *
	 * @return	string
	 */	
	public function getId() {
		return $this->id;
	}

	/**
	 * Delete the image file
	 *
	 */
	public function destroy() {
		if (is_file($this->imageFile)) {
			unlink($this->imageFile);
		}
	}
}

