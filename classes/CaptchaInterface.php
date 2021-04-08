<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

/**
 * Captcha interface
 */
interface CaptchaInterface
{
	public function getHtml();
	public function getConfirmHtml();
	public function validate();
	public function getScript();
}
?>