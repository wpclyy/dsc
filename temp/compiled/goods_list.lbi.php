<div class="filter">
    <?php if ($this->_var['script_name'] == 'search'): ?>
    <?php echo $this->fetch('/library/search_filter.lbi'); ?>
    <?php else: ?>
    <?php echo $this->fetch('/library/category_filter.lbi'); ?>
    <?php endif; ?>
</div>
<div class="g-view w">
    <div class="goods-list<?php if (! $this->_var['best_goods']): ?> goods-list-w1390<?php endif; ?>" ectype="gMain">
        <?php if ($this->_var['goods_list']): ?>
        <div class="gl-warp gl-warp-large">
        	<?php if ($this->_var['category'] > 0): ?>
            <form name="compareForm" action="compare.php" method="post" onSubmit="return compareGoods(this);" class="goodslistForm" data-state="0">
            <?php endif; ?>
            <ul>
                <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                <?php if ($this->_var['goods']['goods_id']): ?>
				<?php if ($this->_var['goods']['act_id']): ?>
				<li class="gl-item">
                    <div class="gl-i-wrap">
                        <div class="p-img"><a href="<?php echo $this->_var['goods']['purl']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" /></a></div>
                        <?php if ($this->_var['goods']['pictures']): ?>
                        <div class="sider">
                            <a href="javascript:void(0);" class="sider-prev"><i class="iconfont icon-left"></i></a>
                            <ul>
                                <?php $_from = $this->_var['goods']['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'picture');$this->_foreach['picture'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['picture']['total'] > 0):
    foreach ($_from AS $this->_var['picture']):
        $this->_foreach['picture']['iteration']++;
?>
                                <?php if (($this->_foreach['picture']['iteration'] - 1) < 4): ?>
                                <li <?php if (($this->_foreach['picture']['iteration'] - 1) == 0): ?> class="curr"<?php endif; ?>><img src="<?php if ($this->_var['picture']['thumb_url']): ?><?php echo $this->_var['picture']['thumb_url']; ?><?php else: ?><?php echo $this->_var['picture']['img_url']; ?><?php endif; ?>" width="26" height="26" /></li>
                                <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </ul>
                            <a href="javascript:void(0);" class="sider-next"><i class="iconfont icon-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <div class="p-lie">
                            <div class="p-price">
                                <span><?php echo $this->_var['goods']['shop_price']; ?></span>
                            </div>
                            <div class="p-num"><?php echo $this->_var['lang']['existing']; ?><em><?php echo $this->_var['goods']['sales_volume']; ?></em>预约</div>
                        </div>
                        <div class="p-name"><a href="<?php echo $this->_var['goods']['purl']; ?>" target="_blank"><?php if ($this->_var['script_name'] == 'search'): ?><?php echo $this->_var['goods']['goods_name_keyword']; ?><?php else: ?><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?><?php endif; ?></a></div>
                        <div class="p-store">
                            <a href="<?php echo $this->_var['goods']['store_url']; ?>" title="<?php echo $this->_var['goods']['rz_shopName']; ?>" class="store" target="_blank"><?php echo $this->_var['goods']['rz_shopName']; ?></a>
                            
                            <?php if ($this->_var['goods']['is_IM'] == 1 || $this->_var['goods']['is_dsc']): ?>
                            <a href="javascript:;" id="IM" onclick="openWin(this)" ru_id="<?php echo $this->_var['goods']['user_id']; ?>" class="p-kefu<?php if ($this->_var['goods']['user_id'] == 0): ?> p-c-violet<?php endif; ?>"><i class="iconfont icon-kefu"></i></a>
                            <?php else: ?>
                                <?php if ($this->_var['goods']['kf_type'] == 1): ?>
                                <a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['goods']['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8" class="p-kefu<?php if ($this->_var['goods']['user_id'] == 0): ?> p-c-violet<?php endif; ?>" target="_blank"><i class="iconfont icon-kefu"></i></a>
                                <?php else: ?>
                                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['goods']['kf_qq']; ?>&site=qq&menu=yes" class="p-kefu<?php if ($this->_var['goods']['user_id'] == 0): ?> p-c-violet<?php endif; ?>" target="_blank"><i class="iconfont icon-kefu"></i></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                        </div>
                        <?php if ($this->_var['goods']['is_new'] || $this->_var['goods']['is_hot'] || $this->_var['goods']['is_best'] || $this->_var['goods']['is_shipping'] || $this->_var['goods']['self_run'] || $this->_var['goods']['user_id'] == 0): ?>
                        <div class="p-activity">
							<?php if ($this->_var['goods']['act_id']): ?>
                        	<span class="tag tac-mn">
                            	<i class="i-left"></i>
                                <?php echo $this->_var['goods']['presale']; ?>
                                <i class="i-right"></i>
                            </span>
                            <?php endif; ?>
                        	<?php if ($this->_var['goods']['is_new']): ?>
                        	<span class="tag tac-mn">
                            	<i class="i-left"></i>
                                <?php echo $this->_var['lang']['is_new']; ?>
                                <i class="i-right"></i>
                            </span>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['is_hot']): ?>
                        	<span class="tag tac-mh">
                            	<i class="i-left"></i>
                                <?php echo $this->_var['lang']['is_hot']; ?>
                                <i class="i-right"></i>
                            </span>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['is_best']): ?>
                        	<span class="tag tac-mb">
                            	<i class="i-left"></i>
                                <?php echo $this->_var['lang']['is_best']; ?>
                                <i class="i-right"></i>
                            </span>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['is_shipping']): ?>
                        	<span class="tag tac-by">
                            	<i class="i-left"></i>
                                <?php echo $this->_var['lang']['Free_shipping']; ?>
                                <i class="i-right"></i>
                            </span>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['self_run'] || $this->_var['goods']['user_id'] == 0): ?>
                        	<span class="tag tac-sr">
                            	<i class="i-left"></i>
                                <?php echo $this->_var['lang']['self_run']; ?>
                                <i class="i-right"></i>
                            </span>
                            <?php endif; ?>
                        </div>
                        <?php else: ?>
                        <div class="p-activity">&nbsp;</div>
                        <?php endif; ?>
                        <div class="p-operate">
                            <a href="javascript:void(0);" id="compareLink">
                                <input id="<?php echo $this->_var['goods']['goods_id']; ?>" type="checkbox" name="duibi" class="ui-checkbox" onClick="Compare.add(this, <?php echo $this->_var['goods']['goods_id']; ?>,'<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>','<?php echo $this->_var['goods']['type']; ?>', '<?php echo $this->_var['goods']['goods_thumb']; ?>', '<?php echo $this->_var['goods']['shop_price']; ?>', '<?php echo $this->_var['goods']['market_price']; ?>')">
                                <label class="ui-label" for="<?php echo $this->_var['goods']['goods_id']; ?>"><?php echo $this->_var['lang']['compare']; ?></label>
                            </a>
                            <a href="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>);" class="choose-btn-coll<?php if ($this->_var['goods']['is_collect']): ?> selected<?php endif; ?>"><i class="iconfont<?php if ($this->_var['goods']['is_collect']): ?> icon-zan-alts<?php else: ?> icon-zan-alt<?php endif; ?>"></i><?php echo $this->_var['lang']['btn_collect']; ?></a>
                            <?php if ($this->_var['goods']['prod'] == 1): ?>
                                <?php if ($this->_var['goods']['goods_number'] > 0): ?>
                                <a href="<?php echo $this->_var['goods']['purl']; ?>" rev="<?php echo $this->_var['goods']['goods_thumb']; ?>" class="addcart"><i class="iconfont icon-carts"></i>抢先预购</a>
                                <?php else: ?>
                                <a href="javascript:void(0);" class="addcart btn_disabled"><i class="iconfont icon-carts"></i><?php echo $this->_var['lang']['have_no_goods']; ?></a>
                                <?php endif; ?>
                            <?php else: ?>
                            <a href="<?php echo $this->_var['goods']['purl']; ?>" rev="<?php echo $this->_var['goods']['goods_thumb']; ?>" class="addcart"><i class="iconfont icon-carts"></i>抢先预购</a>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($this->_var['dwt_filename'] == 'history_list'): ?> 
                        <div class="history_close">
                            <a href="javascript:delHistory(<?php echo $this->_var['goods']['goods_id']; ?>)"><img src="themes/ecmoban_dsc2017/images/p-del.png"></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </li>
				<?php else: ?>
                <li class="gl-item">
                    <div class="gl-i-wrap">
                        <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" /></a></div>
                        <?php if ($this->_var['goods']['pictures']): ?>
                        <div class="sider">
                            <a href="javascript:void(0);" class="sider-prev"><i class="iconfont icon-left"></i></a>
                            <ul>
                                <?php $_from = $this->_var['goods']['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'picture');$this->_foreach['picture'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['picture']['total'] > 0):
    foreach ($_from AS $this->_var['picture']):
        $this->_foreach['picture']['iteration']++;
?>
                                <?php if (($this->_foreach['picture']['iteration'] - 1) < 4): ?>
                                <li <?php if (($this->_foreach['picture']['iteration'] - 1) == 0): ?> class="curr"<?php endif; ?>><img src="<?php if ($this->_var['picture']['thumb_url']): ?><?php echo $this->_var['picture']['thumb_url']; ?><?php else: ?><?php echo $this->_var['picture']['img_url']; ?><?php endif; ?>" width="26" height="26" /></li>
                                <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </ul>
                            <a href="javascript:void(0);" class="sider-next"><i class="iconfont icon-right"></i></a>
                        </div>
                        <?php endif; ?>
                        <div class="p-lie">
                            <div class="p-price">
                                <?php if ($this->_var['goods']['promote_price'] != ''): ?>
                                    <?php echo $this->_var['goods']['promote_price']; ?>
                                <?php else: ?>
                                    <?php echo $this->_var['goods']['shop_price']; ?>
                                <?php endif; ?>
                            </div>
                            <div class="p-num"><?php echo $this->_var['lang']['Sold']; ?><em><?php echo $this->_var['goods']['sales_volume']; ?></em>件</div>
                        </div>
                        <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><?php if ($this->_var['script_name'] == 'search'): ?><?php echo $this->_var['goods']['goods_name_keyword']; ?><?php else: ?><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?><?php endif; ?></a></div>
                        <div class="p-store">
                            <a href="<?php echo $this->_var['goods']['store_url']; ?>" title="<?php echo $this->_var['goods']['rz_shopName']; ?>" class="store" target="_blank"><?php echo $this->_var['goods']['rz_shopName']; ?></a>
                            
                            <?php if ($this->_var['goods']['is_IM'] == 1 || $this->_var['goods']['is_dsc']): ?>
                            <a href="javascript:;" id="IM" onclick="openWin(this)" ru_id="<?php echo $this->_var['goods']['user_id']; ?>" class="p-kefu<?php if ($this->_var['goods']['user_id'] == 0): ?> p-c-violet<?php endif; ?>"><i class="iconfont icon-kefu"></i></a>
                            <?php else: ?>
                                <?php if ($this->_var['goods']['kf_type'] == 1): ?>
                                <a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['goods']['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8" class="p-kefu<?php if ($this->_var['goods']['user_id'] == 0): ?> p-c-violet<?php endif; ?>" target="_blank"><i class="iconfont icon-kefu"></i></a>
                                <?php else: ?>
                                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['goods']['kf_qq']; ?>&site=qq&menu=yes" class="p-kefu<?php if ($this->_var['goods']['user_id'] == 0): ?> p-c-violet<?php endif; ?>" target="_blank"><i class="iconfont icon-kefu"></i></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                        </div>
                        <?php if ($this->_var['goods']['is_new'] || $this->_var['goods']['is_hot'] || $this->_var['goods']['is_best'] || $this->_var['goods']['is_shipping'] || $this->_var['goods']['self_run'] || $this->_var['goods']['user_id'] == 0): ?>
                        <div class="p-activity">
                        	<?php if ($this->_var['goods']['is_new']): ?>
                        	<span class="tag tac-mn">
                            	<i class="i-left"></i>
                                <?php echo $this->_var['lang']['is_new']; ?>
                                <i class="i-right"></i>
                            </span>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['is_hot']): ?>
                        	<span class="tag tac-mh">
                            	<i class="i-left"></i>
                                <?php echo $this->_var['lang']['is_hot']; ?>
                                <i class="i-right"></i>
                            </span>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['is_best']): ?>
                        	<span class="tag tac-mb">
                            	<i class="i-left"></i>
                                <?php echo $this->_var['lang']['is_best']; ?>
                                <i class="i-right"></i>
                            </span>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['is_shipping']): ?>
                        	<span class="tag tac-by">
                            	<i class="i-left"></i>
                                <?php echo $this->_var['lang']['Free_shipping']; ?>
                                <i class="i-right"></i>
                            </span>
                            <?php endif; ?>
                            <?php if ($this->_var['goods']['self_run'] || $this->_var['goods']['user_id'] == 0): ?>
                        	<span class="tag tac-sr">
                            	<i class="i-left"></i>
                                <?php echo $this->_var['lang']['self_run']; ?>
                                <i class="i-right"></i>
                            </span>
                            <?php endif; ?>
                        </div>
                        <?php else: ?>
                        <div class="p-activity">&nbsp;</div>
                        <?php endif; ?>
                        <div class="p-operate">
                            <a href="javascript:void(0);" id="compareLink">
                                <input id="<?php echo $this->_var['goods']['goods_id']; ?>" type="checkbox" name="duibi" class="ui-checkbox" onClick="Compare.add(this, <?php echo $this->_var['goods']['goods_id']; ?>,'<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>','<?php echo $this->_var['goods']['type']; ?>', '<?php echo $this->_var['goods']['goods_thumb']; ?>', '<?php echo $this->_var['goods']['shop_price']; ?>', '<?php echo $this->_var['goods']['market_price']; ?>')">
                                <label class="ui-label" for="<?php echo $this->_var['goods']['goods_id']; ?>"><?php echo $this->_var['lang']['compare']; ?></label>
                            </a>
                            <a href="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>);" class="choose-btn-coll<?php if ($this->_var['goods']['is_collect']): ?> selected<?php endif; ?>"><i class="iconfont<?php if ($this->_var['goods']['is_collect']): ?> icon-zan-alts<?php else: ?> icon-zan-alt<?php endif; ?>"></i><?php echo $this->_var['lang']['btn_collect']; ?></a>
                            <?php if ($this->_var['goods']['prod'] == 1): ?>
                                <?php if ($this->_var['goods']['goods_number'] > 0): ?>
                                <a href="javascript:void(0);" onClick="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>,0,event,this,'flyItem');" rev="<?php echo $this->_var['goods']['goods_thumb']; ?>" data-dialog="addCart_dialog" data-divid="addCartLog" data-title="<?php echo $this->_var['lang']['select_attr']; ?>" class="addcart">
                                    <i class="iconfont icon-carts"></i><?php echo $this->_var['lang']['add_to_cart']; ?>
                                </a>
                                <?php else: ?>
                                <a href="javascript:void(0);" class="addcart btn_disabled"><i class="iconfont icon-carts"></i><?php echo $this->_var['lang']['have_no_goods']; ?></a>
                                <?php endif; ?>
                            <?php else: ?>
                            <a href="javascript:void(0);" onClick="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>,0,event,this,'flyItem');" class="addcart" rev="<?php echo $this->_var['goods']['goods_thumb']; ?>"><i class="iconfont icon-carts"></i><?php echo $this->_var['lang']['add_to_cart']; ?></a>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($this->_var['dwt_filename'] == 'history_list'): ?> 
                        <div class="history_close">
                            <a href="javascript:delHistory(<?php echo $this->_var['goods']['goods_id']; ?>)"><img src="themes/ecmoban_dsc2017/images/p-del.png"></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </li>
				<?php endif; ?>
                <?php endif; ?> 
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
            </ul>
            <?php if ($this->_var['category'] > 0): ?>
            </form>
            <?php endif; ?>
            <div id="flyItem" class="fly_item"><img src="" width="40" height="40"></div>
        </div>
        <div class="gl-warp gl-warp-samll">
        	<?php if ($this->_var['category'] > 0): ?>
            <form name="compareForm_cat" id="compareForm_cat" action="compare.php" method="post" onSubmit="return compareGoods(this);" class="goodslistForm" data-state="0">
            <?php endif; ?>
            <ul>
                <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['name']['iteration']++;
?>
                <?php if ($this->_var['goods']['goods_id']): ?>
                <li class="gl-h-item <?php if ($this->_foreach['name']['iteration'] % 2 == 0): ?>item_bg<?php endif; ?>">
                    <div class="gl-i-wrap">
                        <div class="col col-1">
                            <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" /></a></div>
                            <div class="p-right">
                                <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" target="_blank"><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></a></div>
                                <div class="p-lie">
                                    <div class="p-num"><?php echo $this->_var['lang']['sales_volume']; ?>：<?php echo $this->_var['goods']['sales_volume']; ?></div>
                                    <div class="p-comm"><?php echo $this->_var['lang']['comments_rank']; ?>：<?php echo $this->_var['goods']['review_count']; ?><?php if ($this->_var['filename'] != 'category'): ?>+<?php endif; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-2">
                            <div class="p-store">
                                <a href="<?php echo $this->_var['goods']['store_url']; ?>" title="<?php echo $this->_var['goods']['rz_shopName']; ?>" target="_blank"><?php echo $this->_var['goods']['rz_shopName']; ?></a>
                                
                            <?php if ($this->_var['goods']['is_IM'] == 1 || $this->_var['goods']['is_dsc']): ?>
                            <a href="javascript:;" id="IM" onclick="openWin(this)" ru_id="<?php echo $this->_var['goods']['user_id']; ?>" class="p-kefu"><i class="iconfont icon-kefu"></i></a>
                            <?php else: ?>
                                <?php if ($this->_var['goods']['kf_type'] == 1): ?>
                                <a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['goods']['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8" class="p-kefu" target="_blank"><i class="iconfont icon-kefu"></i></a>
                                <?php else: ?>
                                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['goods']['kf_qq']; ?>&site=qq&menu=yes" class="p-kefu" target="_blank"><i class="iconfont icon-kefu"></i></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            </div>
                        </div>
                        <div class="col col-3">
                            <div class="p-price">
                                <div class="shop-price">
                                    <?php if ($this->_var['goods']['promote_price'] != ''): ?>
                                        <?php echo $this->_var['goods']['promote_price']; ?>
                                    <?php else: ?>
                                        <?php echo $this->_var['goods']['shop_price']; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="original-price"><?php echo $this->_var['goods']['market_price']; ?></div>
                            </div>
                        </div>
                        <div class="col col-4">
                            <div class="p-operate">
                                <a href="javascript:void(0);" id="compareLink">
                                <input id="duibi_<?php echo $this->_var['goods']['goods_id']; ?>" type="checkbox" name="duibi" class="ui-checkbox" onClick="Compare.add(this, <?php echo $this->_var['goods']['goods_id']; ?>,'<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>','<?php echo $this->_var['goods']['type']; ?>', '<?php echo $this->_var['goods']['goods_thumb']; ?>', '<?php echo $this->_var['goods']['shop_price']; ?>', '<?php echo $this->_var['goods']['market_price']; ?>')">
                                <label class="ui-label" for="duibi_<?php echo $this->_var['goods']['goods_id']; ?>"><?php echo $this->_var['lang']['compare']; ?></label>
                            </a>
                            <a href="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>);" class="choose-btn-coll<?php if ($this->_var['goods']['is_collect']): ?> selected<?php endif; ?>"><i class="iconfont<?php if ($this->_var['goods']['is_collect']): ?> icon-zan-alts<?php else: ?> icon-zan-alt<?php endif; ?>"></i><?php echo $this->_var['lang']['btn_collect']; ?></a>
                            <?php if ($this->_var['goods']['prod'] == 1): ?>
                                <?php if ($this->_var['goods']['goods_number'] > 0): ?>
                                <a href="javascript:void(0);" onClick="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>,0,event,this,'flyItem2');" rev="<?php echo $this->_var['goods']['goods_thumb']; ?>" data-dialog="addCart_dialog" data-id="" data-divid="addCartLog" data-url="" data-title="<?php echo $this->_var['lang']['select_attr']; ?>" class="addcart">
                                    <i class="iconfont icon-carts"></i><?php echo $this->_var['lang']['add_to_cart']; ?>
                                </a>
                                <?php else: ?>
                                <a href="javascript:void(0);"  class="addcart"><i class="iconfont icon-carts"></i><?php echo $this->_var['lang']['have_no_goods']; ?></a>
                                <?php endif; ?>
                            <?php else: ?>
                            <a href="javascript:void(0);" onClick="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>,0,event,this,'flyItem2');" class="addcart" rev="<?php echo $this->_var['goods']['goods_thumb']; ?>"><i class="iconfont icon-carts"></i><?php echo $this->_var['lang']['add_to_cart']; ?></a>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
            </ul>
            <?php if ($this->_var['category'] > 0): ?>
            </form>
            <?php endif; ?>
            <div id="flyItem2" class="fly_item2"><img src="" width="40" height="40"></div>
        </div>
        <input type="hidden" value="<?php echo $this->_var['region_id']; ?>" id="region_id" name="region_id">
        <input type="hidden" value="<?php echo $this->_var['area_id']; ?>" id="area_id" name="area_id">
        <?php else: ?>
        <div class="no_records">
            <i class="no_icon_two"></i>
            <div class="no_info no_info_line">
                <h3><?php echo $this->_var['lang']['information_null']; ?></h3>
                <div class="no_btn">
                    <a href="index.php" class="btn sc-redBg-btn">返回首页</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if (! $this->_var['category_load_type']): ?>
            
            
            <?php if ($this->_var['pager']['page_count'] > 1): ?>
            <div class="tc">
                <form name="selectPageForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <?php if ($this->_var['pager']['styleid'] == 0): ?> 
                    <div class="pages w1390" id="pager">
                        <?php echo $this->_var['lang']['pager_1']; ?><?php echo $this->_var['pager']['record_count']; ?><?php echo $this->_var['lang']['pager_2']; ?><?php echo $this->_var['lang']['pager_3']; ?><?php echo $this->_var['pager']['page_count']; ?><?php echo $this->_var['lang']['pager_4']; ?> <span> <a href="<?php echo $this->_var['pager']['page_first']; ?>"><?php echo $this->_var['lang']['page_first']; ?></a> <a href="<?php echo $this->_var['pager']['page_prev']; ?>"><?php echo $this->_var['lang']['page_prev']; ?></a> <a href="<?php echo $this->_var['pager']['page_next']; ?>"><?php echo $this->_var['lang']['page_next']; ?></a> <a href="<?php echo $this->_var['pager']['page_last']; ?>"><?php echo $this->_var['lang']['page_last']; ?></a> </span>
                        <?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                        <?php if ($this->_var['key'] == 'keywords'): ?>
                        <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo urldecode($this->_var['item']); ?>" />
                        <?php else: ?>
                        <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo $this->_var['item']; ?>" />
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <select name="page" id="page" onchange="selectPage(this)">
                            <?php echo $this->html_options(array('options'=>$this->_var['pager']['array'],'selected'=>$this->_var['pager']['page'])); ?>
                        </select>
                    </div>

                    
                    <?php else: ?>
                    <div class="pages" id="pager">
                        <ul>
                            <?php if ($this->_var['pager']['page_kbd']): ?>
                            <?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                            <?php if ($this->_var['key'] == 'keywords'): ?>
                            <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo urldecode($this->_var['item']); ?>" />
                            <?php else: ?>
                            <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo $this->_var['item']; ?>" />
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                            <?php endif; ?>
                            <?php if ($this->_var['pager']['page_first']): ?><div class="item prev" style="display:none;"><a href="<?php echo $this->_var['pager']['page_first']; ?>"><span><?php echo $this->_var['lang']['home']; ?></span></a></a></div><?php endif; ?>
                            <div class="item prev"><a href="<?php if ($this->_var['pager']['page_prev']): ?><?php echo $this->_var['pager']['page_prev']; ?><?php else: ?>#none<?php endif; ?>"><i class="iconfont icon-left"></i></a></div>
                            <?php if ($this->_var['pager']['page_count'] != 1): ?>
                            <?php $_from = $this->_var['pager']['page_number']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                            <?php if ($this->_var['pager']['page'] == $this->_var['key']): ?>
                            <div class="item cur"><a href="#none"><?php echo $this->_var['key']; ?></a></div>
                            <?php else: ?>
                            <div class="item"><a href="<?php echo $this->_var['item']; ?>"><?php echo $this->_var['key']; ?></a></div>
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <?php endif; ?>
                            <div class="item next"><a href="<?php if ($this->_var['pager']['page_next']): ?><?php echo $this->_var['pager']['page_next']; ?><?php else: ?>#none<?php endif; ?>"><i class="iconfont icon-right"></i></a></div>
                            <?php if ($this->_var['pager']['page_last']): ?><div class="item next" style="display:none"><a href="<?php echo $this->_var['pager']['page_last']; ?>"><span><?php echo $this->_var['lang']['page_last_new']; ?></span></a></div><?php endif; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </form>
            </div>
            <?php endif; ?>
            
            
        <?php endif; ?>
        <div class="clear"></div>
    </div>
    <?php echo $this->fetch('/library/category_recommend_best.lbi'); ?>
</div>