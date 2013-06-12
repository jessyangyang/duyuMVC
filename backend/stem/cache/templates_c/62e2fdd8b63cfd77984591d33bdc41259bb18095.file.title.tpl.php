<?php /* Smarty version Smarty-3.1.12, created on 2013-06-06 11:02:19
         compiled from "/home/wwwroot/duyuMVC/ATSystem/stem/application/views/writer/title.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49326199851affbbb5b5497-29246193%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62e2fdd8b63cfd77984591d33bdc41259bb18095' => 
    array (
      0 => '/home/wwwroot/duyuMVC/ATSystem/stem/application/views/writer/title.tpl',
      1 => 1370314197,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49326199851affbbb5b5497-29246193',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
    'category' => 0,
    'item' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51affbbba6dff1_11175553',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51affbbba6dff1_11175553')) {function content_51affbbba6dff1_11175553($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("writer/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("writer/progress.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
		
		<div class="container">
			<div class="edit-box">
				<h2>录入的信息包括全本作品的名称、作者、体裁以及作品标签。</h2>
				<div id="edit-box" class="edit-info">
					<form class="form-horizontal" action="/writer/title" method="POST">
					<fieldset>
					<div class="control-group">
					<label class="control-label" for="">作品名称：</label>
					<div class="controls">
						<input type="text" class="span5" name="title" <?php if (isset($_smarty_tpl->tpl_vars['info']->value['title'])){?>value="<?php echo $_smarty_tpl->tpl_vars['info']->value['title'];?>
"<?php }?>/>
					</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="">作者名称：</label>
					<div class="controls">
					<input type="text" class="span5" name="author"  <?php if (isset($_smarty_tpl->tpl_vars['info']->value['author'])){?>value="<?php echo $_smarty_tpl->tpl_vars['info']->value['author'];?>
"<?php }?>/>
					</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="">作品体裁：</label>
					<div class="controls">
					<?php if (isset($_smarty_tpl->tpl_vars['category']->value)){?>
						<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['category']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
	              		<label class="radio inline">
	                	<input type="radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['cid'];?>
" id="optionRadio<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" name="category" <?php if (isset($_smarty_tpl->tpl_vars['info']->value['cid'])&&$_smarty_tpl->tpl_vars['info']->value['cid']==$_smarty_tpl->tpl_vars['item']->value['cid']){?>checked<?php }?>/> <?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</label>
	                	<?php } ?>
	                <?php }?>
	            	</div>
	            	</div>
	            	<div class="control-group">
	            	<label class="control-label" for="">作品标签：</label>
	            	<div class="controls">
					<input type="text" class="span5" name="tags" placeholder="多个标签用空格隔开，如'建筑 哥特式风格 罗马'" <?php if (isset($_smarty_tpl->tpl_vars['info']->value['tags'])){?>value="<?php echo $_smarty_tpl->tpl_vars['info']->value['tags'];?>
"<?php }?>/>
					<input type="hidden" value="title" name="state"/>
					</div>
					</div>
					</div>
					</fieldset>
					</form>
				</div>
			</div>
		</div>
<?php echo $_smarty_tpl->getSubTemplate ("writer/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>