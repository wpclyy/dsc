<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Providers;

class AuthServiceProvider extends \Illuminate\Support\ServiceProvider
{
	public function register()
	{
	}

	public function boot()
	{
		$this->app['auth']->viaRequest('api', function($request) {
			if ($request->input('api_token')) {
				return \App\Models\User::where('api_token', $request->input('api_token'))->first();
			}
		});
	}
}

?>
