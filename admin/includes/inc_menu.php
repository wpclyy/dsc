<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
if (!defined('IN_ECS')) {
	exit('Hacking attempt');
}

$modules['04_order']['11_order_detection'] = 'order.php?act=order_detection';
$modules['04_order']['11_add_order'] = 'mc_order.php';
$modules['02_cat_and_goods']['sale_notice'] = 'sale_notice.php?act=list';
$modules['04_order']['11_back_cause'] = 'order.php?act=back_cause_list';
$modules['04_order']['12_back_apply'] = 'order.php?act=return_list';
$modules['02_cat_and_goods']['discuss_circle'] = 'discuss_circle.php?act=list';
$modules['01_system']['user_keywords_list'] = 'keywords_manage.php?act=list';
$modules['17_merchants']['01_seller_stepup'] = 'merchants_steps.php?act=step_up';
$modules['17_merchants']['02_merchants_users_list'] = 'merchants_users_list.php?act=list';
$modules['17_merchants']['03_merchants_commission'] = 'merchants_commission.php?act=list';
$modules['17_merchants']['09_seller_domain'] = 'seller_domain.php?act=list';
$modules['17_merchants']['12_seller_account'] = 'merchants_account.php?act=list&act_type=merchants_seller_account';
$modules['17_merchants']['13_comment_seller_rank'] = 'comment_seller.php?act=list';
$modules['17_merchants']['12_seller_store'] = 'offline_store.php?act=list&type=1';
$modules['17_merchants']['16_users_real'] = 'user_real.php?act=list&user_type=1';
$modules['08_members']['12_user_address_list'] = 'user_address_log.php?act=list';
$modules['20_ectouch']['01_oauth_admin'] = '../mobile/index.php?r=oauth/admin';
$modules['20_ectouch']['02_touch_nav_admin'] = 'touch_navigator.php?act=list';
$modules['20_ectouch']['03_touch_ads'] = 'touch_ads.php?act=list';
$modules['20_ectouch']['04_touch_ad_position'] = 'touch_ad_position.php?act=list';
$modules['20_ectouch']['05_touch_dashboard'] = '../mobile/index.php?r=admin/editor';
$modules['21_cloud']['01_cloud_services'] = 'index.php?act=cloud_services';
$modules['21_cloud']['02_platform_recommend'] = 'index.php?act=platform_recommend';
$modules['21_cloud']['03_best_recommend'] = 'index.php?act=best_recommend';
$modules['02_cat_and_goods']['001_goods_setting'] = 'goods.php?act=step_up';
$modules['02_cat_and_goods']['01_goods_list'] = 'goods.php?act=list';
$modules['02_cat_and_goods']['03_category_manage'] = 'category.php?act=list';
$modules['02_cat_and_goods']['05_comment_manage'] = 'comment_manage.php?act=list';
$modules['02_cat_and_goods']['06_goods_brand'] = 'brand.php?act=list';
$modules['02_cat_and_goods']['08_goods_type'] = 'goods_type.php?act=manage';
$modules['02_cat_and_goods']['15_batch_edit'] = 'goods_batch.php?act=select';
$modules['02_cat_and_goods']['gallery_album'] = 'gallery_album.php?act=list';
$modules['02_cat_and_goods']['goods_report'] = 'goods_report.php?act=report_conf';
$modules['02_cat_and_goods']['20_goods_lib'] = 'goods_lib.php?act=list';
$modules['02_cat_and_goods']['21_goods_lib_cat'] = 'goods_lib_cat.php?act=list';
$modules['02_goods_storage']['01_goods_storage_put'] = 'goods_inventory_logs.php?act=list&step=put';
$modules['02_goods_storage']['02_goods_storage_out'] = 'goods_inventory_logs.php?act=list&step=out';
$modules['03_promotion']['02_snatch_list'] = 'snatch.php?act=list';
$modules['03_promotion']['03_seckill_list'] = 'seckill.php?act=list';
$modules['03_promotion']['04_bonustype_list'] = 'bonus.php?act=list';
$modules['03_promotion']['08_group_buy'] = 'group_buy.php?act=list';
$modules['03_promotion']['09_topic'] = 'topic.php?act=list';
$modules['03_promotion']['10_auction'] = 'auction.php?act=list';
$modules['03_promotion']['12_favourable'] = 'favourable.php?act=list';
$modules['03_promotion']['13_wholesale'] = 'wholesale.php?act=list';
$modules['03_promotion']['14_package_list'] = 'package.php?act=list';
$modules['03_promotion']['15_exchange_goods'] = 'exchange_goods.php?act=list';
$modules['03_promotion']['17_coupons'] = 'coupons.php?act=list';
$modules['03_promotion']['18_value_card'] = 'value_card.php?act=list';

if (file_exists(MOBILE_TEAM)) {
	$modules['03_promotion']['18_team'] = '../mobile/index.php?r=team/admin/index';
}

$modules['03_promotion']['gift_gard_list'] = 'gift_gard.php?act=list';
$modules['03_promotion']['16_presale'] = 'presale.php?act=list';
$modules['04_order']['02_order_list'] = 'order.php?act=list';
$modules['04_order']['05_edit_order_print'] = 'order.php?act=templates';
$modules['04_order']['06_undispose_booking'] = 'goods_booking.php?act=list_all';
$modules['04_order']['08_add_order'] = 'order.php?act=add';
$modules['04_order']['09_delivery_order'] = 'order.php?act=delivery_list';
$modules['04_order']['10_back_order'] = 'order.php?act=back_list';
$modules['04_order']['13_complaint'] = 'complaint.php?act=complaint_conf';
$modules['05_banner']['ad_position'] = 'ad_position.php?act=list';
$modules['05_banner']['ad_list'] = 'ads.php?act=list';
$modules['06_stats']['report_guest'] = 'guest_stats.php?act=list';
$modules['06_stats']['report_order'] = 'order_stats.php?act=list';
$modules['06_stats']['sale_list'] = 'sale_list.php?act=list';
$modules['06_stats']['report_users'] = 'users_order.php?act=order_num';
$modules['06_stats']['visit_buy_per'] = 'visit_sold.php?act=list';
$modules['06_stats']['exchange_count'] = 'exchange_detail.php?act=detail';
$modules['07_content']['03_article_list'] = 'article.php?act=list';
$modules['07_content']['02_articlecat_list'] = 'articlecat.php?act=list';
$modules['08_members']['03_users_list'] = 'users.php?act=list';
$modules['08_members']['06_list_integrate'] = 'integrate.php?act=list';
$modules['08_members']['08_unreply_msg'] = 'user_msg.php?act=list_all';
$modules['08_members']['09_user_account'] = 'user_account.php?act=list';
$modules['08_members']['10_user_account_manage'] = 'user_account_manage.php?act=list';
$modules['08_members']['13_user_baitiao_info'] = 'user_baitiao_log.php?act=list';
$modules['08_members']['15_user_vat_info'] = 'user_vat.php?act=list';
$modules['10_priv_admin']['admin_logs'] = 'admin_logs.php?act=list';
$modules['10_priv_admin']['01_admin_list'] = 'privilege.php?act=list';
$modules['10_priv_admin']['02_admin_seller'] = 'privilege_seller.php?act=list';
$modules['10_priv_admin']['admin_role'] = 'role.php?act=list';
$modules['10_priv_admin']['agency_list'] = 'agency.php?act=list';
$modules['10_priv_admin']['suppliers_list'] = 'suppliers.php?act=list';

if (file_exists(MOBILE_KEFU)) {
	$modules['10_priv_admin']['services_list'] = 'services.php?act=list';
}

$modules['10_priv_admin']['admin_message'] = 'message.php?act=list';
$modules['01_system']['01_shop_config'] = 'shop_config.php?act=list_edit';
$modules['01_system']['02_payment_list'] = 'payment.php?act=list';
$modules['01_system']['03_area_shipping'] = 'shipping.php?act=list';
$modules['01_system']['04_mail_settings'] = 'shop_config.php?act=mail_settings';
$modules['01_system']['07_cron_schcron'] = 'cron.php?act=list';
$modules['01_system']['08_friendlink_list'] = 'friend_link.php?act=list';
$modules['01_system']['09_partnerlink_list'] = 'friend_partner.php?act=list';
$modules['01_system']['sitemap'] = 'sitemap.php';
$modules['01_system']['check_file_priv'] = 'check_file_priv.php?act=check';
$modules['01_system']['captcha_manage'] = 'captcha_manage.php?act=main';
$modules['01_system']['ucenter_setup'] = 'integrate.php?act=setup&code=ucenter';
$modules['01_system']['navigator'] = 'navigator.php?act=list';
$modules['01_system']['021_reg_fields'] = 'reg_fields.php?act=list';

if ($_CFG['openvisual'] == 1) {
	$modules['12_template']['01_visualhome'] = 'visualhome.php?act=list';
}
else {
	$modules['12_template']['03_template_setup'] = 'template.php?act=setup';
}

$modules['13_backup']['02_db_manage'] = 'database.php?act=backup';
$modules['13_backup']['03_db_optimize'] = 'database.php?act=optimize';
$modules['13_backup']['04_sql_query'] = 'sql.php?act=main';
$modules['13_backup']['convert'] = 'convert.php?act=main';
$modules['13_backup']['05_table_prefix'] = 'table_prefix.php?act=edit';
$modules['13_backup']['09_clear_cache'] = 'index.php?act=clear_cache';
$modules['13_backup']['06_transfer_config'] = 'transfer_manage.php';
$modules['13_backup']['07_transfer_choose'] = 'transfer_manage.php?act=choose';
$modules['13_backup']['08_db_fields'] = '../mobile/index.php?m=admin&c=database';
$modules['15_rec']['affiliate'] = 'affiliate.php?act=list';
$modules['15_rec']['affiliate_ck'] = 'affiliate_ck.php?act=list';
$modules['09_crowdfunding']['01_crowdfunding_list'] = 'zc_project.php?act=list';
$modules['09_crowdfunding']['02_crowdfunding_cat'] = 'zc_category.php?act=list';
$modules['09_crowdfunding']['03_project_initiator'] = 'zc_initiator.php?act=list';
$modules['09_crowdfunding']['04_topic_list'] = 'zc_topic.php?act=list';
$modules['24_sms']['01_sms_setting'] = 'sms_setting.php?act=step_up';
$modules['24_sms']['alidayu_configure'] = 'alidayu_configure.php?act=list';
$modules['24_sms']['alitongxin_configure'] = 'alitongxin_configure.php?act=list';
$modules['24_sms']['huyi_configure'] = 'huyi_configure.php?act=list';
$modules['25_file']['oss_configure'] = 'oss_configure.php?act=list';
$modules['26_login']['website'] = 'website.php?act=list';
$modules['27_interface']['open_api'] = 'open_api.php?act=list';
$menu_top['menuplatform'] = '05_banner,07_content,08_members,10_priv_admin,01_system,13_backup,16_email_manage,12_template,19_self_support';
$menu_top['menushopping'] = '02_cat_and_goods,03_promotion,04_order,09_crowdfunding,15_rec,17_merchants,18_batch_manage,02_goods_storage,supply_and_demand';
$menu_top['finance'] = '06_stats';
$menu_top['third_party'] = '24_sms,25_file,26_login,27_interface';
$menu_top['ectouch'] = '20_ectouch,22_wechat,23_drp';
$menu_top['menuinformation'] = '21_cloud';
$modules['20_ecjia_app']['02_ecjia_app_shortcut'] = 'ecjia_shortcut.php?act=list';
$modules['20_ecjia_app']['03_ecjia_app_shortcut_ipad'] = 'ecjia_shortcut_ipad.php?act=list';
$modules['20_ecjia_app']['04_ecjia_app_cycleimage'] = 'ecjia_cycleimage.php?act=list';
$modules['20_ecjia_app']['05_ecjia_app_cycleimage_ipad'] = 'ecjia_cycleimage_ipad.php?act=list';
$modules['20_ecjia_app']['06_ecjia_app_discover'] = 'ecjia_discover.php?act=list';
$modules['20_ecjia_app']['08_ecjia_app_device'] = 'ecjia_device.php?act=list';
$modules['20_ecjia_app']['12_ecjia_app_config'] = 'ecjia_config.php?act=list';
$modules['20_ecjia_app']['14_ecjia_app_manage'] = 'ecjia_mobile_manage.php?act=list';
$modules['20_ecjia_app']['16_ecjia_app_toutiao'] = 'ecjia_mobile_toutiao.php?act=list';
$modules['20_ecjia_app']['18_ecjia_app_activity'] = 'ecjia_mobile_activity.php?act=list';
$modules['24_ecjia_sms']['02_ecjia_sms_record'] = 'ecjia_sms_record.php?act=list';
$modules['24_ecjia_sms']['04_ecjia_sms_template'] = 'ecjia_sms.php?act=list';
$modules['26_ecjia_feedback']['08_ecjia_feedback_mobile'] = 'ecjia_feedback.php?act=list';
$modules['28_ecjia_marketing']['02_ecjia_marketing_adviser'] = 'ecjia_adviser.php?act=list';
$modules['30_ecjia_push']['02_ecjia_push_record'] = 'ecjia_push_record.php?act=list';
$modules['30_ecjia_push']['04_ecjia_push_event'] = 'ecjia_push_event.php?act=list';
$modules['30_ecjia_push']['06_ecjia_push_template'] = 'ecjia_push_template.php?act=list';
$modules['30_ecjia_push']['08_ecjia_push_config'] = 'ecjia_push_config.php?act=list';
$modules['20_ectouch']['01_oauth_admin'] = '../mobile/index.php?r=oauth/admin';
$modules['20_ectouch']['02_touch_nav_admin'] = 'touch_navigator.php?act=list';
$modules['20_ectouch']['03_touch_ads'] = 'touch_ads.php?act=list';
$modules['20_ectouch']['04_touch_ad_position'] = 'touch_ad_position.php?act=list';

if (file_exists(MOBILE_WECHAT)) {
	$modules['22_wechat']['01_wechat_admin'] = '../mobile/index.php?r=wechat/admin/modify';
	$modules['22_wechat']['02_mass_message'] = '../mobile/index.php?r=wechat/admin/mass_message';
	$modules['22_wechat']['03_auto_reply'] = '../mobile/index.php?r=wechat/admin/reply_subscribe';
	$modules['22_wechat']['04_menu'] = '../mobile/index.php?r=wechat/admin/menu_list';
	$modules['22_wechat']['05_fans'] = '../mobile/index.php?r=wechat/admin/subscribe_list';
	$modules['22_wechat']['06_media'] = '../mobile/index.php?r=wechat/admin/article';
	$modules['22_wechat']['07_qrcode'] = '../mobile/index.php?r=wechat/admin/qrcode_list';
	$modules['22_wechat']['09_extend'] = '../mobile/index.php?r=wechat/extend/index';
	$modules['22_wechat']['11_template'] = '../mobile/index.php?r=wechat/admin/template';
}

if (file_exists(MOBILE_DRP)) {
	$modules['23_drp']['01_drp_config'] = '../mobile/index.php?r=drp/admin/config';
	$modules['23_drp']['02_drp_shop'] = '../mobile/index.php?r=drp/admin/shop';
	$modules['23_drp']['03_drp_list'] = '../mobile/index.php?r=drp/admin/drplist';
	$modules['23_drp']['04_drp_order_list'] = '../mobile/index.php?r=drp/admin/drporderlist';
	$modules['23_drp']['05_drp_set_config'] = '../mobile/index.php?r=drp/admin/drpsetconfig';
}

$modules['16_email_manage']['email_list'] = 'email_list.php?act=list';
$modules['16_email_manage']['magazine_list'] = 'magazine_list.php?act=list';
$modules['16_email_manage']['attention_list'] = 'attention_list.php?act=list';
$modules['16_email_manage']['view_sendlist'] = 'view_sendlist.php?act=list';
$modules['19_self_support']['01_self_offline_store'] = 'offline_store.php?act=list';
$modules['19_self_support']['02_self_order_stats'] = 'offline_store.php?act=order_stats';
$modules['19_self_support']['03_self_support_info'] = 'index.php?act=merchants_first';
$modules['12_template']['02_template_select'] = 'template.php?act=list';
$modules['12_template']['04_template_library'] = 'template.php?act=library';
$modules['12_template']['05_edit_languages'] = 'edit_languages.php?act=list';
$modules['12_template']['06_template_backup'] = 'template.php?act=backup_setting';
$modules['12_template']['mail_template_manage'] = 'mail_template.php?act=list';
$modules['08_members']['17_mass_sms'] = 'mass_sms.php?act=list';
$modules['02_goods_storage']['suppliers_list'] = 'suppliers.php?act=list';

?>
