<div class="tabs_info">
    <ul>
        <li <?php if ($this->_var['menu_select']['current'] == '02_merchants_users_list'): ?>class="curr"<?php endif; ?>>
            <a href="merchants_users_list.php?act=list">店铺列表</a>
        </li>
        <li <?php if ($this->_var['menu_select']['current'] == '16_seller_users_real'): ?>class="curr"<?php endif; ?>>
            <a href="user_real.php?act=list&user_type=1">实名认证</a>
        </li>
        <li <?php if ($this->_var['menu_select']['current'] == '11_seller_apply'): ?>class="curr"<?php endif; ?>>
            <a href="seller_apply.php?act=list">店铺申请等级</a>
        </li>
    </ul>
</div>	