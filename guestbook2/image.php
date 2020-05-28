<?php
require_once dirname(__FILE__).'/admin/config.inc.php';
require_once dirname(__FILE__).'/lib/Captcha/CaptchaService.php';
require_once dirname(__FILE__).'/lib/Captcha/DataSourceSessionImpl.php';

if (USE_CAPTCHA) {
	$tmpImageDir = dirname(__FILE__).'/'.$GB_TMP;
	$token = null;
	if (isset($_REQUEST['id'])) {
		if (preg_match("/^([a-z0-9]{32})$/", $_REQUEST['id'])) {
			$token = $_REQUEST['id'];
		}
	}
	if ($token != null) {
		$dssi = DataSourceSessionImpl::getInstance();
		$cs = new CaptchaService($dssi);
		$cs->setImageDir($tmpImageDir);
		$cs->loadRules();
		if (isset($_GET['lang']) && preg_match("/^[a-z0-9_]+$/", $_GET['lang'])) {
			$cs->setLocale($_GET['lang']);
		}
		$sessionIp = $dssi->get('AddRequestIp');
		if ($sessionIp != null && ($sessionIp == $_SERVER['REMOTE_ADDR'])) {
			$rsp = $cs->createResponseForCaptchaId($token);
			if ($rsp instanceof ChallengeResponse) {
				CaptchaImage::sendImage($rsp->getImageFile());
				flush();
				$cs->removedExpiredChallenges();
				exit();
			}
		}
	}
} else {
	CaptchaImage::createPixel();
}


