
<?php if ($this->_var['best_goods']): ?>
<div class="mc-main" style="display:block;">
	<div class="mcm-left">
		<div class="spirit"></div>
		<?php $_from = $this->_var['best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_03883200_1509155617');$this->_foreach['best'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['best']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_03883200_1509155617']):
        $this->_foreach['best']['iteration']++;
?>
		<div class="rank-number rank-number<?php echo $this->_foreach['best']['iteration']; ?>"><?php echo $this->_foreach['best']['iteration']; ?></div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</div>
	<div class="mcm-right">
		<ul>
			<?php $_from = $this->_var['best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_03889800_1509155617');$this->_foreach['best'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['best']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_03889800_1509155617']):
        $this->_foreach['best']['iteration']++;
?>
			<li>
				<div class="p-img"><a href="<?php echo $this->_var['goods_0_03889800_1509155617']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods_0_03889800_1509155617']['name']); ?>"><img src="<?php echo $this->_var['goods_0_03889800_1509155617']['thumb']; ?>" width="130" height="130"></a></div>
				<div class="p-name"><a href="<?php echo $this->_var['goods_0_03889800_1509155617']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods_0_03889800_1509155617']['name']); ?>"><?php echo $this->_var['goods_0_03889800_1509155617']['short_style_name']; ?></a></div>
				<div class="p-price">
					<?php if ($this->_var['goods_0_03889800_1509155617']['promote_price'] != ''): ?>
						<?php echo $this->_var['goods_0_03889800_1509155617']['promote_price']; ?>
					<?php else: ?>
						<?php echo $this->_var['goods_0_03889800_1509155617']['shop_price']; ?>
					<?php endif; ?>
				</div>
			</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</ul>
	</div>
</div>
<?php endif; ?> 