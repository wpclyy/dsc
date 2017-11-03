<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Repositories\Order;

class OrderInvoiceRepository implements \App\Contracts\Repository\Order\OrderInvoiceRepositoryInterface
{
	public function find($userid)
	{
		$order = \App\Models\OrderInvoice::where('user_id', $userid)->first();

		if ($order == null) {
			return array();
		}

		return $order;
	}

	public function updateInvoice($id, array $args)
	{
		$model = \App\Models\OrderInvoice::where('user_id', $args['user_id'])->where('invoice_id', $id)->first();

		if ($model === null) {
			return array();
		}

		foreach ($args as $k => $v) {
			$model->$k = $v;
		}

		return $model->save();
	}

	public function addInvoice($args)
	{
		$model = new \App\Models\OrderInvoice();

		foreach ($args as $k => $v) {
			$model->$k = $v;
		}

		$model->save();
		return $model->invoice_id;
	}
}

?>
