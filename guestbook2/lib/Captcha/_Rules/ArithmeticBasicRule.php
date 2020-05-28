<?php
/**
 * Simple arithmetic problem
 *
 * @package		Captcha
 * @author		Chi Kien Uong <chi.kien@uong.net>
 * @version $Id: ArithmeticBasicRule.php 5 2011-12-18 11:33:40Z cku $
 */

class ArithmeticBasicRule extends AbstractCaptchaRule implements IRule
{

	/**
	 * Get the ChallengeResponse
	 *
	 * @return	ChallengeResponse
	 */
	public function getResponse($captchaId=null) {
		$this->init($captchaId);
		
		$note = $this->getLang("result.arithmetic");
		
		$this->values = array(
			array(0,99),
			array(0,99),
			array(1,9),
			array(1,9)
		);
		$random = mt_rand(0,3);
		$val = $this->getRandomValues($random);
		
		switch ($random) {
			case 0:
				$answer = $val[0] + $val[1];
				$text = "{$val[0]} + {$val[1]} = ";
				break;
			case 1:
				$answer = $val[0] - $val[1];
				$text = "{$val[0]} - {$val[1]} = ";
				break;
			case 2:
				$answer = $val[0] * $val[1];
				$text = "{$val[0]} * {$val[1]} = ";
				break;
			case 3:
				$result = $val[0] * $val[1];
				$answer = $val[1];
				$text = "$result / {$val[0]} = ";
				break;
		}
		
		$img = new CaptchaImage();
		
		$textline1 = $img->getTextLine();
		$c1 = $img->getText($note);
		$textline1->addText($c1);
		
		$textline2 = $img->getTextLine();
		$char2 = $img->getText($text);
		$textline2->addText($char2);
		
		$randLine = mt_rand(0,1);
		if ($randLine == 1) {
			$img->addTextLine($textline1);
			$img->addTextLine($textline2);
		} else {
			$img->addTextLine($textline2);
			$img->addTextLine($textline1);
		}
		return $this->newChallengeResponse($answer, $img->getImageFile($this->imageBasename));
	}
	
	protected function getRandomValues($random) {
		$op1 = mt_rand($this->values[$random][0], $this->values[$random][1]);
		$op2 = mt_rand($this->values[$random][0], $this->values[$random][1]);
		return array($op1, $op2);
	}

}

