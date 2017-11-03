<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Auth;

interface PasswordBroker
{
	const RESET_LINK_SENT = 'passwords.sent';
	const PASSWORD_RESET = 'passwords.reset';
	const INVALID_USER = 'passwords.user';
	const INVALID_PASSWORD = 'passwords.password';
	const INVALID_TOKEN = 'passwords.token';

	public function sendResetLink(array $credentials);

	public function reset(array $credentials, \Closure $callback);

	public function validator(\Closure $callback);

	public function validateNewPassword(array $credentials);
}


?>
