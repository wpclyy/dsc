<div class="categorys-items" id="cata-nav">
    <?php $_from = $this->_var['categories_pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat_0_45089700_1509500261');$this->_foreach['categories_pro'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['categories_pro']['total'] > 0):
    foreach ($_from AS $this->_var['cat_0_45089700_1509500261']):
        $this->_foreach['categories_pro']['iteration']++;
?>
    <?php if (($this->_foreach['categories_pro']['iteration'] - 1) < $this->_var['nav_cat_num']): ?>
    <div class="categorys-item<?php if ($this->_var['nav_cat_model']): ?> nav_cat_model<?php endif; ?>" ectype="cateItem" data-id="<?php echo $this->_var['cat_0_45089700_1509500261']['id']; ?>" data-eveval="0">
        <div class="item item-content">
            <?php if ($this->_var['cat_0_45089700_1509500261']['style_icon'] == 'other'): ?>
            <?php if ($this->_var['cat_0_45089700_1509500261']['cat_icon']): ?><div class="icon-other"><img src="<?php echo $this->_var['cat_0_45089700_1509500261']['cat_icon']; ?>" alt="分类图标"></div><?php endif; ?>
            <?php else: ?>
            <i class="iconfont icon-<?php echo $this->_var['cat_0_45089700_1509500261']['style_icon']; ?>"></i>
            <?php endif; ?>
            <div class="categorys-title">
                <strong>
                <?php if ($this->_var['cat_0_45089700_1509500261']['category_link'] == 1): ?>
                <?php echo $this->_var['cat_0_45089700_1509500261']['name']; ?>
                <?php else: ?>
                <a href="<?php echo $this->_var['cat_0_45089700_1509500261']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['cat_0_45089700_1509500261']['name']); ?></a>
                <?php endif; ?>
                </strong>
                <?php if (! $this->_var['nav_cat_model']): ?>
                <span>
                    <?php $_from = $this->_var['cat_0_45089700_1509500261']['child_two']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_two_0_45115600_1509500261');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['child_two_0_45115600_1509500261']):
        $this->_foreach['name']['iteration']++;
?>
                    <?php if (($this->_foreach['name']['iteration'] - 1) < 2): ?>
                    <a href="<?php echo $this->_var['child_two_0_45115600_1509500261']['url']; ?>" target="_blank"><?php echo $this->_var['child_two_0_45115600_1509500261']['cat_name']; ?></a>
                    <?php endif; ?>	
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="categorys-items-layer" ectype="cateLayer">
            <div class="cate-layer-con clearfix">
                <div class="cate-layer-left">
                    <div class="cate_channel" ectype="channels_<?php echo $this->_var['cat_0_45089700_1509500261']['id']; ?>"></div>
                    <div class="cate_detail" ectype="subitems_<?php echo $this->_var['cat_0_45089700_1509500261']['id']; ?>"></div>
                </div>
                <div class="cate-layer-rihgt" ectype="brands_<?php echo $this->_var['cat_0_45089700_1509500261']['id']; ?>"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>