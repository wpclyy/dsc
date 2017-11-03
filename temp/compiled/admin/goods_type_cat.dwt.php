<?php if ($this->_var['full_page']): ?>
<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title">商品 - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
                    <div class="tabs_info">
            	<ul>
                    <li <?php if ($this->_var['act_type'] == 'manage'): ?>class="curr"<?php endif; ?>><a href="<?php echo $this->_var['action_link2']['href']; ?>"><?php echo $this->_var['action_link2']['text']; ?></a></li>
                    <li <?php if ($this->_var['act_type'] == 'cat_list'): ?>class="curr"<?php endif; ?>><a href="<?php echo $this->_var['action_link1']['href']; ?>"><?php echo $this->_var['action_link1']['text']; ?></a></li>
                </ul>
            </div>	
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                	<li>该页面展示了商城所有的商品类型。</li>
                    <li>每个商品类型下管理不同的商品属性。</li>
                    <li>可以对商品类型进行编辑和删除操作。</li>
                </ul>
            </div>
            <div class="flexilist">
            	<!--商品列表-->
                <div class="common-head">
                    <div class="fl">
                    	<a href="<?php echo $this->_var['action_link']['href']; ?>"><div class="fbutton"><div class="add" title="<?php echo $this->_var['action_link']['text']; ?>"><span><i class="icon icon-plus"></i><?php echo $this->_var['action_link']['text']; ?></span></div></div></a>
                    </div>				
                    <div class="refresh">
                    	<div class="refresh_tit" title="刷新数据"><i class="icon icon-refresh"></i></div>
                    	<div class="refresh_span">刷新 - 共<?php echo $this->_var['record_count']; ?>条记录</div>
                    </div>
                    <form action="javascript:searchUser()" name="searchForm">
                        <div class="search">
                            <div class="input">
                                <input type="text" name="keywords" class="text nofocus w140" placeholder="<?php echo $this->_var['lang']['cat_name']; ?>" autocomplete="off">
                                <input type="submit" value="" class="not_btn" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="common-content">
                    <div class="list-div" id="listDiv">
                        <?php endif; ?>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <?php if ($this->_var['level'] < 3): ?>
                                    <th width="8%"><div class="tDiv">级别(<?php echo $this->_var['lang']['cat_level'][$this->_var['level']]; ?>)</div></th>
                                    <?php endif; ?>
                                    <th width="20%"><div class="tDiv">分类名称</div></th>
                                    <?php if ($this->_var['level'] > 1): ?>
                                    <th width="10%"><div class="tDiv">父级分类</div></th>
                                    <?php endif; ?>
                                    <th width="10%"><div class="tDiv">类型数量</div></th>
                                    <th width="10%"><div class="tDiv">排序</div></th>
                                    <th width="12%" class="handle">操作</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $_from = $this->_var['goods_type_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
                                <tr>
                                    <?php if ($this->_var['level'] < 3): ?>
                                    <td>
                                        <div class="tDiv first_setup">
                                            <div class="setup_span">
                                                <em><i class="icon icon-cog"></i>设置<i class="arrow"></i></em>
                                                <ul>
                                                    <li><a href="goods_type.php?act=cat_add&parent_id=<?php echo $this->_var['cat']['cat_id']; ?>">新增下一级</a></li>
                                                    <li><a href="goods_type.php?act=cat_list&parent_id=<?php echo $this->_var['cat']['cat_id']; ?>&level=<?php echo $this->_var['cat']['level']; ?>">查看下一级</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <?php endif; ?>
                                    <td><div class="tDiv"><a href="goods_type.php?act=manage&cat_id=<?php echo $this->_var['cat']['cat_id']; ?>" class="ftx-01"><?php echo $this->_var['cat']['cat_name']; ?></a></div></td>
                                    <?php if ($this->_var['level'] > 1): ?>
                                    <td><div class="tDiv"><?php echo $this->_var['cat']['parent_name']; ?></div></td>
                                    <?php endif; ?>
                                    <td><div class="tDiv"><?php echo $this->_var['cat']['type_num']; ?></div></td>
                                    <td><div class="tDiv"><input type="text" name="sort_order" class="text w40" value="<?php echo $this->_var['cat']['sort_order']; ?>" onkeyup="listTable.editInput(this, 'edit_sort_order', <?php echo $this->_var['cat']['cat_id']; ?>)"/></div></td>
                                    <td class="handle">
                                        <div class="tDiv a2">
                                            <a href="goods_type.php?act=cat_edit&amp;cat_id=<?php echo $this->_var['cat']['cat_id']; ?>" class="btn_edit"><i class="icon icon-edit"></i>编辑</a>
                                            <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['cat']['cat_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>','remove_cat')" title="<?php echo $this->_var['lang']['remove']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['remove']; ?></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
                                <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>                         
                        </table> 
                        <?php if ($this->_var['full_page']): ?>
                    </div>
                </div>
                <!--商品列表end-->
            </div>
		</div>
	</div>
 	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
	<script type="text/javascript" language="JavaScript">
	  listTable.recordCount = '<?php echo $this->_var['record_count']; ?>';
	  listTable.pageCount = '<?php echo $this->_var['page_count']; ?>';
          listTable.query = 'cat_list_query';

	  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
	  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
	  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            /**
              * 搜索用户
              */
             function searchUser()
             {

                 var frm = $("form[name='searchForm']");
                 listTable.filter['keywords'] = Utils.trim(frm.find("input[name='keywords']").val());

                 listTable.filter['page'] = 1;
                 listTable.loadList();
            }
	</script>
	
</body>
</html>
<?php endif; ?>
