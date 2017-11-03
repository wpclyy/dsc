<div class="banner catetop-banner">
	<div class="bd"><?php 
$k = array (
  'name' => 'get_adv_child',
  'ad_arr' => $this->_var['cat_top_ad'],
  'id' => $this->_var['cate_info']['cat_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></div>
	<div class="cloth-hd"><ul></ul></div>
</div>
<div class="catetop-main w w1200" ectype="catetopWarp">
	
	<div class="limitime" id="limitime">
		<div class="hd">
			<h2>限时抢购</h2>
			<h3>每日精彩不断</h3>
		</div>
		<div class="bd">
			<ul class="limitime-list clearfix">
				<?php $_from = $this->_var['cate_top_promote_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['promote'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['promote']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['promote']['iteration']++;
?>
				<li class="mod-shadow-card">
					<a href="<?php echo $this->_var['goods']['url']; ?>" class="img"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt=""></a>
					<p class="price">
						<?php if ($this->_var['goods']['promote_price'] != ''): ?>
							 <?php echo $this->_var['goods']['promote_price']; ?>
						<?php else: ?>
							 <?php echo $this->_var['goods']['shop_price']; ?>
						<?php endif; ?>					
						<del><?php echo $this->_var['goods']['market_price']; ?></del>
					</p>
					<a href="<?php echo $this->_var['goods']['url']; ?>" class="name" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo htmlspecialchars($this->_var['goods']['name']); ?></a>
					<a href="<?php echo $this->_var['goods']['url']; ?>" class="limitime-btn"><?php echo $this->_var['lang']['View_details']; ?></a>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
	</div>
	
	<?php 
$k = array (
  'name' => 'get_adv_child',
  'ad_arr' => $this->_var['recommend_merchants'],
  'id' => $this->_var['cat_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
	
	
	<div class="catetop-floor-wp" ectype="goods_cat_level"></div>
	
    <div class="atwillgo" id="atwillgo">
            <div class="awg-hd">
                <h2>随手购</h2>
            </div>
            <div class="awg-bd">
                <div class="atwillgo-slide">
                    <a href="javascript:;" class="prev"><i class="iconfont icon-left"></i></a>
                    <a href="javascript:;" class="next"><i class="iconfont icon-right"></i></a>
                    <div class="hd">
                        <ul></ul>
                    </div>
                    <div class="bd">
                        <ul>
                            <?php $_from = $this->_var['havealook']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'look');if (count($_from)):
    foreach ($_from AS $this->_var['look']):
?>
                            <li>
                                <div class="p-img"><a href="<?php echo $this->_var['look']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['look']['thumb']; ?>" alt=""></a></div>
                                <div class="p-price">
                                    <?php if ($this->_var['look']['promote_price'] != ''): ?>
                                    <?php echo $this->_var['look']['promote_price']; ?>
                                    <?php else: ?>
                                    <?php echo $this->_var['look']['shop_price']; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="p-name"><a href="<?php echo $this->_var['look']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['look']['name']); ?>"><?php echo $this->_var['look']['name']; ?></a></div>
                                <div class="p-btn"><a href="<?php echo $this->_var['look']['url']; ?>" target="_blank"><?php echo $this->_var['lang']['add_to_cart']; ?></a></div>
                            </li>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    
	
	<div class="catetop-lift lift-hide" ectype="lift">
    	<div class="lift-list" ectype="liftList">
        	<div class="catetop-lift-item lift-item-current" ectype="liftItem" data-target="#limitime"><span>限时抢购</span></div>
        	<?php $_from = $this->_var['categories_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat_0_35021000_1509440099');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['cat_0_35021000_1509440099']):
        $this->_foreach['child']['iteration']++;
?>
            <div class="catetop-lift-item lift-floor-item" ectype="liftItem"><span><?php echo $this->_var['cat_0_35021000_1509440099']['name']; ?></span></div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <div class="catetop-lift-item" ectype="liftItem" data-target="#atwillgo"><span>随手购</span></div>
        	<div class="catetop-lift-item lift-item-top" ectype="liftItem"><span><i class="iconfont icon-up"></i></span></div>
        </div>
    </div>
    <input name="region_id" value="<?php echo $this->_var['region_id']; ?>" type="hidden">
    <input name="area_id" value="<?php echo $this->_var['area_id']; ?>" type="hidden">
    <input name="cat_id" value="<?php echo $this->_var['cate_info']['cat_id']; ?>" type="hidden">
    <input name="tpl" value="<?php echo $this->_var['cate_info']['top_style_tpl']; ?>" type="hidden">
    <script type="text/javascript">
		//楼层以后加载后使用js
		function loadCategoryTop(key){
			var Floor = $("#floor_"+key);
			Floor.slide({mainCell:".right-bottom",titCell:".fgoods-hd ul li",effect:"fold"});
		}
	</script>
</div>