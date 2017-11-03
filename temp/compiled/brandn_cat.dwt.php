<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<?php if ($this->_var['brand']['brand_desc']): ?>
<meta name="Description" content="<?php echo $this->_var['brand']['brand_desc']; ?>" />
<?php else: ?>
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<?php endif; ?>

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<?php echo $this->fetch('library/js_languages_new.lbi'); ?>
</head>

<body>
    <?php echo $this->fetch('library/page_header_common.lbi'); ?>
    <div class="content">
    	<?php if ($this->_var['brand']['brand_bg']): ?>
        <div class="brand-home-top" style="background:url(data/brandbg/<?php echo $this->_var['brand']['brand_bg']; ?>) center center no-repeat;">
        <?php else: ?>
        <div class="brand-home-top" style="background:url(themes/ecmoban_dsc2017/images/brand_cat_bg.jpg) center center no-repeat;">
        <?php endif; ?>
        	<div class="w w1200">
                <div class="attention-rate">
                    <div class="brand-logo"><img src="data/brandlogo/<?php echo $this->_var['brand']['brand_logo']; ?>"></div>
                    <div class="follow-info">
                        <span class="follow-sum"><em id="collect_count"><?php echo $this->_var['brand']['collect_count']; ?></em>人&nbsp;&nbsp;关注</span>
                        <div class="go-follow" data-bid="<?php echo $this->_var['brand_id']; ?>" ectype="coll_brand"><?php if ($this->_var['brand']['is_collect'] > 0): ?><i class="iconfont icon-zan-alts"></i><span ectype="follow_span">已关注</span><?php else: ?><i class="iconfont icon-zan-alt"></i><span ectype="follow_span">关注</span><?php endif; ?></div>
                    </div>
                </div>
                <div class="brand-cate-info">
                	<div class="title">
                    	<h3>品牌分类</h3>
                    </div>
                    <div class="cate-list" ectype="brandcat">
						<a href="javascript:;" data-catid="0" class="curr">全部分类</a>
						<?php $_from = $this->_var['brand_cat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand_cat');$this->_foreach['brand'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['brand']['total'] > 0):
    foreach ($_from AS $this->_var['brand_cat']):
        $this->_foreach['brand']['iteration']++;
?>
                    	<?php if (! ($this->_foreach['brand']['iteration'] <= 1)): ?>
                    	<a href="javascript:;" data-catid="<?php echo $this->_var['brand_cat']['cat_id']; ?>"><?php echo $this->_var['brand_cat']['cat_name']; ?></a>
                        <?php endif; ?>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="brand-main">
            <div class="w w1200" ectype="goodslist">
            	<div class="brand-section best-list">
                	<div class="bl-title"><h2>精品推荐</h2></div>
                    <div class="bl-content">
                    	<div class="hd">
                        	<ul></ul>
                        </div>
                    	<div class="bd">
                        	<ul>
								<?php $_from = $this->_var['best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'best_goods_0_06148600_1509155613');$this->_foreach['best_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['best_goods']['total'] > 0):
    foreach ($_from AS $this->_var['best_goods_0_06148600_1509155613']):
        $this->_foreach['best_goods']['iteration']++;
?>
								<?php if ($this->_foreach['best_goods']['iteration'] <= 10): ?>
                            	<li>
                                	<div class="p-img"><a href="<?php echo $this->_var['best_goods_0_06148600_1509155613']['url']; ?>"><img src="<?php echo $this->_var['best_goods_0_06148600_1509155613']['thumb']; ?>"></a></div>
                                    <div class="p-price"><?php echo $this->_var['best_goods_0_06148600_1509155613']['shop_price']; ?></div>
                                    <div class="p-name"><a href="<?php echo $this->_var['best_goods_0_06148600_1509155613']['url']; ?>"><?php echo $this->_var['best_goods_0_06148600_1509155613']['short_style_name']; ?></a></div>
                                </li>	
								<?php endif; ?>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>	
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="brand-section">
                	<div class="bl-title"><h2>找新品<i></i></h2><!--<a href="" class="more ftx-05">查看更多></a>--></div>
                    <div class="bl-content">
                    	<div class="bd">
                        	<ul>
								<?php $_from = $this->_var['new_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'new_goods_0_06158800_1509155613');$this->_foreach['new_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['new_goods']['total'] > 0):
    foreach ($_from AS $this->_var['new_goods_0_06158800_1509155613']):
        $this->_foreach['new_goods']['iteration']++;
?>
								<?php if ($this->_foreach['new_goods']['iteration'] <= 10): ?>							
                            	<li>
                                	<div class="p-img"><a href="<?php echo $this->_var['new_goods_0_06158800_1509155613']['url']; ?>"><img src="<?php echo $this->_var['new_goods_0_06158800_1509155613']['thumb']; ?>"></a></div>
                                    <div class="p-price"><?php echo $this->_var['new_goods_0_06158800_1509155613']['shop_price']; ?></div>
                                    <div class="p-name"><a href="<?php echo $this->_var['new_goods_0_06158800_1509155613']['url']; ?>"><?php echo $this->_var['new_goods_0_06158800_1509155613']['short_style_name']; ?></a></div>
                                </li>
								<?php endif; ?>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="brand-section">
                	<div class="bl-title"><h2>找热卖<i></i></h2><!--<a href="" class="more ftx-05">查看更多></a>--></div>
                    <div class="bl-content">
                    	<div class="bd">
                        	<ul>
								<?php $_from = $this->_var['hot_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'hot_goods_0_06168000_1509155613');$this->_foreach['hot_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hot_goods']['total'] > 0):
    foreach ($_from AS $this->_var['hot_goods_0_06168000_1509155613']):
        $this->_foreach['hot_goods']['iteration']++;
?>
								<?php if ($this->_foreach['hot_goods']['iteration'] <= 10): ?>
                            	<li>
                                	<div class="p-img"><a href="<?php echo $this->_var['hot_goods_0_06168000_1509155613']['url']; ?>"><img src="<?php echo $this->_var['hot_goods_0_06168000_1509155613']['thumb']; ?>"></a></div>
                                    <div class="p-price"><?php echo $this->_var['hot_goods_0_06168000_1509155613']['shop_price']; ?></div>
                                    <div class="p-name"><a href="<?php echo $this->_var['hot_goods_0_06168000_1509155613']['url']; ?>"><?php echo $this->_var['hot_goods_0_06168000_1509155613']['short_style_name']; ?></a></div>
                                </li>								
								<?php endif; ?>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<input type="hidden" name="user_id" value="<?php echo empty($this->_var['user_id']) ? '0' : $this->_var['user_id']; ?>">
		<input type="hidden" name="brand_id" value="<?php echo empty($this->_var['brand_id']) ? '0' : $this->_var['brand_id']; ?>">
    </div>
	<?php 
$k = array (
  'name' => 'user_menu_position',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
    <?php echo $this->fetch('library/page_footer.lbi'); ?>
    
    <?php echo $this->smarty_insert_scripts(array('files'=>'jquery.SuperSlide.2.1.1.js,parabola.js,cart_common.js,cart_quick_links.js')); ?>
    <script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/dsc-common.js"></script>
    <script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/jquery.purebox.js"></script>
    <script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/asyLoadfloor.js"></script>
	<script type="text/javascript">
	var length = $(".best-list .bd ul").find("li").length;
	if(length>1){
		$(".best-list").slide({mainCell: '.bd ul',titCell: '.hd ul',effect: 'left',pnLoop: false,vis: 5,scroll: 5,autoPage: '<li></li>'});
	}
	</script>
</body>
</html>
