<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support\Testing\Fakes;

class PendingMailFake extends \Illuminate\Mail\PendingMail
{
	public function __construct($mailer)
	{
		$this->mailer = $mailer;
	}

	public function send(\Illuminate\Mail\Mailable $mailable)
	{
		return $this->sendNow($mailable);
	}

	public function sendNow(\Illuminate\Mail\Mailable $mailable)
	{
		$this->mailer->send($this->fill($mailable));
	}

	public function queue(\Illuminate\Mail\Mailable $mailable)
	{
		return $this->sendNow($mailable);
	}
}

?>
