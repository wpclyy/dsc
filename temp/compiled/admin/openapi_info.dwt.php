<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="<?php echo $this->_var['action_link']['href']; ?>" class="s-back"><?php echo $this->_var['lang']['back']; ?></a>接口管理 - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
                <ul>
                	<li>设置商城对外接口配置的信息。</li>
                    <li>标识“<em>*</em>”的选项为必填项，其余为选填项。</li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-content">
                    <div class="mian-info">
                        <form action="open_api.php" method="post" name="theForm" enctype="multipart/form-data" id="oss_configure_form">
                            <div class="switch_info">
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>用户名称：</div>
                                    <div class="label_value">
										<input type='text' name='name' value='<?php echo htmlspecialchars($this->_var['api']['name']); ?>' size='55' class="text" />
                                   		<div class="form_prompt"></div>
                                        <div class="notic"></div>	
                                    </div>
                                </div>						
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>AppKey：</div>
                                    <div class="label_value">
										<input type='text' name='app_key' value='<?php echo htmlspecialchars($this->_var['api']['app_key']); ?>' size='55' class="text" />
                                        <div class="form_prompt"></div>
                                        <div class="notic"><input name="AppKeyAuto" class="btn btn25 blue_btn" value="自动生成AppKey" type="button"></div>	
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label">是否开启：</div>
                                    <div class="label_value">
                                        <div class="checkbox_items">
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="is_open" id="is_open_0" value="0" <?php if ($this->_var['api']['is_open'] == 0): ?> checked="true" <?php endif; ?>  />
                                                <label for="is_open_0" class="ui-radio-label">关闭</label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="is_open" id="is_open_1" value="1" <?php if ($this->_var['api']['is_open'] == 1): ?> checked="true" <?php endif; ?>  />
                                                <label for="is_open_1" class="ui-radio-label">开启</label>
                                            </div>
                                        </div>	
                                    </div>
                                </div>																
                            </div>
                            <div class="switch_info business_info" style="background:none;">  
								<?php $_from = $this->_var['api_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                                <div class="step">
                                    <div class="tit">
                                        <div class="checkbox_items">
                                            <div class="checkbox_item">
                                                <input type="checkbox" name="chkGroup" value="checkbox" class="ui-checkbox" id="chkGroup_<?php echo $this->_var['list']['cat']; ?>" />
                                                <label for="chkGroup_<?php echo $this->_var['list']['cat']; ?>" class="ui-label blod"><?php echo $this->_var['list']['name']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="qx_items">
                                        <div class="qx_item">
                                            <div class="checkbox_items">
												<?php $_from = $this->_var['list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');if (count($_from)):
    foreach ($_from AS $this->_var['child']):
?>
                                                <div class="checkbox_item">
                                                    <input type="checkbox" value="<?php echo $this->_var['child']['val']; ?>" name="action_code[]" <?php if ($this->_var['child']['is_check']): ?>checked="true"<?php endif; ?> class="ui-checkbox" id="<?php echo $this->_var['child']['val']; ?>" date="<?php echo $this->_var['list']['cat']; ?>" />
                                                    <label for="<?php echo $this->_var['child']['val']; ?>" class="ui-label"><?php echo $this->_var['child']['name']; ?></label>
                                                </div>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </div>
						    <div class="switch_info">	
								<div class="item">
                                    <div class="label">&nbsp;</div>
                                    <div class="label_value info_btn">
										<input type="hidden" name="id" value="<?php echo $this->_var['api']['id']; ?>" />
										<input class="button" type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" id="submitBtn" />
										<input class="button button_reset" type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
										<input type="hidden" name="act" value="<?php echo $this->_var['form_act']; ?>" />
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
	
	<script language="javascript">
		
		$(function(){
			var name = $(":input[name='name']").val();
			$(":input[name='AppKeyAuto']").click(function(){
				Ajax.call('open_api.php?is_ajax=1&act=app_key', 'name=' + name, AppKeyResponse, "GET", "JSON");
			});
		});
		
		function AppKeyResponse(result){
			$(":input[name='app_key']").val(result.app_key);
		}
		
        $("#checkall").click(function(){
			var checkbox = $(this).parents(".switch_info").find('input:checkbox[type="checkbox"]');
			if($(this).prop("checked") == true){
				checkbox.prop("checked",true);
			}else{
				checkbox.prop("checked",false);
			}
        });
		
		$("input[name='chkGroup']").click(function(){
			var checkbox = $(this).parents(".tit").next(".qx_items").find('input:checkbox[type="checkbox"]');
			if($(this).prop("checked") == true){
				checkbox.prop("checked",true);
			}else{
				checkbox.prop("checked",false);
			}
		});
		
		$("input[name='action_code[]']").click(function(){    
			var qx_items = $(this).parents(".qx_items");
			var length = qx_items.find("input[name='action_code[]']").length;
			var length2 =  qx_items.find("input[name='action_code[]']:checked").length;
			if(length == length2){
				qx_items.prev().find("input[name='chkGroup']").prop("checked",true);
			}else{
				qx_items.prev().find("input[name='chkGroup']").prop("checked",false);
			}
        });
		
		$(".qx_items").each(function(index, element) {
            var length = $(this).find("input[name='action_code[]']").length;
			var length2 = $(this).find("input[name='action_code[]']:checked").length;
			
			if(length == length2){
				$(this).prev().find("input[name='chkGroup']").prop("checked",true);
			}else{
				$(this).prev().find("input[name='chkGroup']").prop("checked",false);
			}
        });
    </script>
	
</body>
</html>
