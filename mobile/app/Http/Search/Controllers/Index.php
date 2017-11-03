<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Http\Search\Controllers;

class Index extends \App\Http\Base\Controllers\Frontend
{
	public function actionIndex()
	{
		$this->assign('page_title', L('search'));
		$this->display();
	}
}

?>
