<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Notifications\Send;

class SmsDriver implements SendInterface
{
	protected $config = array('sms_name' => '', 'sms_password' => '');
	protected $sms;

	public function __construct($config = array())
	{
		$this->config = array_merge($this->config, $config);
		$this->sms = new \App\Notifications\Sms\Sms($this->config);
	}

	public function push($to, $title, $content, $data = array())
	{
		return $this->sms->setSms($title, $content)->sendSms($to);
	}

	public function getError()
	{
		return $this->sms->getError();
	}
}

?>
