<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Auth;

interface CanResetPassword
{
	public function getEmailForPasswordReset();

	public function sendPasswordResetNotification($token);
}


?>
