<?php /* Smarty version Smarty-3.1.12, created on 2013-01-26 02:50:24
         compiled from "/home/wwwroot/duyuMVC/ATSystem/stem/application/views/ats/title.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13521738205102b0a4896cb7-19353022%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd4af6e192a263756d92b1268eead892209f8d66' => 
    array (
      0 => '/home/wwwroot/duyuMVC/ATSystem/stem/application/views/ats/title.tpl',
      1 => 1359139822,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13521738205102b0a4896cb7-19353022',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5102b0a4916c44_13195066',
  'variables' => 
  array (
    'info' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5102b0a4916c44_13195066')) {function content_5102b0a4916c44_13195066($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("ats/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<body>
		<header>
			<div class="right-tools">
				<a href="">主页</a>
				<a href="">帮助</a>
				<a href="">设置</a>
			</div>
			<a href="" class="btn btn-danger right-button">下一步：撰写导言</a>
			<div class="header-nav">
				<h1>投稿系统</h1>
				<div class="p-bar">
					<div class='red-point'></div>
					<div class="progress">
						<div class="bar" style="width: 0%"></div>
					</div>
				</div>
				<ul class="inline">
					<li>基本信息</li>
					<li>文章录入</li>
					<li>封面设计</li>
					<li>撰写导言</li>
				</ul>
			</div>
		</header>
		
		<div class="container">
			<div class="edit-box">
				<h2>录入的信息包括全本作品的名称、作者、体裁以及作品标签。</h2>
				<div id="edit-box" class="edit-info">
					<form class="form-horizontal" action="" methods="">
					<fieldset>
					<div class="control-group">
					<label class="control-label" for="">作品名称：</label>
					<div class="controls">
						<input type="text" class="span5" name="title" <?php if ($_smarty_tpl->tpl_vars['info']->value){?>value="<?php echo $_smarty_tpl->tpl_vars['info']->value['title'];?>
"<?php }?>/>
					</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="">作者名称：</label>
					<div class="controls">
					<input type="text" class="span5" name="author"  <?php if ($_smarty_tpl->tpl_vars['info']->value){?>value="<?php echo $_smarty_tpl->tpl_vars['info']->value['author'];?>
"<?php }?>/>
					</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="">作品体裁：</label>
					<div class="controls">
	              		<label class="checkbox inline">
	                	<input type="checkbox" value="option1" id="inlineCheckbox1"> 小说</label>
	              		<label class="checkbox inline">
						<input type="checkbox" value="option2" id="inlineCheckbox2"> 随笔</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option3" id="inlineCheckbox3"> 诗歌</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option4" id="inlineCheckbox4"> 剧本</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option5" id="inlineCheckbox5"> 文论</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option6" id="inlineCheckbox6"> 非文学</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option7" id="inlineCheckbox7"> 其他</label>
	            	</div>
	            	</div>
	            	<div class="control-group">
	            	<label class="control-label" for="">作品标签：</label>
	            	<div class="controls">
					<input type="text" class="span5" name="tag" placeholder="多个标签用逗号隔开，如建筑，哥特式风格，罗马"/>
					</div>
					</div>
					</div>
					</fieldset>
					</form>
				</div>
			</div>
		</div>
<?php echo $_smarty_tpl->getSubTemplate ("ats/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>