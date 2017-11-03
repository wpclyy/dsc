<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Pagination;

interface LengthAwarePaginator extends Paginator
{
	public function getUrlRange($start, $end);

	public function total();

	public function lastPage();
}

?>
