<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="<?php echo $this->_var['action_link']['href']; ?>" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                	<li>标识“<em>*</em>”的选项为必填项，其余为选填项。</li>
                    <li>请按提示文案正确填写信息。</li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-content">
                    <div class="mian-info">
                        <form action="attribute.php" method="post" name="theForm" enctype="multipart/form-data" id="attribute_form">
                            <div class="switch_info">
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?><?php echo $this->_var['lang']['label_attr_name']; ?></div>
                                    <div class="label_value">
										<input type='text' name='attr_name' value="<?php echo $this->_var['attr']['attr_name']; ?>" size='30' class="text" autocomplete="off" />
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?><?php echo $this->_var['lang']['label_cat_id']; ?></div>
                                    <div class="label_value">
										<div class="imitate_select select_w170">
											<div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
											<ul style="display: none;">
												<?php echo $this->_var['goods_type_list']; ?>
											</ul>
											<input name="cat_id" type="hidden" value="<?php echo $this->_var['attr']['cat_id']; ?>">
										</div>										
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>								
                                <div class="item" id="attrGroups" style="display:none">
                                    <div class="label"><?php echo $this->_var['lang']['label_attr_group']; ?></div>
                                    <div class="label_value">
										<?php if ($this->_var['attr_groups']): ?>
										<div class="imitate_select select_w170">
											<div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
											<ul style="display: none;">
                                            	<li><a data-value="-1"><?php echo $this->_var['lang']['select_please']; ?></a></li>
												<?php $_from = $this->_var['attr_groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
													<li><a data-value="<?php echo $this->_var['key']; ?>"><?php echo $this->_var['item']; ?></a></li>
												<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
											</ul>
											<input name="attr_group" type="hidden" value="<?php echo $this->_var['attr']['attr_group']; ?>">
										</div>										
                                        <div class="form_prompt"></div>
										<?php endif; ?>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label">分类筛选样式：</div>
                                    <div class="label_value">
                                        <div class="checkbox_items">
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="attr_cat_type" id="attr_cat_type_0" value="0" <?php if ($this->_var['attr']['attr_cat_type'] == 0): ?> checked="true" <?php endif; ?>  />
                                                <label for="attr_cat_type_0" class="ui-radio-label">普通</label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="attr_cat_type" id="attr_cat_type_1" value="1" <?php if ($this->_var['attr']['attr_cat_type'] == 1): ?> checked="true" <?php endif; ?>  />
                                                <label for="attr_cat_type_1" class="ui-radio-label">颜色</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>								
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['label_attr_index']; ?></div>
                                    <div class="label_value">
                                        <div class="checkbox_items">
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="attr_index" id="attr_index_0" value="0" <?php if ($this->_var['attr']['attr_index'] == 0): ?> checked="true" <?php endif; ?>  />
                                                <label for="attr_index_0" class="ui-radio-label"><?php echo $this->_var['lang']['no_index']; ?></label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="attr_index" id="attr_index_1" value="1" <?php if ($this->_var['attr']['attr_index'] == 1): ?> checked="true" <?php endif; ?>  />
                                                <label for="attr_index_1" class="ui-radio-label"><?php echo $this->_var['lang']['keywords_index']; ?></label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="attr_index" id="attr_index_2" value="2" <?php if ($this->_var['attr']['attr_index'] == 2): ?> checked="true" <?php endif; ?>  />
                                                <label for="attr_index_2" class="ui-radio-label"><?php echo $this->_var['lang']['range_index']; ?></label>
                                            </div>											
                                        </div>
										<div class="noict bf100" id="noticeindex"><?php echo $this->_var['lang']['note_attr_index']; ?></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['label_is_linked']; ?></div>
                                    <div class="label_value">
                                        <div class="checkbox_items">
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="is_linked" id="is_linked_0" value="0" <?php if ($this->_var['attr']['is_linked'] == 0): ?> checked="true" <?php endif; ?>  />
                                                <label for="is_linked_0" class="ui-radio-label"><?php echo $this->_var['lang']['no']; ?></label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="is_linked" id="is_linked_1" value="1" <?php if ($this->_var['attr']['is_linked'] == 1): ?> checked="true" <?php endif; ?>  />
                                                <label for="is_linked_1" class="ui-radio-label"><?php echo $this->_var['lang']['yes']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['label_attr_type']; ?>：</div>
                                    <div class="label_value">
                                        <div class="checkbox_items">
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="attr_type" id="attr_type_0" value="0" <?php if ($this->_var['attr']['attr_type'] == 0): ?> checked="true" <?php endif; ?>  />
                                                <label for="attr_type_0" class="ui-radio-label"><?php echo $this->_var['lang']['attr_type_values']['0']; ?></label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="attr_type" id="attr_type_1" value="1" <?php if ($this->_var['attr']['attr_type'] == 1): ?> checked="true" <?php endif; ?>  />
                                                <label for="attr_type_1" class="ui-radio-label"><?php echo $this->_var['lang']['attr_type_values']['1']; ?></label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="attr_type" id="attr_type_2" value="2" <?php if ($this->_var['attr']['attr_type'] == 2): ?> checked="true" <?php endif; ?>  />
                                                <label for="attr_type_2" class="ui-radio-label"><?php echo $this->_var['lang']['attr_type_values']['2']; ?></label>
                                            </div>											
                                        </div>
										<p class="fl bf100"><label class="blue_label ml0" id="noticeAttrType"><?php echo $this->_var['lang']['note_attr_type']; ?></label></p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['label_attr_input_type']; ?></div>
                                    <div class="label_value">
                                        <div class="checkbox_items">
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="attr_input_type" id="attr_input_type_0" value="0" <?php if ($this->_var['attr']['attr_input_type'] == 0): ?> checked="true" <?php endif; ?>  />
                                                <label for="attr_input_type_0" class="ui-radio-label"><?php echo $this->_var['lang']['text']; ?></label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="attr_input_type" id="attr_input_type_1" value="1" <?php if ($this->_var['attr']['attr_input_type'] == 1): ?> checked="true" <?php endif; ?>  />
                                                <label for="attr_input_type_1" class="ui-radio-label"><?php echo $this->_var['lang']['select']; ?></label>
                                            </div>
                                            <div class="checkbox_item hide">
                                                <input type="radio" class="ui-radio" name="attr_input_type" id="attr_input_type_2" value="2" <?php if ($this->_var['attr']['attr_input_type'] == 2): ?> checked="true" <?php endif; ?>  />
                                                <label for="attr_input_type_2" class="ui-radio-label"><?php echo $this->_var['lang']['text_area']; ?></label>
                                            </div>											
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['label_attr_values']; ?></div>
                                    <div class="label_value">
										<textarea name="attr_values" cols="30" rows="5" class="textarea h120"><?php echo $this->_var['attr']['attr_values']; ?></textarea>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['sort_order']; ?>：</div>
                                    <div class="label_value">
										<input type='text' name='sort_order' value="<?php echo $this->_var['attr']['sort_order']; ?>" size='30' class="text" autocomplete="off" />
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>		
                                
                                <?php if ($this->_var['attr']['attr_cat_type'] == 1): ?>
                                <div class="item">
                                    <div class="label">&nbsp;</div>
                                    <div class="label_value">
                                        <a href="attribute.php?act=set_gcolor&attr_id=<?php echo $this->_var['attr']['attr_id']; ?>" class="org"><?php echo $this->_var['lang']['add_attribute_color']; ?></a>
                                    </div>
                                </div>		
                                <?php endif; ?>	
                                					
                                <div class="item">
                                    <div class="label">&nbsp;</div>
                                    <div class="label_value info_btn">
										<input type="hidden" name="act" value="<?php echo $this->_var['form_act']; ?>" />
										<input type="hidden" name="attr_id" value="<?php echo $this->_var['attr']['attr_id']; ?>" />		
										<input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" id="submitBtn"/>
										<input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button button_reset" />
                                    </div>
                                </div>								
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
    </div>
 <?php echo $this->fetch('library/pagefooter.lbi'); ?>
	
	<script language="JavaScript">
	<!--
	onload = function()
	{
		
		  onChangeGoodsType(<?php echo $this->_var['attr']['cat_id']; ?>);
		
	}
	
	$(function(){
		//表单验证
		$("#submitBtn").click(function(){
			if($("#attribute_form").valid()){
				$("#attribute_form").submit();
			}
		});
	
		$('#attribute_form').validate({
			errorPlacement:function(error, element){
				var error_div = element.parents('div.label_value').find('div.form_prompt');
				element.parents('div.label_value').find(".notic").hide();
				error_div.append(error);
			},
			rules:{
				attr_name:{
					required : true
				}
			},
			messages:{
				attr_name:{
					required : '<i class="icon icon-exclamation-sign"></i>属性名称不能为空'
				}
			}			
		});
		
		//属性值录入方式切换
		$("input[name='attr_input_type']").click(function(){
			var val = $(this).val();
			if(val != 1){
				$("textarea[name='attr_values']").attr("disabled",true);
			}else{
				$("textarea[name='attr_values']").attr("disabled",false);
			}
		});
		
		if($("#attr_input_type_0").is(":checked")){
			$("textarea[name='attr_values']").attr("disabled",true);
		}
	});	
	
	/**
	 * 改变商品类型的处理函数
	 */
	function onChangeGoodsType(catId)
	{
	  Ajax.call('attribute.php?act=get_attr_groups&cat_id=' + catId, '', changeGoodsTypeResponse, 'GET', 'JSON');
	}

	function changeGoodsTypeResponse(res)
	{
	  if (res.error == 0)
	  {
		var row = document.getElementById('attrGroups');
		if (res.content.length == 0) {
		  row.style.display = 'none';
		} else {
		  row.style.display = document.all ? 'block' : 'table-row';

		  var sel = document.forms['theForm'].elements['attr_group'];

		  sel.length = 0;

		  for (var i = 0; i < res.content.length; i++)
		  {
			var opt = document.createElement('OPTION');
			opt.value = i;
			opt.text = res.content[i];
			sel.options.add(opt);
			if (i == '<?php echo $this->_var['attr']['attr_group']; ?>')
			{
			  opt.selected=true;
			}
		  }
		}
	  }

	  if (res.message)
	  {
		alert(res.message);
	  }
	}
	</script>
	
</body>
</html>
