
<?php if ($this->_var['type'] == 'topic'): ?>  
<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
<li>
    <div class="img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_img']; ?>"></a></div>
    <div class="info">
        <div class="name"><a href="<?php echo $this->_var['goods']['url']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a></div>
            <div class="price">
                    <?php if ($this->_var['goods']['promote_price'] != ''): ?>
                        <?php echo $this->_var['goods']['promote_price']; ?>
                    <?php else: ?>
                        <?php echo $this->_var['goods']['shop_price']; ?>
                    <?php endif; ?>
            </div>
        <div class="btn_hover"><a href="<?php echo $this->_var['goods']['url']; ?>">立即购买</a></div>
    </div>
</li>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

<?php elseif ($this->_var['type'] == 'seller'): ?>
<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
<li>
        <div class="img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_img']; ?>"></a></div>
        <div class="info">
            <div class="name"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a></div>
            <div class="price">
                    <?php if ($this->_var['goods']['promote_price'] != ''): ?>
                        <?php echo $this->_var['goods']['promote_price']; ?>
                    <?php else: ?>
                        <?php echo $this->_var['goods']['shop_price']; ?>
                    <?php endif; ?>
            </div>
            <div class="btn_hover"><a href="<?php echo $this->_var['goods']['url']; ?>">立即购买</a></div>
        </div>
    </li>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php else: ?>
<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
<li class="opacity_img">
    <a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank">
        <div class="p-img"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>"></div>
        <div class="p-name" title="<?php echo $this->_var['goods']['goods_name']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></div>
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
    </a>
</li>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php endif; ?>
