<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
function get_pzd_list()
{
	$result = get_filter();

	if ($result === false) {
		$filter['apply_sn'] = empty($_REQUEST['apply_sn']) ? '' : trim($_REQUEST['apply_sn']);
		$grade_name = (empty($_REQUEST['grade_name']) ? '' : $_REQUEST['grade_name']);
		$filter['pay_starts'] = isset($_REQUEST['pay_starts']) ? intval($_REQUEST['pay_starts']) : -1;
		$filter['apply_starts'] = isset($_REQUEST['apply_starts']) ? intval($_REQUEST['apply_starts']) : -1;
		$filter['ru_id'] = isset($_REQUEST['ru_id']) ? intval($_REQUEST['ru_id']) : 0;

		if ($grade_name) {
			$filter['grade_id'] = $GLOBALS['db']->getOne('SELECT id FROM' . $GLOBALS['ecs']->table('seller_grade') . ' WHERE grade_name LIKE \'%' . $grade_name . '%\'');
		}

		$where = ' WHERE 1 ';

		if ($filter['apply_sn']) {
			$where .= ' AND apply_sn LIKE \'%' . mysql_like_quote($filter['apply_sn']) . '%\'';
		}

		if ($filter['grade_id']) {
			$where .= ' AND grade_id = \'' . $filter['grade_id'] . '\'';
		}

		if ($filter['pay_starts'] != -1) {
			$where .= ' AND pay_status = \'' . $filter['pay_starts'] . '\'';
		}

		if ($filter['apply_starts'] != -1) {
			$where .= ' AND apply_status = \'' . $filter['apply_starts'] . '\'';
		}

		if (0 < $filter['ru_id']) {
			$where .= ' AND ru_id = \'' . $filter['ru_id'] . '\'';
		}

		$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('seller_apply_info') . $where;
		$filter['record_count'] = $GLOBALS['db']->getOne($sql);
		$filter = page_and_size($filter);
		$sql = 'SELECT * FROM' . $GLOBALS['ecs']->table('seller_apply_info') . $where . '  ORDER BY add_time ASC LIMIT ' . $filter['start'] . ',' . $filter['page_size'];
		$filter['keywords'] = stripslashes($filter['keywords']);
		set_filter($filter, $sql);
	}
	else {
		$sql = $result['sql'];
		$filter = $result['filter'];
	}

	$row = $GLOBALS['db']->getAll($sql);

	foreach ($row as $k => $v) {
		$row[$k]['shop_name'] = get_shop_name($v['ru_id'], 1);
		$row[$k]['grade_name'] = $GLOBALS['db']->getOne('SELECT grade_name FROM ' . $GLOBALS['ecs']->table('seller_grade') . ' WHERE id = \'' . $v['grade_id'] . '\'');
		$row[$k]['add_time'] = local_date('Y-m-d H:i:s', $v['add_time']);

		if (0 < $v['pay_id']) {
			$row[$k]['pay_name'] = $GLOBALS['db']->getOne('SELECT pay_name FROM ' . $GLOBALS['ecs']->table('payment') . ' WHERE pay_id = \'' . $v['pay_id'] . '\'');
		}

		switch ($v['pay_status']) {
		case '0':
			$row[$k]['status_paid'] = '未付款';
			break;

		case '1':
			$row[$k]['status_paid'] = '已付款';
			break;
		}

		switch ($v['apply_status']) {
		case '0':
			$row[$k]['status_apply'] = '未审核';
			break;

		case '1':
			$row[$k]['status_apply'] = '审核通过';
			break;

		case '2':
			$row[$k]['status_apply'] = '审核未通过';
			break;

		case '3':
			$row[$k]['status_apply'] = '<span style=\'color:red\'>无效</span>';
			break;
		}
	}

	$arr = array('pzd_list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
	return $arr;
}

function get_entry_criteria($entry_criteria = '')
{
	$entry_criteria = unserialize($entry_criteria);
	$rel = '';

	if (!empty($entry_criteria)) {
		$sql = ' SELECT id,criteria_name FROM' . $GLOBALS['ecs']->table('entry_criteria') . ' WHERE id ' . db_create_in($entry_criteria);
		$rel = $GLOBALS['db']->getAll($sql);

		foreach ($rel as $k => $v) {
			$child = $GLOBALS['db']->getAll(' SELECT * FROM' . $GLOBALS['ecs']->table('entry_criteria') . ' WHERE parent_id = \'' . $v['id'] . '\'');

			foreach ($child as $key => $val) {
				if (($val['type'] == 'select') && ($val['option_value'] != '')) {
					$child[$key]['option_value'] = explode(',', $val['option_value']);
				}
			}

			$rel[$k]['child'] = $child;
		}
	}

	return $rel;
}

define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
$adminru = get_admin_ru_id();
get_invalid_apply();
$smarty->assign('ru_id', $adminru['ru_id']);
$smarty->assign('menu_select', array('action' => '19_merchants_store', 'current' => '09_merchants_upgrade'));
$exc = new exchange($ecs->table('seller_apply_info'), $db, 'apply_id', 'apply_sn');
$smarty->assign('primary_cat', $_LANG['19_merchants_store']);

if ($_REQUEST['act'] == 'list') {
	$smarty->assign('ur_here', $_LANG['09_merchants_upgrade']);
	$smarty->assign('action_link', array('text' => $_LANG['09_merchants_upgrade'], 'href' => 'merchants_upgrade.php?act=list', 'class' => 'icon-reply'));
	$apply_list = get_pzd_list();
	$page_count_arr = array();
	$page_count_arr = seller_page($apply_list, $_REQUEST['page']);
	$smarty->assign('apply_list', $apply_list['pzd_list']);
	$smarty->assign('filter', $apply_list['filter']);
	$smarty->assign('record_count', $apply_list['record_count']);
	$smarty->assign('page_count', $apply_list['page_count']);
	$smarty->assign('page_count_arr', $page_count_arr);
	$smarty->assign('full_page', 1);
	$smarty->display('seller_apply.dwt');
}
else if ($_REQUEST['act'] == 'query') {
	$apply_list = get_pzd_list();
	$page_count_arr = array();
	$page_count_arr = seller_page($apply_list, $_REQUEST['page']);
	$smarty->assign('apply_list', $apply_list['pzd_list']);
	$smarty->assign('filter', $apply_list['filter']);
	$smarty->assign('record_count', $apply_list['record_count']);
	$smarty->assign('page_count', $apply_list['page_count']);
	$smarty->assign('page_count_arr', $page_count_arr);
	make_json_result($smarty->fetch('seller_apply.dwt'), '', array('filter' => $apply_list['filter'], 'page_count' => $apply_list['page_count']));
}
else if ($_REQUEST['act'] == 'info') {
	$smarty->assign('ur_here', $_LANG['apply_info']);
	$smarty->assign('action_link', array('text' => $_LANG['apply_list'], 'href' => 'seller_apply.php?act=list'));
	$apply_id = (!empty($_REQUEST['apply_id']) ? intval($_REQUEST['apply_id']) : 0);
	$grade_id = (!empty($_REQUEST['grade_id']) ? intval($_REQUEST['grade_id']) : 0);
	$seller_apply_info = $db->getRow('SELECT * FROM' . $ecs->table('seller_apply_info') . ' WHERE apply_id = \'' . $apply_id . '\' LIMIT 1');

	if (0 < $seller_apply_info['pay_id']) {
		$seller_apply_info['pay_name'] = $GLOBALS['db']->getOne('SELECT pay_name FROM ' . $GLOBALS['ecs']->table('payment') . ' WHERE pay_id = \'' . $seller_apply_info['pay_id'] . '\'');
	}

	$apply_criteria = unserialize($seller_apply_info['entry_criteria']);
	$seller_grade = get_seller_grade($seller_apply_info['ru_id']);

	if ($seller_grade) {
		$seller_grade['end_time'] = (date('Y', $seller_grade['add_time']) + $seller_grade['year_num']) . '-' . date('m-d H:i:s', $seller_grade['add_time']);
		$seller_grade['addtime'] = date('Y-m-d H:i:s', $seller_grade['add_time']);
	}

	$entry_criteria = $db->getOne('SELECT entry_criteria FROM ' . $ecs->table('seller_grade') . ' WHERE id = \'' . $grade_id . '\'');
	$entry_criteriat_info = get_entry_criteria($entry_criteria);
	$smarty->assign('entry_criteriat_info', $entry_criteriat_info);
	$smarty->assign('apply_criteria', $apply_criteria);
	$smarty->assign('seller_grade', $seller_grade);
	$smarty->assign('seller_apply_info', $seller_apply_info);
	$smarty->display('seller_apply_info.htm');
}
else if ($_REQUEST['act'] == 'operation') {
	$apply_id = (!empty($_REQUEST['apply_id']) ? intval($_REQUEST['apply_id']) : 0);
	$grade_id = (!empty($_REQUEST['grade_id']) ? intval($_REQUEST['grade_id']) : 0);
	$apply_status = (!empty($_REQUEST['apply_status']) ? $_REQUEST['apply_status'] : 0);
	$reply_seller = (!empty($_REQUEST['reply_seller']) ? $_REQUEST['reply_seller'] : '');
	$is_confirm = (!empty($_REQUEST['apply_status']) ? $_REQUEST['apply_status'] : 0);
	$ru_id = (!empty($_REQUEST['ru_id']) ? intval($_REQUEST['ru_id']) : 0);
	$total_amount = (!empty($_REQUEST['total_amount']) ? $_REQUEST['total_amount'] : 0);
	$year_num = (!empty($_REQUEST['year_num']) ? $_REQUEST['year_num'] : 0);
	$is_paid = (!empty($_REQUEST['is_paid']) ? intval($_REQUEST['is_paid']) : 0);
	$confirm_time = 0;
	$where = '';

	if ($is_confirm != 0) {
		$cfg = $_CFG['send_ship_email'];

		if ($cfg == '1') {
			if ($is_confirm == 1) {
				$grade['confirm'] = '通过';
			}

			if ($is_confirm == 2) {
				$grade['confirm'] = '不通过';
			}

			if ($is_confirm == 3) {
				$grade['confirm'] = '无效';
			}

			$grade['merchants_message'] = $reply_seller;
			$shopinfo = $db->getRow('SELECT shop_name,seller_email FROM ' . $ecs->table('seller_shopinfo') . ' WHERE ru_id = \'' . $ru_id . '\' LIMIT 1 ');
			$grade['shop_name'] = $shopinfo['shop_name'];
			$grade['email'] = $shopinfo['seller_email'];
			$grade['grade_name'] = $db->getOne('SELECT grade_name FROM' . $GLOBALS['ecs']->table('seller_grade') . ' WHERE id = \'' . $_REQUEST['garde_id'] . '\'');
			$tpl = get_mail_template('merchants_allpy_grade');
			$smarty->assign('grade', $grade);
			$smarty->assign('send_time', local_date($_CFG['time_format']));
			$smarty->assign('send_date', local_date($_CFG['date_format']));
			$smarty->assign('sent_date', local_date($_CFG['date_format']));
			$content = $smarty->fetch('str:' . $tpl['template_content']);

			if (!send_mail($grade['shop_name'], $grade['email'], $tpl['template_subject'], $content, $tpl['is_html'])) {
				$msg = $_LANG['send_mail_fail'];
			}
		}

		$apply = $db->getRow('SELECT pay_status , payable_amount ,back_price, apply_sn FROM ' . $ecs->table('seller_apply_info') . ' WHERE apply_id = \'' . $apply_id . '\'');

		if ($is_confirm == 1) {
			$action_list = $db->getRow('SELECT action_list FROM' . $ecs->table('merchants_privilege') . ' WHERE grade_id = \'' . $grade_id . '\' LIMIT 1');
			$sql = 'UPDATE' . $ecs->table('admin_user') . ' SET action_list = ' . $action_list['action_list'] . ' WHERE ru_id = \'' . $ru_id . '\'';
			$db->query($sql);
			$sql = ' SELECT id FROM ' . $ecs->table('merchants_grade') . ' WHERE ru_id = \'' . $ru_id . '\'';

			if (0 < $db->getOne($sql)) {
				$db->query('UPDATE ' . $ecs->table('merchants_grade') . ' SET grade_id = \'' . $grade_id . '\',add_time = \'' . gmtime() . '\' ,amount = \'' . $total_amount . '\' , year_num = \'' . $year_num . '\' WHERE ru_id = \'' . $ru_id . '\'');
			}
			else {
				$db->query('INSERT INTO  ' . $ecs->table('merchants_grade') . ' (`ru_id`,`grade_id`,`add_time`,`amount`,`year_num`) VALUES (\'' . $ru_id . '\',\'' . $grade_id . '\',\'' . gmtime() . '\',\'' . $total_amount . '\',\'' . $year_num . '\')');
			}

			if (0 < $back_price) {
				log_account_change($ru_id, $apply['back_price'], 0, 0, 0, '编号' . $apply['apply_sn'] . '商家等级预付款差额退款');
			}
		}
		else {
			if (($is_confirm == 2) || ($is_confirm == 3)) {
				$sql = 'DELETE FROM' . $ecs->table('merchants_grade') . ' WHERE ru_id = \'' . $ru_id . '\' AND grade_id = \'' . $grade_id . '\'';
				$db->table($sql);
			}

			if (($apply['pay_status'] == 1) && (0 < $apply['payable_amount']) && ($is_confirm != 0)) {
				log_account_change($ru_id, $apply['payable_amount'], 0, 0, 0, '编号' . $apply['apply_sn'] . '商家等级申请未通过退款');
			}
		}

		if ($is_confirm != 0) {
			$confirm_time = gmtime();
		}
	}

	$sql = 'UPDATE' . $ecs->table('seller_apply_info') . ' SET apply_status = \'' . $is_confirm . '\' , confirm_time = \'' . $confirm_time . '\',reply_seller= \'' . $reply_seller . '\',is_paid = \'' . $is_paid . '\' ,pay_status = \'' . $is_paid . '\' , pay_time = \'' . $pay_time . '\'  WHERE apply_id = \'' . $apply_id . '\'';

	if ($db->query($sql) == true) {
		$link[0]['text'] = $_LANG['back_list'];
		$link[0]['href'] = 'seller_apply.php?act=list';
		sys_msg($_LANG['operation_succeed'], 0, $link);
	}
}
else if ($_REQUEST['act'] == 'remove') {
	$id = intval($_GET['id']);
	$entry_criteria = unserialize($db->getRow('SELECT entry_criteria FROM ' . $ecs->table('seller_apply_info') . ' WHERE apply_id = \'' . $id . '\' LIMIT 1'));

	foreach ($entry_criteria as $k => $v) {
		$type = $db->getOne(' SELECT type FROM' . $ecs->table('entry_criteria') . ' WHERE id = \'' . $k . '\'');
		if (($type == 'file') && ($v != '')) {
			@unlink(ROOT_PATH . $v);
		}
	}

	$exc->drop($id);
	$url = 'seller_apply.php?act=list&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);
	ecs_header('Location: ' . $url . "\n");
	exit();
}

?>
