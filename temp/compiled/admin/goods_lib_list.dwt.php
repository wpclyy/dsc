<?php if ($this->_var['full_page']): ?>
<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>
<body class="iframe_body">
	<div class="warpper">
    	<div class="title">商品 - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">		
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                	<li>该页面展示了商品库的所有商品信息，可对商品进行编辑、删除操作。</li>
					<li>可进行批量上传、按店铺导入商品、搜索操作。</li>
                </ul>
            </div>
            <div class="flexilist">
            	<!--商品列表-->
                <div class="common-head">
                    <div class="fl">
						<a href="goods_lib.php?act=add<?php if ($this->_var['code'] == 'virtual_card'): ?>&extension_code=virtual_card<?php endif; ?>"><div class="fbutton"><div class="add" title="添加商品"><span><i class="icon icon-plus"></i>添加商品</span></div></div></a>
                        <a href="goods_lib_batch.php?act=add"><div class="fbutton"><div class="edit" title="批量上传"><span><i class="icon icon-edit"></i>批量上传</span></div></div></a>
						<a href="goods_lib.php?act=import_seller_goods"><div class="fbutton"><div class="edit" title="导入店铺商品"><span><i class="icon icon-edit"></i>导入店铺商品</span></div></div></a>
                    </div>
                    <div class="refresh">
                    	<div class="refresh_tit" title="刷新数据"><i class="icon icon-refresh"></i></div>
                    	<div class="refresh_span">刷新 - 共<?php echo $this->_var['record_count']; ?>条记录</div>
                    </div>
					<div class="search">
                    	<div class="input">
                        	<input type="text" name="keyword" class="text nofocus w140" placeholder="商品名称/商品货号" autocomplete="off">
							<button class="btn" name="secrch_btn"></button>
                        </div>
                    </div>					
                </div>
                <div class="common-content">
					<form method="post" action="" name="listForm" onsubmit="return confirmSubmit(this)">
                    <div class="list-div" id="listDiv">
                    	<?php endif; ?>
                        <div class="flexigrid ht_goods_list<?php if ($this->_var['add_handler']): ?> xn_goods_list<?php endif; ?>">
                    	<table cellpadding="0" cellspacing="0" border="0">
                        	<thead>
                            	<tr>
                                	<th width="3%" class="sign"><div class="tDiv"><input type="checkbox" name="all_list" class="checkbox" id="all_list" /><label for="all_list" class="checkbox_stars"></label></div></th>
                                	<th width="5%" class="sky_id"><div class="tDiv"><a href="javascript:listTable.sort('goods_id');"><?php echo $this->_var['lang']['record_id']; ?></a><?php echo $this->_var['sort_goods_id']; ?></div></th>
                                    <th width="20%"><div class="tDiv"><a href="javascript:listTable.sort('goods_name');"><?php echo $this->_var['lang']['goods_name']; ?></a><?php echo $this->_var['sort_goods_name']; ?></div></th>
									<th width="11%"><div class="tDiv"><?php echo $this->_var['lang']['goods_lib_cat']; ?></div></th>
									<th width="11%"><div class="tDiv"><?php echo $this->_var['lang']['shop_price']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['goods_sn']; ?></div></th>
                                    <th width="6%"><div class="tDiv"><a href="javascript:listTable.sort('sort_order');"><?php echo $this->_var['lang']['sort_order']; ?></a><?php echo $this->_var['sort_sort_order']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['on_sale']; ?></div></th>
									<th width="19%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                            	<tr>
                                    <td class="sign">
                                    <div class="tDiv">
										<input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['goods']['goods_id']; ?>" class="checkbox" id="checkbox_<?php echo $this->_var['goods']['goods_id']; ?>" />
										<label for="checkbox_<?php echo $this->_var['goods']['goods_id']; ?>" class="checkbox_stars"></label>
									</div>
                                    </td>
                                    <td class="sky_id"><div class="tDiv"><?php echo $this->_var['goods']['goods_id']; ?></div></td>
                                    <td>
                                    	<div class="tDiv goods_list_info">
											<div class="img"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="68" height="68" /></div>
                                            <div class="desc">
                                        	<div class="name">
                                                <span onclick="listTable.edit(this, 'edit_goods_name', <?php echo $this->_var['goods']['goods_id']; ?>)" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" data-toggle="tooltip" class="span"><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></span>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="tDiv">
                                            <span class="label"><?php echo $this->_var['goods']['lib_cat_name']; ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="tDiv">
                                            <span class="label"><?php echo $this->_var['goods']['shop_price']; ?></span>
                                        </div>
                                    </td>
                                    <td>
                                    	<div class="tDiv">
											<span><?php echo $this->_var['goods']['goods_sn']; ?></span>
                                    	</div>
                                    </td>
                                    <td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_sort_order', <?php echo $this->_var['goods']['goods_id']; ?>)"><?php echo $this->_var['goods']['sort_order']; ?></span></div></td>
                                    <td>
                                    	<div class="tDiv">
                                        	<div class="switch <?php if ($this->_var['goods']['is_on_sale']): ?>active<?php endif; ?>" title="<?php if ($this->_var['goods']['is_on_sale']): ?>是<?php else: ?>否<?php endif; ?>" onclick="listTable.switchBt(this, 'toggle_on_sale', <?php echo $this->_var['goods']['goods_id']; ?>)">
                                            	<div class="circle"></div>
                                            </div>
                                            <input type="hidden" value="0" name="">
                                        </div>
                                    </td>                                    
								
									<td class="handle">
                                        <div class="tDiv ht_tdiv" style="padding-bottom:0px;">
                                            <p>
                                            	<a href="goods_lib.php?act=edit&goods_id=<?php echo $this->_var['goods']['goods_id']; ?><?php if ($this->_var['code'] != 'real_goods'): ?>&extension_code=<?php echo $this->_var['code']; ?><?php endif; ?>" class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>
                                            	<a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['goods']['goods_id']; ?>, '<?php echo $this->_var['lang']['drop_goods_confirm']; ?>')" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>										
                                            </p>
                                        </div>
                                    </td>
                                </tr>
								<?php endforeach; else: ?>
								<tr><td class="no-records"  colspan="20"><?php echo $this->_var['lang']['no_records']; ?></td></tr>								
								<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                            <tfoot>
                            	<tr>
                                	<td colspan="12">
                                    	<div class="tDiv">
                                            <div class="tfoot_btninfo">
                                                <input type="hidden" name="act" value="batch" />
                                                <!-- 操作类型 start -->
                                                <div class="imitate_select select_w120">
                                                    <div class="cite">请选择</div>
                                                    <ul>
                                                        <li><a href="javascript:changeAction();" data-value="" class="ftx-01"><?php echo $this->_var['lang']['select_please']; ?></a></li>
                                                        <li><a href="javascript:changeAction();" data-value="drop" class="ftx-01"><?php echo $this->_var['lang']['drop']; ?></a></li>
                                                        <li><a href="javascript:changeAction();" data-value="on_sale" class="ftx-01"><?php echo $this->_var['lang']['on_sale']; ?></a></li>
                                                        <li><a href="javascript:changeAction();" data-value="not_on_sale" class="ftx-01"><?php echo $this->_var['lang']['not_on_sale']; ?></a></li>
                                                    </ul>
                                                    <input name="type" type="hidden" value="" id="">
                                                </div>
                                                <!-- 操作类型 end -->
                                                <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" id="btnSubmit" name="btnSubmit" class="btn btn_disabled" disabled="true" ectype="btnSubmit" />				
                                            </div>
                                            <div class="list-page">
                                               <?php echo $this->fetch('library/page.lbi'); ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        <?php if ($this->_var['full_page']): ?>
                    </div>
					</form>
                </div>
                <!--商品列表end-->
            </div>
		</div>
	</div>
	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
    
    <?php echo $this->smarty_insert_scripts(array('files'=>'jquery.purebox.js')); ?>
    
    
	<script type="text/javascript">
	listTable.recordCount = '<?php echo $this->_var['record_count']; ?>';
	listTable.pageCount = '<?php echo $this->_var['page_count']; ?>';
	
	<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
	listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	/* 起始页通过商品一览点击进入自营/商家商品判断条件 */
	listTable.filter.self = '<?php echo $this->_var['self']; ?>';
	listTable.filter.merchants = '<?php echo $this->_var['merchants']; ?>';
	
	function movecatList(val, level)
	{
		var cat_id = val;
		document.getElementById('target_cat').value = cat_id;
		Ajax.call('goods.php?is_ajax=1&act=sel_cat_goodslist', 'cat_id='+cat_id+'&cat_level='+level, movecatListResponse, 'GET', 'JSON');
	}

	function movecatListResponse(result)
	{
		if (result.error == '1' && result.message != '')
		{
			alert(result.message);
			return;
		}
		
		var response = result.content;
		var cat_level = result.cat_level;
		
		for(var i=cat_level;i<10;i++)
		{
			$("#move_cat_list"+Number(i+1)).remove();
		}
		
		if(response)
		{
			$("#move_cat_list"+cat_level).after(response);
		}
		
		return;
	}

	onload = function()
	{
		document.forms['listForm'].reset();
	}

	/**
	* @param: bool ext 其他条件：用于转移分类
	*/
	function confirmSubmit(frm, ext)
	{
		if (frm.elements['type'].value == 'trash')
		{
			return confirm(batch_trash_confirm);
		}
		else if (frm.elements['type'].value == 'not_on_sale')
		{
			return confirm(batch_no_on_sale);
		}
		else if (frm.elements['type'].value == 'move_to')
		{
			ext = (ext == undefined) ? true : ext;
			return ext && document.getElementById('target_cat').value != 0;
		}
		else if (frm.elements['type'].value == '')
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function changeAction()
	{
		var frm = document.forms['listForm'];
	
		// 切换分类列表的显示
		$("#move_cat_list").css({'display':frm.elements['type'].value == 'move_to' ? '' : 'none'});
	
		// 切换商品审核列表的显示
		$("#review_status").css({'display':frm.elements['type'].value == 'review_to' ? '' : 'none'});
	
		if(frm.elements['type'].value != 'review_to'){
			frm.elements['review_content'].style.display = 'none';
		}
	
		// 供应商列表的显示
		<?php if ($this->_var['suppliers_list'] > 0): ?>
			$("#suppliers_id").css({'display':frm.elements['type'].value == 'suppliers_move_to' ? '' : 'none'});
		<?php endif; ?>
	}
	  
	//ecmoban模板堂 --zhuo  start
	function get_review_status(){
		var frm = document.forms['listForm'];
		
		if(frm.elements['type'].value == 'review_to'){
			if(frm.elements['review_status'].value == 2){
				frm.elements['review_content'].style.display = '';
			}else{
				frm.elements['review_content'].style.display = 'none';
			}
		}else{
			frm.elements['review_content'].style.display = 'none';
		}
	}
	//ecmoban模板堂 --zhuo  end
	
	//展开其他属性
	function trigger(obj){
		var _this = $(obj);
		var parenttr = _this.parents('tr');
		var tip = parenttr.siblings().find('.tip');
		if(_this.hasClass('icon-down')){
			_this.removeClass('icon-down');
			parenttr.next().hide();
		}else{
			_this.addClass('icon-down');
			parenttr.next().show();
			tip.removeClass('icon-down');
			tip.parents('tr').next().hide();
		}
	}
	  
	//仓库库存修改弹出框
	$(document).on('click',"*[ectype='dialog']",function(){
		var url =$(this).data('url');
		var title = $(this).attr('title');
		Ajax.call(url,'',dsc_warehouse, 'POST', 'JSON');
		function dsc_warehouse(result){
			pb({
				id:"tipDialog",
				title:title,
				content:result.content,
				drag:false,
				ok_title:"确定",
				cl_title:"取消"
			});
		}
	});
	
	//单选勾选
	function get_ajax_act(t, goods_id, act, FileName){
		
		if(t.checked == false){
			t.value = 0;
		}
		
		Ajax.call(FileName + '.php?act=' + act, 'id=' + goods_id + '&val=' + t.value, act_response, 'POST', 'JSON');
	}
	
	function act_response(result){}
	
	function dropWarehouse(w_id)
	{
		Ajax.call('goods.php?is_ajax=1&act=drop_warehouse', "w_id="+w_id, dropWarehouseResponse, "GET", "JSON");
	}
	
	function dropWarehouseResponse(result)
	{
		if (result.error == 0)
		{
		  document.getElementById('warehouse_' + result.content).style.display = 'none';
		}
	}
	
	function dropWarehouseArea(a_id)
	{
		Ajax.call('goods.php?is_ajax=1&act=drop_warehouse_area', "a_id="+a_id, dropWarehouseAreaResponse, "GET", "JSON");
	}
	
	function dropWarehouseAreaResponse(result)
	{
		if (result.error == 0)
		{
		  document.getElementById('warehouse_area_' + result.content).style.display = 'none';
		}
	}
	
	//仓库/地区价格 start
	$(document).on("click","input[name='goods_model_price']",function(){
		var goods_id = $(this).data("goodsid");
		
		$.jqueryAjax('dialog.php', 'act=add_goods_model_price' + '&goods_id=' + goods_id, function(data){
			var content = data.content;
			pb({
				id:"categroy_dialog",
				title:"仓库/地区价格",
				width:864,
				content:content,
				ok_title:"确定",
				cl_title:"取消",
				drag:true,
				foot:false
			});
		});
	});
	//仓库/地区价格 end
	
	//SKU/库存 start
	$(document).on("click","a[ectype='add_sku']",function(){
		
		var goods_id = $(this).data('goodsid');
		var user_id = $(this).data('userid');
		
		$.jqueryAjax('dialog.php', 'act=add_sku' + '&goods_id=' + goods_id + '&user_id=' + user_id, function(data){
			var content = data.content;
			pb({
				id:"categroy_dialog",
				title:"编辑商品货品信息",
				width:863,
				content:content,
				ok_title:"确定",
				cl_title:"取消",
				drag:true,
				foot:false
			});
		});
	});
	
	//SKU/库存 start
	$(document).on("click","a[ectype='add_attr_sku']",function(){
		
		var goods_id = $(this).data('goodsid');
		var product_id = $(this).data('product');
		
		$.jqueryAjax('dialog.php', 'act=add_attr_sku' + '&goods_id=' + goods_id + '&product_id=' + product_id, function(data){
			var content = data.content;
			pb({
				id:"attr_sku_dialog",
				title:"编辑商品货品价格",
				width:563,
				content:content,
				ok_title:"确定",
				cl_title:"取消",
				drag:true,
				foot:true,
				onOk:function(){
					if(data.method){
						insert_attr_warehouse_area_price(data.method);
					}
				}
			});
		});
	});
	
	function insert_attr_warehouse_area_price(method){
		var actionUrl = "dialog.php?act=" + method;  
		$("#warehouseForm").ajaxSubmit({
				type: "POST",
				dataType: "JSON",
				url: actionUrl,
				data: {"action": "TemporaryImage"},
				success: function (data) {
				},
				async: true  
		 });
	}
	
	//商品审核 start
	$(document).on("click","a[ectype='review_status']",function(){
		
		var goods_name = $(this).data('goodsname');
		var goods_id = $(this).data('goodsid');
		var type = $(this).data('type');
		
		var content  = 	'<form id="reviewForm" enctype="multipart/form-data" method="post" action="dialog.php?act=update_review_status">' +
						'<div class="item fl" style="padding:20px 0px 10px; width:333px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">' +
							'商品名称：<em title="' + goods_name + '">' + goods_name + '</em>' +
						'</div>' +
						'<div class="item fl" style="width:333px">' +
							'<div class="fl" style="padding-top:9px">商品审核：</div>' +
							'<div class="checkbox_items" style="padding-top:10px; width:80%">' +
								'<div class="checkbox_item">' + 
									'<input name="review_status" class="ui-radio review_status" id="pro_no" value="1" checked="checked" type="radio" onclick="handleReviewStatus(this);">' +
									'<label for="pro_no" class="ui-radio-label">未审核</label>' +
								'</div>' +
								'<div class="checkbox_item">' + 
									'<input name="review_status" class="ui-radio review_status" id="pro_no" value="3" checked="checked" type="radio" onclick="handleReviewStatus(this);">' +
									'<label for="pro_no" class="ui-radio-label">审核通过</label>' +
								'</div>' +
								'<div class="checkbox_item mr15">' +
									'<input name="review_status" class="ui-radio review_status" id="pro_yes" value="2" type="radio" onclick="handleReviewStatus(this);">' + 
									'<label for="pro_yes" class="ui-radio-label">审核未通过</label> ' +
								'</div>' +
							'</div>' +
						'</div>' +
						'<div class="item fl hide" id="review_content" style="padding:20px 0px; width:333px">' +
							'<textarea name="review_content" value="" cols="60" rows="4" class="textarea"></textarea>' +
						'</div>' +
						'<input name="goods_id" type="hidden" value="' + goods_id + '">' + 
						'<input name="type" type="hidden" value="' + type + '">' + 
						'</form>';
		pb({
			id:"review_status_dialog",
			title:"商品审核",
			width:403,
			content:content,
			ok_title:"确定",
			cl_title:"取消",
			drag:true,
			foot:true,
			onOk:function(){
				insert_review_status();
			}
		});
	});
	
	function insert_review_status(){
		var actionUrl = "dialog.php?act=update_review_status";  
		$("#reviewForm").ajaxSubmit({
				type: "POST",
				dataType: "JSON",
				url: actionUrl,
				data: {"action": "TemporaryImage"},
				success: function (data) {
					location.href = "goods.php?act=review_status&type=" + data.type;
				},
				async: true  
		 });
	}
	
	function handleReviewStatus(t){
		if(t.value == 2){
			$("#review_content").show();
		}else{
			$("#review_content").hide();
			$(":input[name='review_content']").val('');
		}
	}
	//商品审核 end
	</script>
    
</body>
</html>
<?php endif; ?>
